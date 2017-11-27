<?php

namespace App;

use App\producto;
use Illuminate\Database\Eloquent\Model;

class detalle_carro extends Model
{
    protected function ingProducto($datos,$carro,$producto){


		if($datos->cantidad > $producto->cantidadProducto || $datos->cantidad == 0){
			
			\Session::flash('correcto', 'El campo cantidad es requerido, Intente nuevamente.');
             return false;
		
		}else{

		$update = detalle_carro::where('id_carro', $carro)->where('id_producto', $producto->idProducto)->first();

			if($update && $update->id_producto == $producto->idProducto){

						$update->cantidad = $update->cantidad+$datos->cantidad;

						if($update->save()){
							return true;
						}else{
							return false;
						}
			}else{

			$agregar = new detalle_carro;

			$agregar->id_carro = $carro;
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
	}

	protected function delProducto($id, $carro){


		//dd($id.' / '.$carro->id);

		$delete = detalle_carro::where('id_carro', $carro->id)
								->where('id_producto', $id)->delete();

		return $delete;
		

		//dd($delete);

		//$delete->id_estado = 3;

		//if($delete->delete()){
		//	dd('true');
		//}else{
		//	dd('false');
		//}
		


		/*$delete = detalle_carro::where('id_carro', $carro->id)
							->where('id_producto', $id)
		->update([
                    'id_estado' => 3
        ]);
		*/
        //return $delete;
	}

	protected function actProducto($datos, $carro){


			$getId = base64_decode($datos->id);

			$producto = producto::where('id',$getId)->first();

			if($datos->cantidad > $producto->cantidad || $datos->cantidad == 0){
				
				\Session::flash('Advertencia', 'La cantidad ingresada es mayor al stock disponible, Intente nuevamente.');
	             return false;
			
			}else{

			$update = detalle_carro::where('id_carro', $carro->id)
									->where('id_producto', $getId)->first();
			//dd($update->cantidad = $datos->cantidad);
			$update->cantidad = $datos->cantidad;

			if($update->save()){
				return true;
			}else{
				return false;
			}
		}

	}

}
