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
    protected function idVendedor($id){

        $id = \DB::select("select * from `vendedor` where id_user = ".$id);
        return $id;
    }
    protected function traerFoto ($id){

        //return $id;
       $id = \DB::select("CALL `traerFotoPerfil`('".$id."'');");
        return $id;
    }

    

}
