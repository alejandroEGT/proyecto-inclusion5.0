<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listadeseos extends Model
{
    protected $table = "producto-favorito";


    protected function agregar($id_user, $id_producto)
    {
    	$listado = new Listadeseos;
    	$verificaExist = Listadeseos::where('id_user', $id_user)
    					 ->where('id_producto', $id_producto)->get();

    	
    	if (!count($verificaExist)) {
    		$listado->id_user = $id_user;
    		$listado->id_producto = $id_producto;
    		if ($listado->save()) {
    			return true;
    		}
    		return false;
    	}
    	return false;
    }
    protected function traer($id_user){

    	$traer = \DB::table('producto-favorito')
    			->join('productos','productos.id','=','producto-favorito.id_producto')
    			->join('foto_productos','foto_productos.id_producto','=','producto-favorito.id_producto')
    			->where('producto-favorito.id_user', $id_user)->get();

    	return $traer;


    }
}
