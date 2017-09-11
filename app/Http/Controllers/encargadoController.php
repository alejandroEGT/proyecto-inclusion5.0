<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fotoperfil;
use App\Passwordcuenta;
use App\User;
use App\Area;
use App\Encargado;
use Illuminate\Support\Facades\Mail;

class encargadoController extends Controller
{
    public function vista_inicio()
    {

    	$foto = Fotoperfil::traerFoto();
        $estado_password = Passwordcuenta::traerEstado();
        $logo = Area::traerArea();
    	return view('encargadoArea.inicio')
        ->with('foto',$foto)
        ->with('estado_password',$estado_password)
        ->with('logo', $logo[0]->logo);
    }
    public function vista_datosArea(){
         $datos =  Encargado::traerDatos();     
            return view('encargadoArea.datosArea')->with('datos', $datos[0]);
    }

    public function vista_equipo(){

        return view('encargadoArea.equipo');
    }

    public function vista_publicarproducto(){
            return view('encargadoArea.publicarProducto');
    }

    public function vista_clave(){
            return view('encargadoArea.clave');
    }

    public function traerFotoVendedor()
    {
    	 $dato = Fotoperfil::traerFoto();
        return $dato;
    }
    public function actializar_clave(request $dato){

        $this->validate($dato,
            [
            'nuevaclave' => 'required',
            'rnuevaclave' => 'required|same:nuevaclave',
        ]);
        $evitarMismaClave = User::find(\Auth::user()->id);


        if (\Hash::check($dato->nuevaclave, $evitarMismaClave->password)) {
                return redirect()->back()->withErrors('Clave actualmente usada por usted');
        }
        $actualiza_clave = User::find(\Auth::user()->id);

                $actualiza_clave->password = \Hash::make($dato->nuevaclave);

                if ($actualiza_clave->save()) {
                    $actualiza_pass = Passwordcuenta::insertar_clave_nueva();

                    $correo = \Auth::user()->email;

                        Mail::send(['text'=>'emails.cambioClave'],['name','janin'],function ($message) use ($correo)
                        {
                            $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
                            $message->to($correo,'to jano');
                        });


                    return redirect()->back();
                }
                return "Error...";

    }

    public function traerDatdos(){

        $datos =  Encargado::traerDatos();  
        return $datos;    
    }

    public function traerNombre(){

         $logo = Area::traerArea();

        return $logo[0]->nombre;
    }
    
    public function guardarIcono(Request $datos){

        $logo = Area::guardarIcono($datos);
        
        if ($logo) {
            return "todo bien...";
        }
        return "error masivo..";
    }
}
