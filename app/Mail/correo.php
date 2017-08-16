<?php

namespace App\Mail;

use App\Institucion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class correo extends Mailable
{
    use Queueable, SerializesModels;

    public $institucion;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($institucion)
    {
         $this->institucion = $institucion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.mail');
    }
}
