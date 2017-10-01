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

}
