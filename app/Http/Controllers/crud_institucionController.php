<?php

namespace App\Http\Controllers;

use App\Http\Requests\institucionRequest;
use App\Institucion;
use App\User;
use App\Tienda_institucion;
use Illuminate\Http\Request;

class crud_institucionController extends Controller
{
    public function insertar(institucionRequest $datos)
    {
    	$datos->flash();
    	$retornar = Institucion::insertar($datos);

    	if($retornar > 0){

    		$idInstitucion = Institucion::where('email', $datos->correo)->get();

    		$creartienda = Tienda_institucion::insertar($idInstitucion[0]->id);
    		if ($creartienda) {
    			\Session::flash('ingresado', 'Institución registrada');
    			return redirect()->back();
    		}
    		return redirect()->back()->withErrors(['Algo salió mal']);
    	}
    	return redirect()->back()->withErrors(['Algo salió mal']);
}
 }
