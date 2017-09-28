<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class producto_institucion extends Model
{
    protected $table = "productos_instituciones";

    protected function insertar($datos, $idFoto)
    {

    	$insertar = new producto_institucion;
    	$insertar->id_foto = $idFoto;
    	$insertar->id_categoria = $datos->categoria;
    	$insertar->nombre = $datos->nombre;
    	$insertar->precio = $datos->valor;
    	$insertar->descripcion = $datos->descripcion;
    	$insertar->cantidad = $datos->cantidad;
    	$insertar->vista = '0';/*Valor inicial de vistas*/

    	if ($insertar->save()) {
    		return $insertar->id;
    	}
    	return 0;
    }

    protected function verProductoDesdeArea($idIns, $idarea)
    {
        /*$traer = \DB::select("CALL `verProductosAreas`(".$idIns.", ".$idarea.");");
        return $traer;*/

        $traer = \DB::table('tienda_producto_instituciones')
                ->select([
                        'tienda_producto_instituciones.id_producto as idProducto',
                        'foto_productos.nombre as foto',
                        'productos_instituciones.nombre as nombre',
                        'productos_instituciones.descripcion as descripcion',
                        'productos_instituciones.created_at as creado',
                    ])
                ->join('productos_instituciones','productos_instituciones.id','=','tienda_producto_instituciones.id_producto')
                ->join('foto_productos','foto_productos.id','=','productos_instituciones.id_foto')
                ->join('estado_tienda_producto','estado_tienda_producto.id','=','tienda_producto_instituciones.id_estado')
                ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                ->join('institucion','institucion.id','=','tiendas_instituciones.id_institucion')
                ->join('area','area.id','=','tienda_producto_instituciones.id_area')
                ->where('institucion.id','=', $idIns)
                ->where('area.id','=', $idarea)->paginate(2);

                return $traer;

    }
}
