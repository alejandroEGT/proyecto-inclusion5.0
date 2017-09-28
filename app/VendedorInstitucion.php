<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendedorInstitucion extends Model
{
    protected $table = "vendedor-institucion";


    protected function insertar($datos, $id_ven){

    	$vendedor = new VendedorInstitucion;

        $vendedor->id_vendedor = $id_ven;
        $vendedor->id_institucion = $datos->id_institucion;
        $vendedor->id_area = $datos->id_area;

    	if($vendedor->save()){
    		return true;
    	}
    	return true;

    }
    protected function insertar_dentro($datos, $id_ven)
    {
        $vendedor = new VendedorInstitucion;

        $vendedor->id_vendedor = $id_ven;
        $vendedor->id_institucion = \Auth::guard('institucion')->user()->id;
        $vendedor->id_area = $datos->id_area;

        if($vendedor->save()){
            return true;
        }
        return true;
    }
    protected function insertar_desde_area($datos, $id_ven)
    {
        $vendedor = new VendedorInstitucion;

        $vendedor->id_vendedor = $id_ven;
        $vendedor->id_institucion = $datos->idInstitucion;
        $vendedor->id_area = $datos->idArea;

        if($vendedor->save()){
            return true;
        }
        return true;
    }
    protected function idVendedor($id){

        $id = \DB::select("select * from `vendedor` where id_user = ".$id);
        return $id;
    }
    protected function traerFoto ($id){

        //return $id;
       $id = \DB::select("CALL `traerFotoPerfil`('".$id."'');");
        return $id;
    }
    protected function contarVendedores($id){

        $contar = \DB::select("CALL `contarVendedoresInstitucionales`(".$id.");");
        return $contar[0]->contar;
    }
    
    protected function fotoVendedorInstitucion(){

        $datos = \DB::select("CALL `fotoVendedorInstitucional`(".\Auth::user()->id.");");
        return $datos[0]->foto;

    }
    protected function datosVendedorInstitucion($idArea){

        $datos = \DB::select("CALL `datosVendedorInstitucion`(".$idArea.");");
        if ($datos) {
            return $datos;
        }
        return null;
        
    }

    protected function traerEstadoClave(){

        $estado = \DB::table('password-cuenta')->where('id_user', \Auth::user()->id )->get(); 
        return $estado[0]->id_estado;
    }

}
