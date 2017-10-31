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
    protected function mostrarServiciosArea($idA, $idI)
    {
        $servicio = \DB::table('tienda_servicio_instituciones')
                    ->select([
                            'servicios.id as id_servicio',
                            'foto_servicios.nombre as foto',
                            'servicios.nombre as nombre',
                            'servicios.descripcion as descripcion'
                    ])
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','Tienda_servicio_instituciones.id_tienda')
                    ->join('institucion','institucion.id','tiendas_instituciones.id_institucion')
                    ->join('servicios','servicios.id','=','tienda_servicio_instituciones.id_servicio')
                    ->join('foto_servicios','foto_servicios.id_servicio','=','servicios.id')
                    ->where('tienda_servicio_instituciones.id_area', $idA)
                    ->where('tiendas_instituciones.id_institucion', $idI)
                    ->where('tienda_servicio_instituciones.id_estado', 1)
                    ->get(); 
        return $servicio;
    }

    protected function contarservicio($idA, $idI)
    {
        $servicio = \DB::table('tienda_servicio_instituciones')
                    ->select([
                            'servicios.id as id_servicio',
                            'foto_servicios.nombre as foto',
                            'servicios.nombre as nombre',
                            'servicios.descripcion as descripcion'
                    ])
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','Tienda_servicio_instituciones.id_tienda')
                    ->join('institucion','institucion.id','tiendas_instituciones.id_institucion')
                    ->join('servicios','servicios.id','=','tienda_servicio_instituciones.id_servicio')
                    ->where('tienda_servicio_instituciones.id_area', $idA)
                    ->where('tiendas_instituciones.id_institucion', $idI)
                    ->where('tienda_servicio_instituciones.id_estado', 1)
                    ->count(); 
        return $servicio;
    }
}
