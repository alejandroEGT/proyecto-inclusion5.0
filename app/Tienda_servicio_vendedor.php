<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda_servicio_vendedor extends Model
{
    protected $table = "tienda_servicios_vendedor";

     protected function insertar($idS, $idTienda, $getID)
    {
    	$insertar = new Tienda_servicio_vendedor;

    	$insertar->id_servicio = $idS;
    	$insertar->id_tienda = $idTienda;
    	$insertar->id_estado = $getID;/*Valor por default*/

    	if ($insertar->save()) {

    		return 1;
    	}
    	 return 0;
    }


    protected function mostrar_servicios_vendedor($id){

    	 $servicio = \DB::table('servicios')
         ->select([
         		'servicios.id as idServicio',
                'servicios.nombre as nombreServicio',
                'servicios.descripcion as descripcion',
                'servicios.id_categoria as categoria',
                'foto_servicios.id as idFoto',
                'foto_servicios.nombre as foto',
                'tienda_servicios_vendedor.created_at as creado'
         ])

          ->join('foto_servicios','servicios.id','=','foto_servicios.id_servicio')
          ->join('tienda_servicios_vendedor','servicios.id','=','tienda_servicios_vendedor.id_servicio')
          ->join('tienda_vendedor','tienda_vendedor.id','=','Tienda_servicios_vendedor.id_tienda')
          ->join('estado_tienda_servicio','tienda_servicios_vendedor.id_estado','=','estado_tienda_servicio.id')
          ->where('tienda_servicios_vendedor.id_estado',1)
          ->where('tienda_vendedor.id_vendedor', $id)->paginate(5);
           return $servicio;
    }

     protected function borrar($idS)
    {
        $serv = Tienda_servicio_vendedor::where('id_servicio', $idS)->update([
                    'id_estado' => 4
        ]);

        return $serv;
    }
}
