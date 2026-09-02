<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\RapportB2B;

class RapportB2BCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public RapportB2B $rapportB2B;

    /**
     * Create a new message instance.
     */
    public function __construct(RapportB2B $rapportB2B)
    {
        $this->rapportB2B = $rapportB2B->loadMissing(['visite.utilisateur', 'visite.client']);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouveau Rapport B2B ',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.rapport_b2b_created',
        );
    }
}
