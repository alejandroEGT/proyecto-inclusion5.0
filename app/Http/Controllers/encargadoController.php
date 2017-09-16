<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fotoperfil;
use App\Passwordcuenta;
use App\User;
use App\Area;
use App\Encargado;
use App\Sexo;
use App\Vendedor;
use App\VendedorInstitucion;
use App\Institucion;
use App\Http\Requests\agregarAlumnoDesdeAreaRequest;
use Illuminate\Support\Facades\Mail;

class encargadoController extends Controller
{
    public function vista_inicio(){

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

        $equipo = Encargado::traerEquipo();
        return view('encargadoArea.equipo')->with('equipo', $equipo);
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
    public function vista_perfilVen($iduser){
        $idu = base64_decode($iduser);
        //return $idu;

        $usuario = User::find($idu);
        $vendedor = Vendedor::where('id_user',$usuario->id)->get();
        $foto = Fotoperfil::traerFotobyid($idu);
        
        return view('encargadoArea.perfil_vendedor')
        ->with('foto',$foto)
        ->with('usuario',$usuario)
        ->with('vendedor',$vendedor[0]->telefono);
    }
    
    public function vista_perfilVenInst($iduser){
        $idu = base64_decode($iduser);
          //return $idu;
        $usuario = User::find($idu);
        $vendedor = Vendedor::where('id_user',$usuario->id)->get();
        $vendedorInstitucion = VendedorInstitucion::where('id_vendedor',$vendedor[0]->id)->get();
        $institucion = Institucion::find($vendedorInstitucion[0]->id_institucion);
      

        $foto = Fotoperfil::traerFotobyid($idu);
        
        return view('encargadoArea.perfil_vendedorInstitucion')
        ->with('foto',$foto)
        ->with('usuario',$usuario)
        ->with('vendedor',$vendedor[0]->telefono)
        ->with('institucion', $institucion);
        
        return view('encargadoArea.perfil_vendedorInstitucion')->with('foto',$foto)->with('usuario',$usuario);
    }

     public function vista_perfilInst($idinstitucion){

        $idI = base64_decode($idinstitucion);
        $institucion = Institucion::find($idI);

        return view('encargadoArea.perfil_institucion')->with('institucion', $institucion);
    }
    public function vista_agregarAlumno(){
        $id_area = Encargado::traerDatos();
        $id_institucion = Encargado::traerDatos(); 
        $sexo = Sexo::all();
        return view('encargadoArea.agregar_alumno')->with('sexo', $sexo)->with('id_institucion', $id_institucion[0]->id_institucion)
              ->with('id_area', $id_area[0]->id_area);
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
                        \Session::flash('clave', 'Contraseña actualizada correctasmente');
                        return redirect()->back();
                }
                return "Error...";
    }
     public function agregar_alumno(agregarAlumnoDesdeAreaRequest $datos)
    {
        $datos->flash();
        $genclave = $this->genclave();
        $correo = $datos->correo;
        \Session::put('usuario',$datos->nombres.' '.$datos->apellidos);//obtener usuario y enviarlo a clave.blade.php
        \Session::put('clave',$genclave);//obtener clave y enviarlo a clave.blade.php
        $user = User::insertar_vendedorDependiente_dentro($datos, $genclave);
        if($user){
             $id_user = User::where('email','=',"$datos->correo")->get();
             $vendedor = Vendedor::insertar_aprobado($datos, $id_user[0]->id);
             if ($vendedor) {
                     $id_vendedor = Vendedor::idVendedor($id_user[0]->id);
                     $venDependiente = VendedorInstitucion::insertar_desde_area($datos, $id_vendedor[0]->id);
                     if ($venDependiente) {
                          $foto = Fotoperfil::fotoDefault($id_user[0]->id);
                                if ($foto) {
                                    $passwordDefault = Passwordcuenta::insertar_clave_default($id_user[0]->id);

                                    if ($passwordDefault) {
                                         Mail::send(['text'=>'emails.clave'],['name','janin'],function ($message) use ($correo)
                                      {
                                          $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
                                          $message->to($correo,'to jano');
                                      });
                                        \Session::flash('registro', 'Alumno registrado correctasmente');
                                        return redirect()->back();
                                    }
                                }
                                return "error";
                     }
             }
        }
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
}
