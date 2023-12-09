<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class LowSupplyMail extends Mailable
{
    use Queueable, SerializesModels;


    private Transaction $transaction;

    /**
     * Create a new message instance.
     */
    public function __construct(array $transaction)
    {
        $this->transaction = $transaction[0];
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
            ->subject('Inventory Notification')
            ->markdown('mail.low-supply-notification')
            ->with([
                'transaction' => $this->transaction,
                'url' => $this->transaction->getVendor()->vendorURL,
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
