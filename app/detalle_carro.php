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

				if($update->cantidad >= $producto->cantidadProducto){

				\Session::flash('correcto', 'Ha superado el stock disponible en Carro');
           			  return false;

				}else{

						$update->cantidad = $update->cantidad+$datos->cantidad;

						if($update->save()){
							return true;
						}else{
							return false;
						}

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

	protected function verificarEstadoProducto($idCarro){


		$carros = \DB::table('carros')
                    ->select([
                        'detalle_carros.id as idDetalle',
                        'tienda_producto_instituciones.id_estado as idEstado'
                    ])
                    ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                    ->join('productos','productos.id','=','detalle_carros.id_producto')
                    ->join('categoria_productos','categoria_productos.id','=','productos.id_categoria')
                    ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                    ->join('foto_productos','foto_productos.id_producto','=','productos.id')
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                    ->join('institucion','institucion.id','=','tiendas_instituciones.id_institucion')
                    ->where('carros.id', $idCarro)
                    ->where('detalle_carros.id_estado',4)
                    ->where('carros.id_estado',1)
                    ->where('tienda_producto_instituciones.id_estado',2)
                    ->get();

       if(count($carros)>0){
       	 return $carros;
       	}else{
       		return false;
       	}

	}

}
