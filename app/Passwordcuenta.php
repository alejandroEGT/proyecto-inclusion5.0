<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passwordcuenta extends Model
{
    protected $table='password-cuenta';

    protected function traerEstado()
    {
    	$estado_password = \DB::table('password-cuenta')
    						    ->join('estado-password','password-cuenta.id_estado','=','estado-password.id')
    						    ->where('password-cuenta.id_user','=', \Auth::user()->id)->get();
    	return $estado_password[0]->id_estado;
    }

    protected function insertar_clave_default($iduser){

    	$passcuenta = new Passwordcuenta;
    	$passcuenta->id_user = $iduser;
    	$passcuenta->id_estado = "1";

    	if ($passcuenta->save()) {
    		return true;
    	}
    	return false;
    }
    protected function insertar_clave_nueva(){

        $insert = \DB::table('password-cuenta')
            ->where('id_user', \Auth::user()->id)
            ->update(['id_estado' => 2]);

        if (count($insert)>0) {
                return true;
            }    
            return false;
    }
    protected function insertar_clave_normal($iduser){

        $passcuenta = new Passwordcuenta;
        $passcuenta->id_user = $iduser;
        $passcuenta->id_estado = "2";

        if ($passcuenta->save()) {
            return true;
        }
        return false;
    }
}
