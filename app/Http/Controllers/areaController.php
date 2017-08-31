<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\usuarioRequest;
use App\Area;
use App\Sexo;
use App\User;
use App\Usuarioinstitucion;
use App\Institucion;
use App\VendedorInstitucion;
use Illuminate\Support\Facades\Mail;
class areaController extends Controller
{

    public function vista_area(Request $dato)
    {	
    	if ($dato->id == 0) {
            return redirect()->back();
        }

        $area = Area::traer_area($dato->id);
        $sexo = Sexo::all();
        $contarusuarios = VendedorInstitucion::contarVendedores($dato->id);
        $datosVendedor = VendedorInstitucion::datosVendedorInstitucion($area->id);
        return view('institucion.area')
        ->with('area', $area)
        ->with('sexo', $sexo)
        ->with('contar', $contarusuarios)
        ->with('venInstitucion', $datosVendedor);
    }

    public function agregarUsuario(usuarioRequest $datos){
    	
            $existe = Usuarioinstitucion::existeuser($datos->area);
            if(count($existe)){
                return redirect()->back()->withErrors(['Ya existe un usuarion en esta area']);;
            } 

    		$genclave = $this->genclave();
            $correo = $datos->correo;
            \Session::put('usuario',$datos->nombres.' '.$datos->apellidos);//obtener usuario y enviarlo a clave.blade.php
            \Session::put('clave',$genclave);//obtener clave y enviarlo a clave.blade.php
    		$user = User::insertar_userInstitucion($datos, $genclave);
    		if ($user) {
    			$idUser = User::where('email','=', $datos->correo)->get();
    			$userInstitucion = Usuarioinstitucion::insertar($datos, $idUser[0]->id);
    			if($userInstitucion){
                    
                        Mail::send(['text'=>'emails.clave'],['name','janin'],function ($message) use ($correo)
                                      {
                                          $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
                                          $message->to($correo,'to jano');
                                      });
                    

    				return redirect()->back();
    			}
    			return "other error";
    		}
    		return "error";
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

    public function traer_encargado(Request $idArea){

        $user = Usuarioinstitucion::traerUser($idArea[0]);
        return response()->json($user->nombres.' '.$user->apellidos);
    }
}
