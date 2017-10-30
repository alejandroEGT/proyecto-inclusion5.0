<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = "area";

    protected function insertar($datos){


       $area = new Area;

    		$area->id_institucion = \Auth::guard("institucion")->user()->id;
    		$area->nombre = ucfirst($datos->nombre);
    		$area->descripcion = ucfirst($datos->desc);
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
    protected function traer_aerea_para_alumno()
    {
        $area = \DB::table('area')
                    ->join('vendedor-institucion','vendedor-institucion.id_area','=','area.id')
                    ->join('vendedor', 'vendedor.id', '=', 'vendedor-institucion.id_vendedor')
                    ->where('vendedor.id_user','=',\Auth::user()->id)->get();
        return $area; 
    }
    protected function guardarIcono($datos, $idInstitucion, $idArea){

        $url="logoAreas";
        $file = $datos->file('logo')->getClientOriginalExtension();
        $imageName = time().'.'.$datos->file('logo')->getClientOriginalExtension();//nombre de la imagen como tal.
        $area = Area::find($idArea);

        //dd($getLogo->logo );
        if ($area->logo == null) {

            $area->logo = $url.'/'.$imageName;

            if ($area->save()) {

                $datos->file('logo')->move(public_path($url), $imageName);
                return true;
            }        
                return false;
        }

        \File::delete($area->logo);/*ELIMINAR logo*/
        $area->logo = $url.'/'.$imageName;
        if ($area->save()) {
        
                $datos->file('logo')->move(public_path($url), $imageName);
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
        $area->nombre = ucfirst($dato->nombreDeArea);
        if ($area->save()) {
            return true;
        }
        return false;
    }
    protected function actualizar_descripcion($dato){

        $area = Area::find($dato->idArea);
        $area->descripcion = ucfirst($dato->descripcion);
        if ($area->save()) {
            return true;
        }
        return false;
    }
}
