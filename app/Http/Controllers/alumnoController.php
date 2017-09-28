<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Usuarioinstitucion;
use Illuminate\Support\Facades\Mail;

class alumnoController extends Controller
{
	public function generarClave(Request $id){

        $genclave = $this->genclave();
        //$estadoPass =       CAMBIAR ESTADO A NO CAMBIADA DE LA CONTRASEÑA DEL USUARIO

        $alumno = User::find($id->id);
        $correo = $alumno->email;

        $alumno->password = bcrypt($genclave);
        if ($alumno->save()) {
        	\Session::put('usuario',$alumno->nombres.' '.$alumno->apellidos);//obtener usuario y enviarlo a clave.blade.php
	        \Session::put('clave',$genclave);//obtener clave y enviarlo a clave.blade.php

	        Mail::send(['html'=>'emails.recuperaClave'],['name','al'],function ($message) use ($correo)
	        {
	            $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
	            $message->to($correo,'to');
	        });

	        return "operacion exitosa"; 
	    }
        
    }

    public function genclave(){
      $cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $cadena_base .= '0123456789' ;
      $cadena_base .= 'kkck';
      $password = '';
      $limite = strlen($cadena_base) - 1;
 
      for ($i=0; $i < 13; $i++)
        $password .= $cadena_base[rand(0, $limite)];
        return $password;
    }

    
}
