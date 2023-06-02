<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\EmailTemplates;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailHandler extends Mailable
{
    use Queueable, SerializesModels;


    public $user;
    public $emailTemplate;
    public $others;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, EmailTemplates $emailTemplate,  $others = null)
    {
        $this->user = $user;
        $this->emailTemplate = $emailTemplate;
        $this->others = $others;
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
            view: 'email.template',
            with: [
                'user' => $this->user,
                'template' => $this->emailTemplate,
                'others' => $this->others,
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
