<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Producto;

class FacturaMailable extends Mailable
{
    use Queueable, SerializesModels;


    // asunto del mensaje
    public $subject = "Factura de tu compra";


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        protected Array $Productos, 
        protected $direccion,
        protected $numberContact,
        protected $detalles
    )
    {
        //
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Factura',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        // se encarga de traer la vista
        return new Content(
            view: 'emails.factura',
            with: [
                'Productos' => $this->Productos,
                'Direccion' => $this->direccion,
                'Telefono' => $this->numberContact,
                'Detalles' => $this->detalles,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
