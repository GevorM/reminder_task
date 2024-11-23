<?php

namespace App\Jobs;

use App\Mail\ReminderEmail;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendReminderJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly Order  $order,
        private readonly Carbon $reminderDate,
        private readonly string $type
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->order->business_email)->send(new ReminderEmail($this->order, $this->reminderDate, $this->type));
    }
}
