<?php

namespace App\Http\Controllers;

use App\Fotoperfil;
use App\Http\Requests\FormUsuarioRequest;
use App\User;
use App\Vendedor;
use Illuminate\Http\Request;


class vendedorIndependienteController extends Controller
{
    public function vista_inicio()
    {
        $foto = Fotoperfil::traerFoto();
    	return view('vendedorIndependiente.inicio')->with('foto', $foto);
    }
    public function vista_cambiarFoto(){
        return view('vendedorIndependiente.cambiarFoto');
    }

     public function insertar_vendedorIndependiente(FormUsuarioRequest $datos)
    {
        $insert = User::insertar_vendedor($datos);
        if ($insert) {
           
            $id_user = User::where('email','=',"$datos->correo")->get();
                
            $vendedor = Vendedor::insertar_aprobado($datos, $id_user[0]->id);
            if ($vendedor) {
                    $id_vendedor = Vendedor::idVendedor($id_user[0]->id);

                    $foto = Fotoperfil::fotoDefault($id_vendedor[0]->id);
                    if ($foto) {
                        return "ok";
                    }
                    return "error";
            }        
        }
        return "error";
    }
     public function traerFotoVendedor(){

        $dato = Vendedor::fotoVendedor();
        return $dato;
    }
    public function guardar_foto(Request $dato)
    {   

        $guardar = Fotoperfil::guardar($dato);
        return $guardar;
    }
}


