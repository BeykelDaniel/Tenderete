<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    // Propiedad pública accesible automáticamente desde la vista Blade
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo Mensaje de Soporte Técnico - Tenderete',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact', // Ruta del archivo HTML que pintará el contenido
        );
    }
}
