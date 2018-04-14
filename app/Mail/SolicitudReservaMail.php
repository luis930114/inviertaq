<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\SolicitudReserva;

class SolicitudReservaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The SolicitudReserva instance.
     *
     * @var SolicitudReserva
     */
    public $solicitud_reserva;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SolicitudReserva $solicitud_reserva)
    {
        $this->solicitud_reserva = $solicitud_reserva;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Solicitud de reserva, cliente: '.$this->solicitud_reserva->nombre)->markdown('emails.reservas.solicitud');
    }
}
