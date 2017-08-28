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
   
    public function __construct($institucion)
    {
         $this->institucion = $institucion;
    }

    
    public function build()
    {
        return $this->view('emails.mail');
    }
}
