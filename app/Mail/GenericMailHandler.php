<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\EmailTemplates;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenericMailHandler extends Mailable
{
    use Queueable, SerializesModels;


    public $emailTemplate;
    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct(EmailTemplates $emailTemplate,  $data = null)
    {
        $this->emailTemplate = $emailTemplate;
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('hello@xendar.io', 'Xendar Support'),
            replyTo: [
                new Address('support@xendar.io', 'Xendar Support'),
            ],
            subject: $this->emailTemplate->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.generic-email',
            with: [
                'template' => $this->emailTemplate,
                'data' => $this->data,
            ],
        );
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
