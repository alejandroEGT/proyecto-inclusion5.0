<?php

namespace App;

use App\producto;
use Illuminate\Database\Eloquent\Model;

class detalle_carro extends Model
{
    protected function ingProducto($datos,$carro,$producto){



		$update = detalle_carro::where('id_carro', $carro->id)
								->where('id_producto', $producto->idProducto)->first();

		if($update && $update->id_producto == $producto->idProducto){
					$update->cantidad = $update->cantidad+$datos->cantidad;

					if($update->save()){
						return true;
					}else{
						return false;
					}
		}else{

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

}
