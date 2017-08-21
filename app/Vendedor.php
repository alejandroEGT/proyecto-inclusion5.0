<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = "vendedor";

    protected $fillable = [
        'id',
    ];

     protected function insertar_aprobado($datos, $idUser){

        $date = new \DateTime($datos->get('dia').'-'.$datos->get('mes').'-'.$datos->get('anio'));
        $vendedor = new Vendedor;
        $vendedor->id_user = $idUser;
        $vendedor->telefono = $datos->telefono;
        $vendedor->fecha_nac = $date->format('Y-m-d');
        $vendedor->id_estado = "1";/* Aceptado*/

        if($vendedor->save()){
            return true;
        }
        return false;

    }
     protected function insertar_esperando($datos, $idUser){

        $date = new \DateTime($datos->get('dia').'-'.$datos->get('mes').'-'.$datos->get('anio'));
        $vendedor = new Vendedor;
        $vendedor->id_user = $idUser;
        $vendedor->telefono = $datos->telefono;
        $vendedor->fecha_nac = $date->format('Y-m-d');
        $vendedor->id_estado = "2";/* esperando*/

        if($vendedor->save()){
            return true;
        }
        return false;

    }
    protected function filtrar($idUser){
    	$filtro = \DB::table('vendedor')->select('id')->where('id_user','=', $idUser)->get();
    	return $filtro;
    }

    protected function verificEstado($idUser){
        $estado = \DB::table('vendedor')->select('id_estado')->where('id_user','=', $idUser)->get();
        return $estado;
    }

    protected function aceptarusuario($id){
        $aceptar = \DB::update("update `vendedor` set id_estado = 1 where id_user = ".$id);
        return $aceptar;
    }
    protected function verificarVendedor($correo){

        $verificar = \DB::select(" CALL `verificarVendedorInstitucional`('".$correo."');");
        return $verificar;
    }
    protected function idVendedor($id){
        
         $id = \DB::select("select * from `vendedor` where id_user = ".$id);
        return $id;
    }
}
