<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicio extends Model
{
    protected $table = "servicios";
    //public $timestamps = false;

    protected function insertar($datos)
    {
    	$insertar = new servicio;
    	$insertar->nombre = ucfirst($datos->nombre);
    	$insertar->descripcion = ucfirst($datos->descripcion);
        $insertar->id_categoria = $datos->categoria;
    	if ($insertar->save()) {
    		return $insertar->id;
    	}
    	return 0;
    }   
    protected function mostrarServicioDesdeAdmin($inst, $cant)
    {
        $mostrar = \DB::table("servicios")
                    ->select([
                        'servicios.id as id',
                        'foto_servicios.nombre as foto',
                        'servicios.nombre as nombre',
                        'servicios.descripcion as descripcion',
                        'estado_tienda_servicio.estado as nombreEstado',
                        'area.nombre as nombreArea',
                    ])
                    ->join("foto_servicios","foto_servicios.id_servicio","=","servicios.id")
                    ->join("tienda_servicio_instituciones","tienda_servicio_instituciones.id_servicio","=","servicios.id")
                    ->join("tiendas_instituciones","tiendas_instituciones.id","=","tienda_servicio_instituciones.id_tienda")
                    ->join("estado_tienda_servicio","estado_tienda_servicio.id","=","tienda_servicio_instituciones.id_Estado")
                    ->join("institucion","institucion.id","=","tiendas_instituciones.id_institucion")
                    ->join("area","area.id","=","tienda_servicio_instituciones.id_area")
                    ->where('tienda_servicio_instituciones.id_estado', 1)
                    ->where("institucion.id", $inst)
                    ->orderBy('servicios.created_at', 'desc')/*Posible error*/
                    ->paginate($cant);
        return $mostrar;
    }
     protected function mostrarServicioDesdeArea($area, $cant)
    {
        $mostrar = \DB::table("servicios")
                    ->select([
                        'servicios.id as id',
                        'foto_servicios.nombre as foto',
                        'servicios.nombre as nombre',
                        'servicios.descripcion as descripcion',
                        'estado_tienda_servicio.estado as nombreEstado',
                        'area.nombre as nombreArea',
                    ])
                    ->join("foto_servicios","foto_servicios.id_servicio","=","servicios.id")
                    ->join("tienda_servicio_instituciones","tienda_servicio_instituciones.id_servicio","=","servicios.id")
                    ->join("tiendas_instituciones","tiendas_instituciones.id","=","tienda_servicio_instituciones.id_tienda")
                    ->join("estado_tienda_servicio","estado_tienda_servicio.id","=","tienda_servicio_instituciones.id_Estado")
                    ->join("institucion","institucion.id","=","tiendas_instituciones.id_institucion")
                    ->join("area","area.id","=","tienda_servicio_instituciones.id_area")
                    ->where("area.id", $area)
                    ->where('tienda_servicio_instituciones.id_estado', 1)
                    ->orderBy('servicios.created_at', 'desc')/*Posible error*/
                    ->paginate($cant);
        return $mostrar;
    }
    protected function verServicioDesdeArea($area, $cant)
    {
        $mostrar = \DB::table("servicios")
                    ->select([
                        'servicios.id as id',
                        'foto_servicios.nombre as foto',
                        'servicios.nombre as nombre',
                        'servicios.descripcion as descripcion',
                        'estado_tienda_servicio.estado as nombreEstado',
                        'area.nombre as nombreArea',
                    ])
                    ->join("foto_servicios","foto_servicios.id_servicio","=","servicios.id")
                    ->join("tienda_servicio_instituciones","tienda_servicio_instituciones.id_servicio","=","servicios.id")
                    ->join("tiendas_instituciones","tiendas_instituciones.id","=","tienda_servicio_instituciones.id_tienda")
                    ->join("estado_tienda_servicio","estado_tienda_servicio.id","=","tienda_servicio_instituciones.id_Estado")
                    ->join("institucion","institucion.id","=","tiendas_instituciones.id_institucion")
                    ->join("area","area.id","=","tienda_servicio_instituciones.id_area")
                    ->where('tienda_servicio_instituciones.id_estado', 1)
                    ->where("area.id", $area)
                    ->orderBy('servicios.created_at', 'desc')/*Posible error*/
                    ->paginate($cant);
        return $mostrar;
    }

    protected function filtrar_desde_admin($nombre){
        $mostrar = \DB::table("servicios")
                    ->select([
                        'servicios.id as id',
                        'foto_servicios.nombre as foto',
                        'servicios.nombre as nombre',
                        'servicios.descripcion as descripcion',
                        'estado_tienda_servicio.estado as nombreEstado',
                        'area.nombre as nombreArea',
                    ])
                    ->join("foto_servicios","foto_servicios.id_servicio","=","servicios.id")
                    ->join("tienda_servicio_instituciones","tienda_servicio_instituciones.id_servicio","=","servicios.id")
                    ->join("tiendas_instituciones","tiendas_instituciones.id","=","tienda_servicio_instituciones.id_tienda")
                    ->join("estado_tienda_servicio","estado_tienda_servicio.id","=","tienda_servicio_instituciones.id_Estado")
                    ->join("institucion","institucion.id","=","tiendas_instituciones.id_institucion")
                    ->join("area","area.id","=","tienda_servicio_instituciones.id_area")
                    ->where('servicios.nombre','like', '%'.$nombre.'%')
                    ->where('tienda_servicio_instituciones.id_estado', 1)
                    ->where('institucion.id','=', \Auth::guard('institucion')->user()->id)
                    ->get();
                    //->orderBy('productos.created_at', 'desc')/*Posible error*/
                    //->paginate($cant);
        return $mostrar;
    }
    protected function filtrar_desde_encargado($nombre, $area, $institucion){
        $mostrar = \DB::table("servicios")
                    ->select([
                        'servicios.id as id',
                        'foto_servicios.nombre as foto',
                        'servicios.nombre as nombre',
                        'servicios.descripcion as descripcion',
                        'estado_tienda_servicio.estado as nombreEstado',
                        'area.nombre as nombreArea',
                    ])
                    ->join("foto_servicios","foto_servicios.id_servicio","=","servicios.id")
                    ->join("tienda_servicio_instituciones","tienda_servicio_instituciones.id_servicio","=","servicios.id")
                    ->join("tiendas_instituciones","tiendas_instituciones.id","=","tienda_servicio_instituciones.id_tienda")
                    ->join("estado_tienda_servicio","estado_tienda_servicio.id","=","tienda_servicio_instituciones.id_Estado")
                    ->join("institucion","institucion.id","=","tiendas_instituciones.id_institucion")
                    ->join("area","area.id","=","tienda_servicio_instituciones.id_area")
                    ->where('servicios.nombre','like', '%'.$nombre.'%')
                    ->where('tienda_servicio_instituciones.id_estado', 1)
                    ->where('area.id', $area)
                    ->where('institucion.id','=', $institucion)
                    ->get();
                    //->orderBy('productos.created_at', 'desc')/*Posible error*/
                    //->paginate($cant);
        return $mostrar;
    }
    protected function detalleServicio($idServicio, $inst)
    {
        $servicio = \DB::table("servicios")
                    ->select([
                        'servicios.id as id',
                        'foto_servicios.nombre as foto',
                        'servicios.nombre as nombre',
                        'servicios.descripcion as descripcion',
                        'estado_tienda_servicio.estado as nombreEstado',
                        'area.nombre as nombreArea',
                        'categoria_servicio.nombre as nombreCategoria',
                        'servicios.created_at as creado'
                    ])
                    ->join("foto_servicios","foto_servicios.id_servicio","=","servicios.id")
                    ->join("tienda_servicio_instituciones","tienda_servicio_instituciones.id_servicio","=","servicios.id")
                    ->join("tiendas_instituciones","tiendas_instituciones.id","=","tienda_servicio_instituciones.id_tienda")
                    ->join("estado_tienda_servicio","estado_tienda_servicio.id","=","tienda_servicio_instituciones.id_Estado")
                    ->join("institucion","institucion.id","=","tiendas_instituciones.id_institucion")
                    ->join("area","area.id","=","tienda_servicio_instituciones.id_area")
                    ->join("categoria_servicio","categoria_servicio.id","=","servicios.id_categoria")
                    ->where('institucion.id','=', $inst)
                    ->where('servicios.id','=', $idServicio)
                    ->get();
        return $servicio;            

    }
     protected function detalleServicio_desdeArea($idServicio, $inst, $idArea)
    {
        $servicio = \DB::table("servicios")
                    ->select([
                        'servicios.id as id',
                        'foto_servicios.nombre as foto',
                        'servicios.nombre as nombre',
                        'servicios.descripcion as descripcion',
                        'estado_tienda_servicio.estado as nombreEstado',
                        'area.nombre as nombreArea',
                        'categoria_servicio.nombre as nombreCategoria',
                        'servicios.created_at as creado'
                    ])
                    ->join("foto_servicios","foto_servicios.id_servicio","=","servicios.id")
                    ->join("tienda_servicio_instituciones","tienda_servicio_instituciones.id_servicio","=","servicios.id")
                    ->join("tiendas_instituciones","tiendas_instituciones.id","=","tienda_servicio_instituciones.id_tienda")
                    ->join("estado_tienda_servicio","estado_tienda_servicio.id","=","tienda_servicio_instituciones.id_Estado")
                    ->join("institucion","institucion.id","=","tiendas_instituciones.id_institucion")
                    ->join("area","area.id","=","tienda_servicio_instituciones.id_area")
                    ->join("categoria_servicio","categoria_servicio.id","=","servicios.id_categoria")
                    ->where("area.id", $idArea)
                    ->where('institucion.id','=', $inst)
                    ->where('servicios.id','=', $idServicio)
                    ->get();
        return $servicio;            

    }
    protected function serviciosOcultosDesdeAdmin()
    {
         $mostrar = \DB::table("servicios")
                    ->select([
                        'servicios.id as id',
                        'foto_servicios.nombre as foto',
                        'servicios.nombre as nombre',
                        'servicios.descripcion as descripcion',
                        'categoria_servicio.nombre as nombreCategoria',
                        'estado_tienda_servicio.estado as nombreEstado',
                        'area.nombre as nombreArea',
                    ])
                    ->join("foto_servicios","foto_servicios.id_servicio","=","servicios.id")
                    ->join("tienda_servicio_instituciones","tienda_servicio_instituciones.id_servicio","=","servicios.id")
                    ->join("tiendas_instituciones","tiendas_instituciones.id","=","tienda_servicio_instituciones.id_tienda")
                    ->join("estado_tienda_servicio","estado_tienda_servicio.id","=","tienda_servicio_instituciones.id_Estado")
                    ->join("institucion","institucion.id","=","tiendas_instituciones.id_institucion")
                    ->join("area","area.id","=","tienda_servicio_instituciones.id_area")
                    ->join("categoria_servicio", "categoria_servicio.id","=","servicios.id_categoria")
                    ->where('institucion.id','=', \Auth::guard('institucion')->user()->id)
                    ->where('tienda_servicio_instituciones.id_estado', 2)
                    ->get();
                    //->orderBy('productos.created_at', 'desc')/*Posible error*/
                    //->paginate($cant);
        return $mostrar;
    }
     protected function serviciosOcultosDesdeArea($institucion, $area)
    {
         $mostrar = \DB::table("servicios")
                    ->select([
                        'servicios.id as id',
                        'foto_servicios.nombre as foto',
                        'servicios.nombre as nombre',
                        'servicios.descripcion as descripcion',
                        'categoria_servicio.nombre as nombreCategoria',
                        'estado_tienda_servicio.estado as nombreEstado',
                        'area.nombre as nombreArea',
                    ])
                    ->join("foto_servicios","foto_servicios.id_servicio","=","servicios.id")
                    ->join("tienda_servicio_instituciones","tienda_servicio_instituciones.id_servicio","=","servicios.id")
                    ->join("tiendas_instituciones","tiendas_instituciones.id","=","tienda_servicio_instituciones.id_tienda")
                    ->join("estado_tienda_servicio","estado_tienda_servicio.id","=","tienda_servicio_instituciones.id_Estado")
                    ->join("institucion","institucion.id","=","tiendas_instituciones.id_institucion")
                    ->join("area","area.id","=","tienda_servicio_instituciones.id_area")
                    ->join("categoria_servicio", "categoria_servicio.id","=","servicios.id_categoria")
                    ->where('institucion.id','=', $institucion)
                    ->where('area.id', $area)
                    ->where('tienda_servicio_instituciones.id_estado', 2)
                    ->get();
                    //->orderBy('productos.created_at', 'desc')/*Posible error*/
                    //->paginate($cant);
        return $mostrar;
    }
    protected function traer_ServicioEnEspera($idInst, $cant)
    {
        $mostrar = \DB::table("servicios")
                    ->select([
                        'servicios.id as id',
                        'foto_servicios.nombre as foto',
                        'servicios.nombre as nombre',
                        'servicios.descripcion as descripcion',
                        'estado_tienda_servicio.estado as nombreEstado',
                        'area.nombre as nombreArea',
                        'servicios.created_at as creado'
                    ])
                    ->join("foto_servicios","foto_servicios.id_servicio","=","servicios.id")
                    ->join("tienda_servicio_instituciones","tienda_servicio_instituciones.id_servicio","=","servicios.id")
                    ->join("tiendas_instituciones","tiendas_instituciones.id","=","tienda_servicio_instituciones.id_tienda")
                    ->join("estado_tienda_servicio","estado_tienda_servicio.id","=","tienda_servicio_instituciones.id_Estado")
                    ->join("institucion","institucion.id","=","tiendas_instituciones.id_institucion")
                    ->join("area","area.id","=","tienda_servicio_instituciones.id_area")
                    ->where('tienda_servicio_instituciones.id_estado', 3)
                    ->where("institucion.id", $idInst)
                    ->orderBy('servicios.created_at', 'desc')/*Posible error*/
                    ->paginate($cant);
        return $mostrar;
    }
     protected function traer_ServicioEnEspera_desdeArea($idInst,$idArea, $cant)
    {
        $mostrar = \DB::table("servicios")
                    ->select([
                        'servicios.id as id',
                        'foto_servicios.nombre as foto',
                        'servicios.nombre as nombre',
                        'servicios.descripcion as descripcion',
                        'estado_tienda_servicio.estado as nombreEstado',
                        'area.nombre as nombreArea',
                        'servicios.created_at as creado'
                    ])
                    ->join("foto_servicios","foto_servicios.id_servicio","=","servicios.id")
                    ->join("tienda_servicio_instituciones","tienda_servicio_instituciones.id_servicio","=","servicios.id")
                    ->join("tiendas_instituciones","tiendas_instituciones.id","=","tienda_servicio_instituciones.id_tienda")
                    ->join("estado_tienda_servicio","estado_tienda_servicio.id","=","tienda_servicio_instituciones.id_Estado")
                    ->join("institucion","institucion.id","=","tiendas_instituciones.id_institucion")
                    ->join("area","area.id","=","tienda_servicio_instituciones.id_area")
                    ->where('tienda_servicio_instituciones.id_estado', 3)
                    ->where("institucion.id", $idInst)
                    ->where("area.id", $idArea)
                    ->orderBy('servicios.created_at', 'desc')/*Posible error*/
                    ->paginate($cant);
        return $mostrar;
    }
    protected function borrar($idS)
    {
        $tpi = \DB::table('servicios')->where('id', '=', $idS)->delete();
        return $tpi;
    }
}
