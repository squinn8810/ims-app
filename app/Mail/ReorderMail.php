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


    public array $message;

    /**
     * Create a new message instance.
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

      /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('SFDSupplies@gmail.com', 'SFD EMS Supplies')
            ->subject('EMS Supplies Notification')
            ->markdown('mail.restock-notification')
            ->with([
                'messages' => $this->message,
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
