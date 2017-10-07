<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicio extends Model
{
    protected $table = "servicios";
    public $timestamps = false;

    protected function insertar($datos)
    {
    	$insertar = new servicio;
    	$insertar->nombre = $datos->nombre;
    	$insertar->descripcion = $datos->descripcion;
    	if ($insertar->save()) {
    		return $insertar->id;
    	}
    	return 0;
    } 
}
