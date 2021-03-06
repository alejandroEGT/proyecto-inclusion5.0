<?php

namespace App;

use App\cliente;
use Illuminate\Database\Eloquent\Model;

class carro extends Model
{
   protected function crearCarro ($idUser){

		$carro = new carro;

        $verificarUsuario = carro::where('id_cliente', $idUser)->where('id_estado', 1)->first();

        if ($verificarUsuario == true) {
            //dd($verificarUsuario->id);
            return $verificarUsuario->id; /* si es que el carro esta en proceso*/
        }
        //dd('no existe');

        $carro->id_cliente = $idUser;
        $carro->id_estado = 1; /*default en proceso o activo.*/

        if ($carro->save()) {
            return $carro->id; /*si es que se crea el carro*/
        }

        return null;

	    //$finduser = cliente::where('id_user', $idUser->id)->first();

		//$carro->id_cliente = $finduser->id;
		/*$carro->id_estado = 1;
		if($carro->save()){
			return true;
		}else{
			return false;
		}*/

	}

	protected function traerDatosCarro($idCliente){

		$carros = \DB::table('carros')
                    ->select([
                        'carros.id as idCarro',
                        'carros.id_cliente as idCliente',
                        'detalle_carros.id as idDetalleCarro',
                        'detalle_carros.cantidad as cantidadProducto',
                        'productos.id as idProducto',
                        'productos.nombre as nombreProducto',
                        'productos.precio as precioProducto',
                        'productos.cantidad as stockProducto',
                        'productos.descripcion as descripcionProducto',
                        'categoria_productos.nombre as categoriaProducto',
                        'institucion.nombre as nombreTienda',
                        'institucion.id as idTienda',
                        'foto_productos.foto as fotoProducto',
                        'detalle_carros.precio_actual as precioActual'

                    ])
                    ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                    ->join('productos','productos.id','=','detalle_carros.id_producto')
                    ->join('categoria_productos','categoria_productos.id','=','productos.id_categoria')
                    ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                    ->join('foto_productos','foto_productos.id_producto','=','productos.id')
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                    ->join('institucion','institucion.id','=','tiendas_instituciones.id_institucion')
                    ->where('carros.id_cliente', $idCliente->id)
                    ->where('detalle_carros.id_estado',4)
                    ->where('carros.id_estado',1)
                    ->where('tienda_producto_instituciones.id_estado',1)
                    ->get();



        return $carros;
	
	}

        protected function devolverProducto($idCliente){

        $carros = \DB::table('carros')
                    ->select([
                        'carros.id as idCarro',
                        'carros.id_cliente as idCliente',
                        'carros.id_estado as estado',
                        'detalle_carros.id as idDetalleCarro',
                        'detalle_carros.cantidad as cantidadProducto',
                        'productos.id as idProducto',
                        'productos.nombre as nombreProducto',
                        'productos.precio as precioProducto',
                        'productos.cantidad as stockProducto',
                        'productos.descripcion as descripcionProducto',

                    ])
                    ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                    ->join('productos','productos.id','=','detalle_carros.id_producto')
                    ->where('carros.id_cliente', $idCliente->id)
                    ->where('detalle_carros.id_estado',4)
                    ->where('carros.id_estado',9)
                    ->get();

        return $carros;

       
        
    }


    protected function cantidadProductosCarro($idCliente){

        $productos = \DB::table('carros')
                        ->select([
                        'carros.id as idCarro',
                    ])
 
                        ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                        ->join('clientes','clientes.id','=','carros.id_cliente')
                        ->join('users','users.id','=','clientes.id_user')
                        ->join('productos','productos.id','=','detalle_carros.id_producto')
                        ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                        ->where('clientes.id',$idCliente)
                        ->where('carros.id_estado',1)
                        ->where('tienda_producto_instituciones.id_estado',1)
                        ->get();
        return $productos;

    }


}
