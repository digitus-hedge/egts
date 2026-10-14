<?php

namespace App\Mail;

use App\Models\Enquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class EnquiryReceived extends Mailable
{
    use Queueable, SerializesModels;

    public Enquiry $enquiry;

    public function __construct(Enquiry $enquiry)
    {
        $this->enquiry = $enquiry;
    }

    public function build()
    {
        $name    = trim(preg_replace('/\s+/', ' ', (string) $this->enquiry->full_name));
        $subject = trim(preg_replace('/\s+/', ' ', (string) ($this->enquiry->subject ?? 'New Enquiry')));

        $mail = $this
            ->subject(Str::limit('New Enquiry: ' . $subject . ' - ' . $name, 150))
            ->view('emails.enquiry-received')
            ->with([
                'logoPath' => public_path('images/footer-logo.webp'),
            ]);

        if (! empty($this->enquiry->email)) {
            $mail->replyTo($this->enquiry->email, $name);
        }

        return $mail;
    }
}