<?php

namespace App\Http\Controllers;

use App\Fotoperfil;
use App\Http\Requests\formUsuarioInstitucionRequest;
use App\User;
use App\VendedorInstitucion;
use App\Vendedor;
use Illuminate\Http\Request;
use App\Passwordcuenta;
use Illuminate\Support\Facades\Mail;

class vendedorDependienteController extends Controller
{
    public function vista_inicio()
    {       
            $foto = Fotoperfil::traerFoto();
            $verificEstado = Vendedor::verificEstado(\Auth::user()->id);
            $estado_password = Passwordcuenta::traerEstado();
             $estado = $verificEstado[0]->id_estado;
            \Session::put('estado', $estado);
            
        	return view('vendedorDependiente.inicio')
            ->with('foto', $foto)
            ->with('estado_password', $estado_password);
    }
    public function vista_cambiarFoto()
    {
        return view('vendedorDependiente.cambiarFoto');
    }

    public function insertar(formUsuarioInstitucionRequest $datos){

            $us = User::insertar_vendedorDependiente($datos);
        	
             if($us){
                    $id_us = User::where('email','=',"$datos->correo")->get();
                    $ven = Vendedor::insertar_esperando($datos, $id_us[0]->id);
                     if($ven){

                            $id_ven = Vendedor::filtrar($id_us[0]->id); 
                            $venDependiente = VendedorInstitucion::insertar($datos, $id_ven[0]->id);
                              if($venDependiente){

                                        $foto = Fotoperfil::fotoDefault($id_us[0]->id);
                                        if ($foto) 
                                        {
                                            $passwordDefault = Passwordcuenta::insertar_clave_normal($id_us[0]->id);
                                            if ($passwordDefault) {
                                                return "ok todo bien...";
                                            }
                                        }
                                }

                     }

             }
    }                          

    public function traerFotoVendedor(){

        //$dato = VendedorInstitucion::fotoVendedorInstitucion();
        $dato = Fotoperfil::traerFoto();
        return $dato;
    }
    public function guardar_foto(Request $dato){   

        $guardar = Fotoperfil::guardar($dato);
        return $guardar;
    }

    public function actualiza_clave(request $dato){

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
}
           
             
