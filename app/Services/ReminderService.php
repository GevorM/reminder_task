<?php

namespace App\Services;
use App\Enums\OrderTypes;
use App\Enums\ReminderTypes;
use App\Jobs\SendReminderJob;
use Carbon\Carbon;

class ReminderService
{
    public function sendPreExpirationReminders($order): void
    {
        $expirationDate = Carbon::parse($order->expiration_date);
        $preExpirationIntervals = config('reminder.pre_expiration_intervals');
        foreach ($preExpirationIntervals as $interval) {
            $reminderDate = $expirationDate->subDays((int)$interval);
            if ($reminderDate < now()) {
                $this->sendReminderEmail($order, $reminderDate, ReminderTypes::PRE->value);
                break;
            }
        }
    }

    public function sendPostExpirationReminders($order): void
    {
        $expirationDate = Carbon::parse($order->expiration_date);
        $postExpirationIntervals = config('reminder.post_expiration_intervals');
        foreach ($postExpirationIntervals as $interval) {
            if ($expirationDate > Carbon::now()->subDays((int)$interval)) {
                $this->sendReminderEmail($order, $expirationDate, ReminderTypes::POST->value);
                break;
            }
        }
    }

    public function calculateExpirationDate(string $applicationDate, string $orderType): string
    {
        $applicationDate = Carbon::parse($applicationDate);
        return match ($orderType) {
            OrderTypes::X->value => $applicationDate->addYear()->format('Y-m-d'),
            OrderTypes::Y->value => $applicationDate->endOfYear()->format('Y-m-d'),
            default => $applicationDate->format('Y-m-d'),
        };
    }

    private function sendReminderEmail($order, Carbon $reminderDate, $type): void
    {
        SendReminderJob::dispatch($order, $reminderDate, $type);
    }
}
