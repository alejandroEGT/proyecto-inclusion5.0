<?php

namespace App\Http\Controllers;

use App\Http\Requests\agregaralumnoRequest;
use App\User;
use App\Vendedor;
use Illuminate\Http\Request;


class vendedorIndependienteController extends Controller
{
    public function vista_vendedor()
    {
    	# code...
    }

     public function insertar_vendedorIndependiente(agregaralumnoRequest $datos)
    {
        $insert = User::insertar_vendedor($datos);
        if ($insert) {
           
            $id_user = User::where('email','=',"$datos->correo")->get();
                
            $vendedor = Vendedor::insertar_aprobado($datos, $id_user[0]->id);
            if ($vendedor) {
                return "todo oka";
            }        
        }
    }
}
