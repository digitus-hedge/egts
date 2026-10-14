<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from:    new Address('info.egts26@gmail.com', 'EGTS Website'),
            subject: 'New Website Feedback — ' . now()->format('d M Y, h:i A'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.feedback',
            with: ['data' => $this->data],
        );
    }
}