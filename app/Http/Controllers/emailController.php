<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\correo;

class emailController extends Controller
{
    public function send()
	{
	     Mail::send(['text'=>'emails.mail'],['name','janin'],function ($message)
        {

            $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido"');

            $message->to('alejandro.godoy10@inacapmail.cl','to jano');

        });

	}
}
