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

    protected function id_tienda($iduser)
    {
        $traer = \DB::table('tiendas_instituciones')
                ->select('tiendas_instituciones.id')
                ->join('usuario-institucion','usuario-institucion.id_institucion','=','tiendas_instituciones.id_institucion')
                ->where('usuario-institucion.id_user','=', $iduser)->get();
        return $traer;        

    }
    protected function id_tienda_alumno($iduser)
    {
         $traer = \DB::table('tiendas_instituciones')
                ->select('tiendas_instituciones.id')
                ->join('vendedor-institucion','vendedor-institucion.id_institucion','=','tiendas_instituciones.id_institucion')
                ->join('vendedor','vendedor.id','=','vendedor-institucion.id_vendedor')
                ->where('vendedor.id_user','=', $iduser)->get();
        return $traer;       

    }
    protected function id_tienda_by_institucion($idInst)
    {
        $traer = Tienda_institucion::where('id_institucion', $idInst)->get();
        return $traer;
    }

    protected function traerTiendas()
    {
        $tienda = \DB::table('tiendas_instituciones')
                    ->join('institucion','institucion.id','=','tiendas_instituciones.id_institucion')->take(4)->get();
        return $tienda;
    }

     protected function traerTiendasAll($cantidad)
    {
        $tienda = \DB::table('tiendas_instituciones')
                    ->join('institucion','institucion.id','=','tiendas_instituciones.id_institucion')
                    ->paginate($cantidad);
        return $tienda;
    }


   /* protected function traerTiendasId($idTienda)
    {
        $tienda = \DB::table('tiendas_instituciones')
          ->select([

                    'institucion.id as idInstitucion',
                    'institucion.nombre as nombreInstitucion'

                    ])
                    ->join('institucion','institucion.id','=','tiendas_instituciones.id_institucion')
                    ->where('institucion.id','=',$idTienda)->get();
        return $tienda;
    }*/


   

}
