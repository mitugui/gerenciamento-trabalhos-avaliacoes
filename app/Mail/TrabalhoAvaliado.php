<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TrabalhoAvaliado extends Mailable
{
    use Queueable, SerializesModels;

    private $trabalho;
    private $avaliacao;

    /**
     * Create a new message instance.
     */
    public function __construct($trabalho, $avaliacao)
    {
        $this->trabalho = $trabalho;
        $this->avaliacao = $avaliacao; 
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Trabalho ' . $this->trabalho->nome . ' Avaliado',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.trabalho.avaliado',
            with: [
                'trabalho' => $this->trabalho,
                'avaliacao' => $this->avaliacao,
            ]
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
