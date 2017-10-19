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
    protected function traer_ServicioEnEspera(){

        $contar = Tienda_servicio_institucion::where('id_estado', 3)->count();
        return $contar;
    }
    protected function borrar($ids)
    {
        $tpi = \DB::table('tienda_servicio_instituciones')->where('id_servicio', '=', $ids)->delete();
        return $tpi;
    }

}
