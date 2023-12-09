<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class ReorderMail extends Mailable
{
    use Queueable, SerializesModels;


    public array $transaction;

    /**
     * Create a new message instance.
     */
    public function __construct(array $transaction)
    {
        $this->transaction = $transaction;
    }

      /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('powersupply@gmail.com', 'PowerSupply Inventory')
            ->subject('Low Supply Notification')
            ->markdown('mail.restock-notification')
            ->with([
                'transactions' => $this->transaction,
                'url' => 'https://www.boundtree.com',
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
