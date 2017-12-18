<?php

namespace App\Http\Controllers;

use App\Fotoperfil;
use App\Http\Requests\formUsuarioInstitucionRequest;
use App\User;
use App\VendedorInstitucion;
use App\Area;
use App\Vendedor;
use App\producto;
use App\servicio;
use App\noticia;
use App\Usuarioinstitucion;
use Illuminate\Http\Request;
use App\Passwordcuenta;
use Illuminate\Support\Facades\Mail;

class vendedorDependienteController extends Controller
{
    public function vista_inicio()
    {     
            $alumno = VendedorInstitucion::traerDatos();
            $area = Area::traer_aerea_para_alumno();
            $foto = Fotoperfil::traerFoto();
            $verificEstado = Vendedor::verificEstado(\Auth::user()->id);
            $estado_password = Passwordcuenta::traerEstado();
            $productos = producto::verProductoDesdeArea( $alumno->id_area, 10);
            $servicios = servicio::mostrarServicioDesdeArea($alumno->id_area, 4);
            $estado = $verificEstado[0]->id_estado;
            $noticias_generales = noticia::noticias_generales();
            $noticias_locales = noticia::noticias_locales($alumno->id_institucion);
            \Session::put('estado', $estado);
        
        	return view('vendedorDependiente.inicio')
            ->with('foto', $foto)
            ->with('estado_password', $estado_password)
            ->with('productos',$productos)
            ->with('servicios',$servicios)
            ->with('noticias_generales',$noticias_generales)
            ->with('noticias_locales',$noticias_locales);
    }

    public function vista_datos()
    {
         $alumno = VendedorInstitucion::datosAlumnoById(\Auth::user()->id);
         
         return view('vendedorDependiente.misDatos')->with('alumno', $alumno);
    }
    public function vista_cambiarFoto()
    {
        return view('vendedorDependiente.cambiarFoto');
    }

    public function insertar(formUsuarioInstitucionRequest $datos){

        try{
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
                                                \Session::flash('ingresado', 'Registro con exito, debes esperar la respuesta de la institución.');
                                                return redirect()->back();
                                            }
                                             $datos->flash();
                                        }
                                         $datos->flash();
                                }
                                 $datos->flash();

                     }
                      $datos->flash();

             }
         }catch (\Illuminate\Database\QueryException $e) {
             $datos->flash();
            $user = User::where('email', $datos->correo)->first();
            if ($user->delete()) {
                return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
            }
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
            
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

    public function traerEstadoClave(){

        $traer = VendedorInstitucion::traerEstadoClave();
        return $traer;
    }
}
           
             
