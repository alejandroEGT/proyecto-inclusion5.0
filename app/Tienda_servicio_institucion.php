<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda_servicio_institucion extends Model
{
    protected $table = "tienda_servicio_instituciones";

     protected function insertar($idS, $idTienda, $getID, $idarea)
    {
    	$insertar = new Tienda_servicio_institucion;

    	$insertar->id_servicio = $idS;
    	$insertar->id_tienda = $idTienda;
    	$insertar->id_estado = $getID;/*Valor por default*/
        $insertar->id_area = $idarea;

    	if ($insertar->save()) {

    		return 1;
    	}
    	 return 0;
    }

    protected function borrar($idP)
    {
        $tpi = \DB::table('tienda_producto_instituciones')->where('id_producto', '=', $idP)->delete();
        return $tpi;
    }

}
