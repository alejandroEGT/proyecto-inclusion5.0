<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda_institucion extends Model
{
    protected $table = "tiendas_instituciones";

    protected function insertar($idInstitucion)
    {
    	$insertar = new Tienda_institucion;
    	$insertar->nombre = "por definir";
    	$insertar->descripcion = "por definir";
        $insertar->id_estado = '1';/*Activa por default*/
        $insertar->id_institucion = $idInstitucion;/*tipo institucional*/

    	if ($insertar->save()) {
    		return true;
    	}
    	return false;
    }

    protected function encargado_id_tienda()
    {
        $traer = \DB::table('tiendas_instituciones')
                ->select('tiendas_instituciones.id')
                ->join('usuario-institucion','usuario-institucion.id_institucion','=','tiendas_instituciones.id_institucion')
                ->where('usuario-institucion.id_user','=', \Auth::user()->id)->get();
        return $traer;        

    }


}
