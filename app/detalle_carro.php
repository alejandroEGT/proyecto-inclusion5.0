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
		$agregar->id_estado = 4;

					if($agregar->save()){
						return true;
					}else{
						return false;
					}
			}
	}

	protected function delProducto($id, $carro){

		$delete = detalle_carro::where('id_carro', $carro->id)
								->where('id_producto', $id)->first();

		$delete->id_estado = 3;

		if($delete->save()){
			return true;
		}else{
			return false;
		}
	}

	protected function actProducto($datos, $carro){

		$getId = base64_decode($datos->id);

		$producto = producto::where('id',$getId)->first();

		if($datos->cantidad > $producto->cantidad || $datos->cantidad == 0){
			return "No puede ingresar eso";
		}else{

		$update = detalle_carro::where('id_carro', $carro->id)
								->where('id_producto', $getId)->first();
		
		$update->cantidad = $datos->cantidad;

		if($update->save()){
			return true;
		}else{
			return false;
		}
	}

}

}
