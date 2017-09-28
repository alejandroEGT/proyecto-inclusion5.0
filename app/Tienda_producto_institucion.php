<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda_producto_institucion extends Model
{
    protected $table = "tienda_producto_instituciones";

    protected function insertar($idP, $idTienda, $getID, $idarea)
    {
    	$insertar = new Tienda_producto_institucion;

    	$insertar->id_producto = $idP;
    	$insertar->id_tienda = $idTienda;
    	$insertar->id_estado = $getID;/*Valor por default*/
        $insertar->id_area = $idarea;

    	if ($insertar->save()) {

    		return 1;
    	}
    	 return 0;
    }
}
