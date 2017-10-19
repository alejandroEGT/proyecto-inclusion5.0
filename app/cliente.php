<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected function guardarCliente($datos, $idUser){

    	$cliente = new cliente;

    		$cliente->id_user = $idUser->id;

            if(array_has($datos, 'id')){
                $cliente->facebook_id = $datos->id;
                $cliente->telefono = "0";
                $cliente->id_estado = "2";

            }else{

            $cliente->telefono = $datos->telefono;
            $cliente->id_estado = "2";

            }
    		

    		if($cliente->save()){
    			return true;
    		}else{
    			return false;
    		}
    }

    protected function updCorreo ($datos){

        $user = user::find(\Auth::user()->id);

        $user->email = $datos->correo;

        if($user->save()){
            return true;
        }else{
            return false;
        }
    }

    protected function updTelefono ($datos){

        $cliente = cliente::where('id_user', \Auth::user()->id)->first();

        $cliente->telefono = $datos->telefono;

        if($cliente->save()){
            return true;
        }else{
            return false;
        }
    }

    protected function updClave ($datos){

        $user = user::find(\Auth::user()->id);

        if(\Hash::check($datos->passNueva, $user->password)){

            $user->password = \Hash::make($datos->passNueva);

        if($user->save()){
            return true;
        }else{
            return false;
        }
        
        }

        
    }


}
