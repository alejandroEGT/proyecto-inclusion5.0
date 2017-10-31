<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detalle_carro extends Model
{
    protected function ingProducto($datos,$carro,$producto){

		$agregar = new detalle_carro;

		$agregar->id_carro = $carro->id;
		$agregar->id_producto = $producto->idProducto;
		$agregar->cantidad = $datos->cantidad;

		if($agregar->save()){
			return true;
		}else{
			return false;
		}
	}
}
