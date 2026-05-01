<?php
// app/Mail/PasswordlessLoginMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordlessLoginMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $code;
    public int $expiresInMinutes;

    public function __construct(string $code, int $expiresInMinutes = 10)
    {
        $this->code = $code;
        $this->expiresInMinutes = $expiresInMinutes;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🔐 Votre code de connexion - Bantou-Foundation',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.passwordless-login',
        );
    }
}
