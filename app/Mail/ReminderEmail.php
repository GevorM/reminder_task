<?php

namespace App\Mail;

use App\Enums\ReminderTypes;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param Order $order
     * @param Carbon $reminderDate
     * @param $type
     */
    public function __construct(public Order $order, public Carbon $reminderDate, public $type)
    {}


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Expiration Reminder Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reminder',
            with: [
                'businessName' => $this->order->business_name,
                'orderType' => $this->order->order_type,
                'expirationDate' => $this->order->expiration_date,
                'reminderDate' => $this->reminderDate->format('Y-m-d'),
                'customText' => $this->getCustomText(),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    private function getCustomText(): string
    {
        return $this->type == ReminderTypes::PRE->value ? 'Your order is nearing expiration.' : 'Your order has expired.';
    }
}
