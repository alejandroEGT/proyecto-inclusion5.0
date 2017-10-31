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
use App\Fotoperfil;
use App\Tienda_producto_institucion;
use App\Tienda_servicio_institucion;    
use Illuminate\Support\Facades\Mail;
use App\Passwordcuenta;
class areaController extends Controller
{

    public function vista_area(Request $dato)
    {	
       
        try{
            if ($dato->id == 0) {
                return redirect()->back();
            }
            $area = Area::traer_area($dato->id);
            
            $sexo = Sexo::all();
            $contarusuarios = VendedorInstitucion::contarVendedores($dato->id);
            $contarproductos = Tienda_producto_institucion::contarproductos($area->id, \Auth::guard('institucion')->user()->id);
            $contarServ = Tienda_servicio_institucion::contarservicio($area->id, \Auth::guard('institucion')->user()->id);

            $datosVendedor = VendedorInstitucion::datosVendedorInstitucion($area->id);
            $productos = Tienda_producto_institucion::mostrarProductosArea($area->id, \Auth::guard('institucion')->user()->id);
            $servicios = Tienda_servicio_institucion::mostrarServiciosArea($area->id, \Auth::guard('institucion')->user()->id);
            //dd($servicios);
            return view('institucion.area')
            ->with('area', $area)
            ->with('sexo', $sexo)
            ->with('contarP', $contarusuarios)
            ->with('contarS', $contarServ)
            ->with('contarProd', $contarproductos)
            ->with('productos', $productos)
            ->with('servicios', $servicios)
            ->with('venInstitucion', $datosVendedor);
           
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back();
        }
        catch (\Exception $e) {
            return "<center><h3>Si alguien te dijo que jugaras a romper el sistema, no le creas, te esta engañando</h3></center>";
        }

        
    }

    public function agregarUsuario(usuarioRequest $datos){

    try{
    	
            $existe = Usuarioinstitucion::existeuser($datos->area);
            if(count($existe)){
                return redirect()->back()->withErrors(['Ya existe un usuarion en esta area']);
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
                        $foto = Fotoperfil::fotoDefault($idUser[0]->id);
                        if ($foto) {
                            $passwordDefault = Passwordcuenta::insertar_clave_default($idUser[0]->id);
                            if ($passwordDefault) {
                                Mail::send(['html'=>'emails.clave'],['name','EAE'],function ($message) use ($correo)
                                {
                                    $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
                                    $message->to($correo,'to jano');
                                });
                                //return "Todo bien....";
                                \Session::flash('ingreso', 'Encargado registrado');
                                return redirect()->back();
                            }
                                
                        }
                        $datos->flash();
    				    return redirect()->back();
    			}
    			$datos->flash();
                        return redirect()->back();
    		}
    		$datos->flash();
                        return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {

            $user = User::where('email', $datos->correo)->delete();
            $datos->flash();
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }  
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

        //return $idArea[0];
        $user = Usuarioinstitucion::traerUser($idArea[0]);
        return response()->json([$user->idUser ,$user->nombre, $user->estado, $user->email]);
    }
}
