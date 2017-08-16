<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vendedor;
use App\VendedorInstitucion;
use App\User;
class vendedorDependienteController extends Controller
{
    public function vista_inicio()
    {
            $estado;
            $verificEstado = Vendedor::verificEstado(\Auth::user()->id);
          
            foreach ($verificEstado as $verific) {
                $estado = $verific->id_estado;
            }
            \Session::put('estado', $estado);
            
        	return view('vendedorDependiente.inicio');
    }

    public function insertar(Request $datos){

        	$us = User::insertar_vendedorDependiente($datos);

        	if($us){

        		$id_us = User::where('email','=',"$datos->correo")->get();
        		foreach ($id_us as $id) {
        			
        			$forId = $id->id;
        			//dd($forId);
        			$ven = Vendedor::insertar_esperando($datos, $forId);
        			if($ven){

        				$id_ven = Vendedor::filtrar($forId);
        				
        				foreach ($id_ven as $idV) {
        					
        						$forId_ven = $idV->id;
        					
        						$venDependiente = VendedorInstitucion::insertar($datos, $forId_ven);

    		    				if($venDependiente){
    		    						return "ok";
    		    				}
        						return "falso en venDependiente";
        				}
        			}
        			return "falso en ven";
        		}

        	}
        	return "falso en us";
    }

    static function fotoPerfil(){

            $id_ven = VendedorInstitucion::idVendedor(\Auth::user()->id);

            foreach ($id_ven as $idVen) {
                $id_v = $idVen->id;

                 $foto = VendedorInstitucion::traerFoto($id_v);
                 
                 

                 if (count($foto)) {
                    foreach ($foto as $f) {
                        return response()->json($f->foto);
                    }
                 }
                 $foto = "ico/default-avatar.png";
                 return response()->json($foto);
           
             }
            

    }
}
