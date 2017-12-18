<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContadorInstitucion extends Model
{
    protected $table = "contador_tiendas_instituciones";

    protected function trearFechas($id_institucion){

    	$traer = \DB::table('contador_tiendas_instituciones')
    			->selectRaw('date(contador_tiendas_instituciones.updated_at) as fecha')
    			->join('tiendas_instituciones','tiendas_instituciones.id','=','contador_tiendas_instituciones.id_tienda')
    			->where('tiendas_instituciones.id_institucion', $id_institucion)
                ->distinct()->groupBy('contador_tiendas_instituciones.updated_at')->get();

        return $traer;
    }

    protected function traerVistasPorFechas($id_institucion, $fecha)
    {
    	$traer = \DB::table('contador_tiendas_instituciones')
    			->selectRaw('sum(cantidad) as sumaCantidad')
    			/*->selectRaw('date(contador_tiendas_instituciones.created_at) as fecha')*/
    			->join('tiendas_instituciones','tiendas_instituciones.id','=','contador_tiendas_instituciones.id_tienda')
    			->where('tiendas_instituciones.id_institucion', $id_institucion)
    			->whereRaw("DATE(contador_tiendas_instituciones.updated_at) = '".$fecha."'")
                ->distinct()->first();

        return $traer;

    }
    protected function fecha_mas_activa($id_institucion)
    {
    	$traer = \DB::table('contador_tiendas_instituciones')
    			->join('tiendas_instituciones','tiendas_instituciones.id','=','contador_tiendas_instituciones.id_tienda')
    			->where('tiendas_instituciones.id_institucion', $id_institucion)
    	        ->get();

    	return $traer;
    }

    protected function sumar_por_ciudad($id_institucion, $ciudad)
    {
        $traer = \DB::table('contador_tiendas_instituciones')
                ->selectRaw("sum(contador_tiendas_instituciones.cantidad) as suma, concat(ciudad,',',region,' de ',pais) as 'ubicación'")
                ->join('tiendas_instituciones','tiendas_instituciones.id','contador_tiendas_instituciones.id_tienda')
                ->where('tiendas_instituciones.id_institucion', $id_institucion)
                ->where('ciudad', $ciudad)
                ->groupBy('ubicación')->first();
        return $traer;        
    }
    protected function ciudad($id_institucion, $pais)
    {
        $traer = \DB::table('contador_tiendas_instituciones')
                ->select('ciudad')
                ->join('tiendas_instituciones','tiendas_instituciones.id','contador_tiendas_instituciones.id_tienda')
                ->where('tiendas_instituciones.id_institucion', $id_institucion)
                ->where('contador_tiendas_instituciones.codigo_pais', $pais)
                ->distinct()->get();
        return $traer; 
        
    }
    protected function paices($id_institucion)
    {
       $traer = \DB::table('contador_tiendas_instituciones')
                ->select('codigo_pais')
                ->join('tiendas_instituciones','tiendas_instituciones.id','contador_tiendas_instituciones.id_tienda')
                ->where('tiendas_instituciones.id_institucion', $id_institucion)
                ->distinct()->get();
        return $traer;   
    }
}
