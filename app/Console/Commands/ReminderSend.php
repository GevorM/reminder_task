<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Services\ReminderService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReminderSend extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send pre-expiration and post-expiration reminders for orders';

    public function __construct(public ReminderService $reminderService)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $orders = Order::withWhereHas('reminder')->get();
        foreach ($orders as $order) {
            $this->info("Sending reminders for Order ID: {$order['id']}");
            if (Carbon::parse($order->expiration_date) < now()) {
                $this->reminderService->sendPostExpirationReminders($order);
            } else {
                $this->reminderService->sendPreExpirationReminders($order);
            }
        }

        $this->info('Reminders have been sent successfully!');
    }
}
