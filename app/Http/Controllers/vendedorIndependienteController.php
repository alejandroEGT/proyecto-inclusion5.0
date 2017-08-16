<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vendedor;

class vendedorIndependienteController extends Controller
{
    public function vista_vendedor()
    {
    	# code...
    }

    public function insertar_vendedorIndependiente(Request $datos)
    {
        $insert = User::insertar_vendedor($datos);
            if ($insert) {
           
            	$id_user = User::where('email','=',"$datos->correo")->get();
            	foreach ($id_user as $id_us) {
            		$forId = $id_us->id;
            		$vendedor = Vendedor::insertar_aprobado($datos, $forId);
            		if ($vendedor) {
            			return "todo oka";
            		}
            	}
            }
    }
}
