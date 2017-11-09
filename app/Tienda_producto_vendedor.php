<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda_producto_vendedor extends Model
{

	protected $table = "Tienda_producto_vendedor";

    protected function insertar($idP, $idTienda, $getID)
    {
    	$insertar = new Tienda_producto_vendedor;

    	$insertar->id_producto = $idP;
    	$insertar->id_tienda = $idTienda;
    	$insertar->id_estado = $getID;/*Valor por default*/
    	if ($insertar->save()) {
  
    		return 1;
    	}
    	 return 0;
    }

    protected function mostrar_productos_vendedor($id){

    	 $producto = \DB::table('productos')
         ->select([
         		'productos.id as idProducto',
                'productos.nombre as nombre',
                'productos.precio as precio',
                'productos.descripcion as descripcion',
                'productos.cantidad as cantidad',
                'foto_productos.id as idFoto',
                'foto_productos.foto as foto',
                'Tienda_producto_vendedor.created_at as creado'
         ])

          ->join('foto_productos','productos.id','=','foto_productos.id_producto')
          ->join('tienda_producto_vendedor','productos.id','=','tienda_producto_vendedor.id_producto')
          ->join('tienda_vendedor','tienda_vendedor.id','=','Tienda_producto_vendedor.id_tienda')
          ->join('estado_tienda_producto','tienda_producto_vendedor.id_estado','=','estado_tienda_producto.id')
          ->where('Tienda_producto_vendedor.id_estado',1)
          ->where('tienda_vendedor.id_vendedor', $id)->paginate(10);
           return $producto;
    }
    protected function borrar($idP)
    {
        $prod = Tienda_producto_vendedor::where('id_producto', $idP)->update([
                    'id_estado' => 4
        ]);

        return $prod;

    }
    protected function actualizar_visibilidad($dato)
    {
        $pi = \DB::table('tienda_producto_vendedor')
                ->where('id_producto', $dato->idProducto)
                ->update(['id_estado' => $dato->estadoV]);

        if (count($pi)>0) {
             return true;
        }   
        return false;     
    }

    
}

