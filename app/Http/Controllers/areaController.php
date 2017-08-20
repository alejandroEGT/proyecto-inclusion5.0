<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\usuarioRequest;
use App\Area;
use App\Sexo;
use App\User;
use App\Usuarioinstitucion;
use App\Institucion;
class areaController extends Controller
{

    public function vista_area(Request $dato)
    {
    	
    	$area = Area::traer_area($dato->id);
    	$sexo = Sexo::all();
    	return view('institucion.area')->with('area', $area)->with('sexo', $sexo);
    }

    public function agregarUsuario(usuarioRequest $datos){
    		//$idArea:: Area::
            $existe = Usuarioinstitucion::existeuser($datos->area);
            if(count($existe)){
                //return "existe alguien";
                return redirect()->back()->withErrors(['Ya existe un usuarion en esta area']);;
            } 
            //return "no existe nadie";

    		$claveGen = $this->genclave();
    		$user = User::insertar_userInstitucion($datos, $claveGen);
    		if ($user) {
    			$idUser = User::where('email','=', $datos->correo)->get();

    			$userInstitucion = Usuarioinstitucion::insertar($datos, $idUser[0]->id);
    			if($userInstitucion){
    				return redirect()->back();
    			}
    			return "other kkck";
    		}
    		return "kkck";
    }


    public function genclave(){
    	$cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  		$cadena_base .= '0123456789' ;
  		$cadena_base .= 'kkck';
 
  		$password = '';
  		$limite = strlen($cadena_base) - 1;
 
  		for ($i=0; $i < 13; $i++)
    		$password .= $cadena_base[rand(0, $limite)];
 
  			return $password;
    }

    /*Peticiones ajax mediante vue y vue-resource */

    public function traer_encargado(request $idArea){

        //return $idArea[0];
        $user = Usuarioinstitucion::traerUser($idArea[0]);
        return response()->json($user->nombres.' '.$user->apellidos);

    }
}
