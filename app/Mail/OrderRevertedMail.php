<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderRevertedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Order $order,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pesanan Ditinjau Ulang - ' . $this->order->order_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.orders.reverted',
            with: [
                'trackingUrl' => $this->order->getTrackingUrl(),
            ],
        );
    }
}
