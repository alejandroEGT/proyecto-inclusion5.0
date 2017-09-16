<?php

namespace App\Http\Controllers;

use App\Http\Requests\institucionRequest;
use App\Institucion;
use App\User;
use Illuminate\Http\Request;

class crud_institucionController extends Controller
{
    public function insertar(institucionRequest $datos)
    {
    	$datos->flash();
    	$retornar = Institucion::insertar($datos);

    	if($retornar > 0){
    		return 1;
    	}
    	return 0;
}
 }
