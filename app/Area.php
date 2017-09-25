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
    protected function traer_area($id){
        $area = Area::where('id',$id)->where('id_institucion', \Auth::guard('institucion')->user()->id)->get();
    

        if(count($area)>0){
            return $area[0];
        }
        return 0;
    }
    protected function traerArea(){
        $logo = \DB::table('area')
                    ->join('usuario-institucion','usuario-institucion.id_area','=','area.id')
                    ->where('usuario-institucion.id_user','=',\Auth::user()->id)->get();
        return $logo;            
    }
    protected function guardarIcono($datos){

        $url="logoAreas";
        $file = $datos->file('fotoP')->getClientOriginalExtension();
        $imageName = time().'.'.$datos->file('fotoP')->getClientOriginalExtension();//nombre de la imagen como tal.

        $id_area = \DB::table('area')
                    ->join('usuario-institucion','usuario-institucion.id_area','=','area.id')
                    ->where('usuario-institucion.id_user','=',\Auth::user()->id)->get();
        
        
        $area = Area::find($id_area[0]->id_area);
        $area->logo = $url.'/'.$imageName;

        if ($area->save()) {

            $datos->file('fotoP')->move(public_path($url), $imageName);
            return true;
        }        
            return false;
    }
    protected function contarAlumnosPorArea($idarea){

        $contar = \DB::table('vendedor-institucion')->select('id')->where('id_area','=',$idarea)->get();
        return count($contar);
    }
    protected function actualizar_nombre($dato){

        $area = Area::find($dato->idArea);
        $area->nombre = $dato->nombreDeArea;
        if ($area->save()) {
            return true;
        }
        return false;
    }
    protected function actualizar_descripcion($dato){

        $area = Area::find($dato->idArea);
        $area->descripcion = $dato->descripcion;
        if ($area->save()) {
            return true;
        }
        return false;
    }
}
