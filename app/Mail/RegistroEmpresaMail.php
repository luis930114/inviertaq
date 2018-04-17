<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\RegistroEmpresa;

class RegistroEmpresaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The RegistroEmpresa instance.
     *
     * @var RegistroEmpresa
     */
    public $registro_empresa;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RegistroEmpresa $registro_empresa)
    {
        $this->registro_empresa = $registro_empresa;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Registro de nueva empresa: '.$this->registro_empresa->reem_nombre)->markdown('emails.registros.empresa');
    }
}
