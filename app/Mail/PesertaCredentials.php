<?php

namespace App\Mail;

use App\Models\Peserta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PesertaCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Peserta $peserta,
        public string $username,
        public string $plainPassword,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kredensial Login - Pemilihan Regen 2026',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.peserta-credentials',
        );
    }
}
