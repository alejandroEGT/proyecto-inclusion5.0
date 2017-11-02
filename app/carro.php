<?php

namespace App;

use App\cliente;
use Illuminate\Database\Eloquent\Model;

class carro extends Model
{
   protected function crearCarro ($idUser){

		$carro = new carro;

	    $finduser = cliente::where('id_user', $idUser->id)->first();

		$carro->id_cliente = $finduser->id;
		$carro->id_estado = 1;

		if($carro->save()){
			return true;
		}else{
			return false;
		}

	}

	protected function traerDatosCarro(){

		$noticia = \DB::table('carros')
                    ->select([
                        'carros.id as idCarro',
                        'carros.id_cliente as idCliente',
                        'detalle_carros.id as idDetalleCarro',
                        'detalle_carros.cantidad as cantidadProducto',
                        'productos.id as idProducto',
                        'productos.nombre as nombreProducto',
                        'productos.precio as precioProducto',
                        'institucion.nombre as nombreTienda'

                    ])
                    ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                    ->join('productos','productos.id','=','detalle_carros.id_producto')
                    ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                    ->join('institucion','institucion.id','=','tiendas_instituciones.id_institucion')
                    ->where('carros.id_cliente', 5)
                    ->get();

        return $noticia;
		
	}
}
