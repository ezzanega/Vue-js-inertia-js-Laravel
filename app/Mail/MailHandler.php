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

class MailHandler extends Mailable
{
    use Queueable, SerializesModels;

    public $emailTemplate;
    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($emailTemplate,  $data = [])
    {
        $this->emailTemplate = $emailTemplate;
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $from = ['email' => 'hello@sysdem.fr', 'name' => 'Support Sysdem'];
        $replyTo = ['email' => 'support@sysdem.fr', 'name' => 'Support Sysdem'];

        $parameters = json_decode($this->emailTemplate->parameters, true);
        $subject =  $this->emailTemplate->subject;
        foreach ($parameters as $key => $value) {
            if ($this->data[$key]) $subject = str_replace($value, $this->data[$key], $subject);
        }

        return new Envelope(
            from: new Address($from['email'], $from['name']),
            replyTo: [
                new Address($replyTo['email'], $replyTo['name']),
            ],
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $parameters = json_decode($this->emailTemplate->parameters, true);
        $body =  $this->emailTemplate->body;
        foreach ($parameters as $key => $value) {
            if ($this->data[$key]) $body = str_replace($value, $this->data[$key], $body);
        }

        return new Content(
            view: 'email.template',
            with: [
                'body' => $body,
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
