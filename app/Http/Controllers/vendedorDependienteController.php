<?php

namespace App\Http\Controllers;

use App\Http\Requests\agregaralumnoRequest;
use App\User;
<<<<<<< HEAD
use App\VendedorInstitucion;
use App\vendedor;
use Illuminate\Http\Request;

=======
use App\Fotoperfil;
>>>>>>> a796c04fbe11c5cd8ca4c2046c9880f7ba92401a
class vendedorDependienteController extends Controller
{
    public function vista_inicio()
    {       
            $foto = Fotoperfil::traerFoto();
            $verificEstado = Vendedor::verificEstado(\Auth::user()->id);
             $estado = $verificEstado[0]->id_estado;
            \Session::put('estado', $estado);
            
        	return view('vendedorDependiente.inicio')->with('foto', $foto);
    }
    public function vista_cambiarFoto()
    {
        return view('vendedorDependiente.cambiarFoto');
    }

    public function insertar(agregaralumnoRequest $datos){

            $us = User::insertar_vendedorDependiente($datos);
        	
             if($us){
                    $id_us = User::where('email','=',"$datos->correo")->get();
                    $ven = Vendedor::insertar_esperando($datos, $id_us[0]->id);
                     if($ven){

                            $id_ven = Vendedor::filtrar($id_us[0]->id); 
                            $venDependiente = VendedorInstitucion::insertar($datos, $id_ven[0]->id);
                              if($venDependiente){

                                        $id_vendedor = Vendedor::idVendedor($id_us[0]->id);
                                        $foto = Fotoperfil::fotoDefault($id_vendedor[0]->id);
                                        if ($foto) 
                                        {
                                            return "ok";
                                        }
                                }

                     }

             }
    }                          

    public function traerFotoVendedor(){

        $dato = VendedorInstitucion::fotoVendedorInstitucion();
        return $dato;
    }
    public function guardar_foto(request $dato)
    {   

        $guardar = Fotoperfil::guardar($dato);
        return $guardar;
    }
}
           
             
