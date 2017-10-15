<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Area;
class Encargado extends Model
{
    protected $table="usuario-institucion";

    protected function traerDatos()
    {
    	$datos = \DB::table('users')
    			      ->join('usuario-institucion','usuario-institucion.id_user','=','users.id')
    			      ->join('area','area.id','=','usuario-institucion.id_area')
    			      ->where('users.id', \Auth::user()->id)->get();

    	return $datos;
    }
     protected function traerEquipo(){

     	$area = \DB::table('area')->join('usuario-institucion','usuario-institucion.id_area','=','area.id')
                    ->where('usuario-institucion.id_user','=',\Auth::user()->id)->get();

     	$equipo = \DB::table('users')
     			  ->join('vendedor','vendedor.id_user','=','users.id')
     			  ->join('vendedor-institucion','vendedor-institucion.id_vendedor','=','vendedor.id')
     			  ->join('area','area.id','=','vendedor-institucion.id_area')
     			  ->join('fotoperfil','fotoperfil.id_user','=','users.id')
     			  ->where('area.id','=', $area[0]->id_area)->get();

     	return $equipo;
     }

     protected function traerEstadoClave(){

        $estado = \DB::table('password-cuenta')->where('id_user', \Auth::user()->id )->get(); 
        return $estado[0]->id_estado;
    }
    
}
