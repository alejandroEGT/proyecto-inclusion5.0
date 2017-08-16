<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institucion;
use App\Area;
use App\Sexo;
class invitadoController extends Controller
{
    public function vista_registros(){

    	 	return view('invitado.multiRegistro');
    }
    public function vista_formUser(){
    		$sexo = Sexo::all();
    		return view('invitado.form_Usuario')->with('sexo',$sexo);
    }
    public function vista_formUserInstituto(){
            $institucion = Institucion::all();
            $sexo = Sexo::all();
    		return view('invitado.form_usuario_institucion')
            ->with('institucion', $institucion)
            ->with('sexo', $sexo);
    }
    public function vista_formInstitucion(){
    		return view('invitado.form_institucion');
    }
    public function vista_proyecto()
    {
            return view('invitado.multiRegistro');
    }
    public function vista_ayuda()
    {
            return view('invitado.ayuda');
    }


    public function filtroArea(Request $dato){
            $area = Area::where('id_institucion','=',$dato->id)->get();
            return response()->json($area);
    }
}