<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
     protected $table = "productos";

    protected function insertar($datos)
    {

        $insertar = new producto;
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
    protected function traerProductosByArea($idarea)
    {
        $traer = \DB::table('tienda_producto_instituciones')->where('id_area', $idarea)->get();
        return count($traer);
    }

    protected function verProductoDesdeArea($idIns, $idarea)
    {
        /*$traer = \DB::select("CALL `verProductosAreas`(".$idIns.", ".$idarea.");");
        return $traer;*/

        $traer = \DB::table('tienda_producto_instituciones')
                ->select([
                        'tienda_producto_instituciones.id_producto as idProducto',
                        'foto_productos.foto as foto',
                        'productos.nombre as nombre',
                        'productos.descripcion as descripcion',
                        'productos.created_at as creado',
                    ])
                ->join('productos','productos.id','=','tienda_producto_instituciones.id_producto')
                ->join('foto_productos','foto_productos.id_producto','=','productos.id')
                ->join('estado_tienda_producto','estado_tienda_producto.id','=','tienda_producto_instituciones.id_estado')
                ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                ->join('institucion','institucion.id','=','tiendas_instituciones.id_institucion')
                ->join('area','area.id','=','tienda_producto_instituciones.id_area')
                 ->orderBy('productos.created_at', 'desc')/*Posible error*/
                ->where('area.id','=', $idarea)->paginate(2);

                return $traer;

    }
    protected function traetProductosDesdeAdmin($idInst, $cantidad)
    {
        $traer = \DB::table('tienda_producto_instituciones')
                ->select([
                        'tienda_producto_instituciones.id_producto as idProducto',
                        'foto_productos.foto as foto',
                        'productos.nombre as nombre',
                        'productos.descripcion as descripcion',
                        'productos.created_at as creado',
                    ])
                ->join('productos','productos.id','=','tienda_producto_instituciones.id_producto')
                ->join('foto_productos','foto_productos.id_producto','=','productos.id')
                ->join('estado_tienda_producto','estado_tienda_producto.id','=','tienda_producto_instituciones.id_estado')
                ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                ->join('institucion','institucion.id','=','tiendas_instituciones.id_institucion')
                ->join('area','area.id','=','tienda_producto_instituciones.id_area')
                ->where('institucion.id','=', $idInst)
                ->orderBy('productos.created_at', 'desc')
                ->paginate($cantidad);

                //return $traer;
               
                    return $traer;
                
    }
    protected function detalleProducto($id)
    {
        $traer = \DB::table('tienda_producto_instituciones')
                ->select([
                        'tienda_producto_instituciones.id_producto as idProducto',
                        'foto_productos.foto as foto',
                        'productos.nombre as nombre',
                        'productos.descripcion as descripcion',
                        'productos.created_at as creado',
                        'estado_tienda_producto.estado as estadoProducto',
                        'area.nombre as nombreArea',
                        'productos.cantidad as cantidad',
                        'categoria_productos.nombre as nombreCategoria',
                        'productos.precio as precio'
                    ])
                ->join('productos','productos.id','=','tienda_producto_instituciones.id_producto')
                 ->join('foto_productos','foto_productos.id_producto','=','productos.id')
                ->join('estado_tienda_producto','estado_tienda_producto.id','=','tienda_producto_instituciones.id_estado')
                ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                ->join('institucion','institucion.id','=','tiendas_instituciones.id_institucion')
                ->join('categoria_productos','categoria_productos.id','=','productos.id_categoria')
                ->join('area','area.id','=','tienda_producto_instituciones.id_area')
                ->where('tienda_producto_instituciones.id_producto','=', $id)
                ->where('Institucion.id','=', \Auth::guard('institucion')->user()->id)/*AGREGADA QUISAS DE ERRORES*/
                 ->orderBy('productos.created_at', 'desc')/*Posible error*/
                ->paginate(2);

                return $traer;
    }
     protected function detalleProducto_area($id, $areaId)
    {
        $traer = \DB::table('tienda_producto_instituciones')
                ->select([
                        'tienda_producto_instituciones.id_producto as idProducto',
                        'foto_productos.foto as foto',
                        'productos.nombre as nombre',
                        'productos.descripcion as descripcion',
                        'productos.created_at as creado',
                        'estado_tienda_producto.estado as estadoProducto',
                        'area.nombre as nombreArea',
                        'productos.cantidad as cantidad',
                        'categoria_productos.nombre as nombreCategoria',
                        'productos.precio as precio'
                    ])
                ->join('productos','productos.id','=','tienda_producto_instituciones.id_producto')
                 ->join('foto_productos','foto_productos.id_producto','=','productos.id')
                ->join('estado_tienda_producto','estado_tienda_producto.id','=','tienda_producto_instituciones.id_estado')
                ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                ->join('institucion','institucion.id','=','tiendas_instituciones.id_institucion')
                ->join('categoria_productos','categoria_productos.id','=','productos.id_categoria')
                ->join('area','area.id','=','tienda_producto_instituciones.id_area')
                ->where('tienda_producto_instituciones.id_producto','=', $id)
                ->where('area.id','=', $areaId)/*AGREGADA QUISAS DE ERRORES*/
                ->paginate(2);

                return $traer;
    }
    protected function borrar($idP)
    {
        $tpi = \DB::table('productos')->where('id', '=', $idP)->delete();
        return $tpi;
    }
    protected function actualizar_nombre($dato)
    {
        $pi = producto::find($dato->idProducto);
        $pi->nombre = $dato->nombre;
        if ($pi->save()) {
            return true;
        }
        return false;
    }
    protected function actualizar_descripcion($dato)
    {
        $pi = producto_institucion::find($dato->idProducto);
        $pi->descripcion = $dato->descripcion;
        if ($pi->save()) {
            return true;
        }
        return false;
    }
    protected function actualizar_precio($dato)
    {
        $pi = producto_institucion::find($dato->idProducto);
        $pi->precio = $dato->precio;
        if ($pi->save()) {
            return true;
        }
        return false;
    }
    protected function actualizar_cantidad($dato)
    {
        $pi = producto_institucion::find($dato->idProducto);
        $pi->cantidad = $dato->cantidad;
        if ($pi->save()) {
            return true;
        }
        return false;
    }
    protected function actualizar_visibilidad($dato)
    {
        $pi = \DB::table('tienda_producto_instituciones')
                ->where('id_producto', $dato->idProducto)
                ->update(['id_estado' => $dato->estadoV]);

        if (count($pi)>0) {
             return true;
        }   
        return false;     
    }
    protected function actualizar_categoria($dato)
    {
        $pi = producto_institucion::find($dato->idProducto);
        $pi->id_categoria = $dato->categoria;
            if ($pi->save()) {
                return true;
            }
            return false;

    }
    protected function actualizar_area($dato)
    {
        $pi = \DB::table('tienda_producto_instituciones')
                ->where('id_producto', $dato->idProducto)
                ->update(['id_area' => $dato->area]);

        if (count($pi)>0) {
             return true;
        }   
        return false;  
    }
}
