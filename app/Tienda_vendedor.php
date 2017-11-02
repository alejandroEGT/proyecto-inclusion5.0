<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda_vendedor extends Model
{
    protected $table = "tienda_vendedor";

     protected function insertar($idVendedor)
    {
    	$insertar = new Tienda_vendedor;
    	$insertar->nombre = "por definir";
    	$insertar->descripcion = "por definir";
        $insertar->id_estado = '1';/*Activa por default*/
        $insertar->id_vendedor = $idVendedor;/*tipo institucional*/

    	if ($insertar->save()) {
    		return true;
    	}
    	return false;
    }

    protected function encargado_id_tienda()/*POR DEFINIR*/
    {
        $traer = \DB::table('tiendas_instituciones')
                ->select('tiendas_instituciones.id')
                ->join('usuario-institucion','usuario-institucion.id_institucion','=','tiendas_instituciones.id_institucion')
                ->where('usuario-institucion.id_user','=', \Auth::user()->id)->get();
        return $traer;        

    }

     protected function traerTiendas()
    {
        $tienda = \DB::table('tienda_vendedor')
                    ->join('vendedor','vendedor.id','=','tienda_vendedor.id_vendedor')
                    ->join('users','users.id','=','vendedor.id_user')
                    ->join('fotoperfil','fotoperfil.id_user','=','users.id')->get();
        return $tienda;
    }
}
