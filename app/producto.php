<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    protected $table = "productos";

    protected function insertar($datos, $idFoto)
    {

    	$insertar = new producto;
    	$insertar->id_foto = $idFoto;
    	$insertar->id_categoria = $datos->categoria;
    	$insertar->nombre = $datos->nombre;
    	$insertar->precio = $datos->valor;
    	$insertar->descripcion = $datos->descripcion;
    	$insertar->cantidad = $datos->cantidad;
    	$insertar->vista = '0';/*Valor inicial de vistas*/

    	if ($insertar->save()) {
    		return $insertar->id;
    	}
    	return 0;
    }
}
