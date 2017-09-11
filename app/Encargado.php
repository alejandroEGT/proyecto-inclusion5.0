<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
