<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = "area";

    protected function insertar($datos){


       $area = new Area;

    		$area->id_institucion = \Auth::guard("institucion")->user()->id;
    		$area->nombre = $datos->nombre;
    		$area->descripcion = $datos->desc;
        	if($area->save()){
        		return 1;
        	}
        	return 0;

    }

    protected function traer(){
        $area = Area::where('id_institucion','=',\Auth::guard("institucion")->user()->id)->get();
        return $area;
    }
}
