<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\institutoRequest;
use App\User;
use App\Institucion;

class crud_institucionController extends Controller
{
    public function insertar(institutoRequest $datos)
    {
    	$retornar = Institucion::insertar($datos);

    	if($retornar > 0){
    		return 1;
    	}
    	return 0;
    }
}
