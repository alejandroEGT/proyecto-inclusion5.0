<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda_producto_institucion extends Model
{
    protected $table = "tienda_producto_instituciones";

    protected function insertar($idP, $idTienda, $getID, $idarea)
    {
    	$insertar = new Tienda_producto_institucion;

    	$insertar->id_producto = $idP;
    	$insertar->id_tienda = $idTienda;
    	$insertar->id_estado = $getID;/*Valor por default*/
        $insertar->id_area = $idarea;

    	if ($insertar->save()) {

    		return 1;
    	}
    	 return 0;
    }

    protected function borrar($idP)
    {
        //$tpi = \DB::table('tienda_producto_instituciones')->where('id_producto', '=', $idP)->delete();
        $tpi = \DB::table('tienda_producto_instituciones')->where('id_producto', $idP)
                ->update([
                    'id_estado' => 4
                ]);
        return $tpi;
    }
    protected function productoEnEspera()
    {
        $dato = \DB::table('tienda_producto_instituciones')
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                    ->join('institucion','institucion.id','=','tiendas_instituciones.id')
                    ->where('institucion.id', \Auth::guard('institucion')->user()->id)
                    ->where('tienda_producto_instituciones.id_estado', 3)->get();

        return count($dato);            
    }
    protected function contarproductos($idA, $idI)
    {
       $contar = \DB::table('productos')
                ->join('tienda_producto_instituciones', 'tienda_producto_instituciones.id_producto', '=', 'productos.id')
                ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                ->join('institucion','institucion.id','=','tiendas_instituciones.id_institucion')
                ->where('tienda_producto_instituciones.id_area', $idA)
                ->where('tiendas_instituciones.id_institucion', $idI)
                ->where('tienda_producto_instituciones.id_estado', 1)
                ->sum('productos.cantidad');

        return $contar;        
    }
    protected function mostrarProductosArea($idA, $idI)
    {
         $mostrar = \DB::table('productos')
                ->select([
                    'productos.id as id_producto',
                    'productos.nombre as nombre',
                    'foto_productos.foto as foto',
                    'productos.descripcion as descripcion',
                    'productos.cantidad as cantidad'
                ])
                ->join('tienda_producto_instituciones', 'tienda_producto_instituciones.id_producto', '=', 'productos.id')
                ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                ->join('institucion','institucion.id','=','tiendas_instituciones.id_institucion')
                ->join('foto_productos','foto_productos.id_producto','=','productos.id')
                ->where('tienda_producto_instituciones.id_area', $idA)
                ->where('tiendas_instituciones.id_institucion', $idI)
                ->where('tienda_producto_instituciones.id_estado', 1)
                ->get();

        return $mostrar; 
    }
}
