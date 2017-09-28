<?php

namespace App\Http\Controllers;

use App\Area;
use App\Fotoperfil;
//use App\Http\Requests\agregaralumnoRequest;
//use App\Http\Requests\institucionRequest;

use App\Http\Requests\institucionRequest;
use App\Http\Requests\agregaralumnoRequest;
use App\Institucion;
use App\Sexo;
use App\User;
use App\Vendedor;
use App\VendedorInstitucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Usuarioinstitucion;
use App\Passwordcuenta;
use ConsoleTVs\Charts\Charts;

//use DB;
class institucionController extends Controller
{
    
    public function vista_institucion(){

          $datosInstitucion = Institucion::datos();
            return view('institucion.inicio')->with('institucion', $datosInstitucion);
      
    }
    public function vista_agregarAE(){
            return view('institucion.agregar_area_especialidad');
    }

    public function vista_notificacio_vendedor(){

            $usuariosEsperando = Institucion::usuariosEsperando();
            return view('institucion.notificaciones_vendedor')->with('userEsperando', $usuariosEsperando);

    }
    public function vista_agregarAlumno(){
            $sexo = Sexo::all();
            $area = Area::traer();
            return view('institucion.agregar_alumno')->with('sexo', $sexo)->with('area', $area);
    }

    public function vista_misionyvision(){
            return view('institucion.misionyvision');
    }

    public function vista_noticia(){
            return view('institucion.noticia');
    }
    public function vista_paginaweb(){
          return view('institucion.paginaweb');
    }
    public function vista_datos(){

            $datosInstitucion = Institucion::datos();
            return view('institucion.datos_inst')->with('datos', $datosInstitucion);
    }
    public function vista_grafico(){

          $array[0] = ['Áreas', 'Cantidad de alumnos'];
          $areas = Area::traer();
          for ($i=0; $i < count($areas) ; $i++) { 
            $contarAlumnos = Area::contarAlumnosPorArea($areas[$i]->id);
            $array[$i+1] = [$areas[$i]->nombre, $contarAlumnos];
          }
         
          return view('institucion.grafico')->with('areas',json_encode($array));
    }

    public function graficochart(){
          
          $array;
          $contar;
      $areas = Area::traer();
          for ($i=0; $i < count($areas) ; $i++) { 
            $contarAlumnos = Area::contarAlumnosPorArea($areas[$i]->id);
            $array[$i] = $areas[$i]->nombre;
            $contar[$i] = $contarAlumnos;
          }

          //return $array;
         $chart = Charts::create('pie', 'highcharts')
            ->Title('My nice chart')
            ->Labels($array)
            ->Values($contar)
            ->Dimensions(1000,1000)
            ->Responsive(true);

        //return view('frontend.user.dashboard',['chart'=>$chart]);
        return view('institucion.graficochart',['chart' => $chart]);

    }



     public function vista_perfilVen($iduser){
        $idu = base64_decode($iduser);
        //return $idu;

        $usuario = User::find($idu);
        $vendedor = Vendedor::where('id_user',$usuario->id)->get();
        $foto = Fotoperfil::traerFotobyid($idu);
        
        return view('institucion.perfil_vendedor')
        ->with('foto',$foto)
        ->with('usuario',$usuario)
        ->with('vendedor',$vendedor[0]->telefono);
    }
    public function vista_perfilInst($idinstitucion){

        $idI = base64_decode($idinstitucion);
        $institucion = Institucion::find($idI);

        return view('institucion.perfil_institucion')->with('institucion', $institucion);
    }
    public function vista_perfilVenInst($iduser){
         $idu = base64_decode($iduser);
          //return $idu;
        $usuario = User::find($idu);
        $vendedor = Vendedor::where('id_user',$usuario->id)->get();
        $vendedorInstitucion = VendedorInstitucion::where('id_vendedor',$vendedor[0]->id)->get();
        $institucion = Institucion::find($vendedorInstitucion[0]->id_institucion);
         $foto = Fotoperfil::traerFotobyid($idu);
        
        return view('institucion.perfil_vendedorInstitucion')
        ->with('foto',$foto)
        ->with('usuario',$usuario)
        ->with('vendedor',$vendedor[0]->telefono)
         ->with('institucion', $institucion);
        
        //return view('institucion.perfil_vendedorInstitucion')->with('foto',$foto)->with('usuario',$usuario);
    }

    public function vista_publicarProducto(){
        $areas = Area::traer();
        return view('institucion.publicarProducto')->with('areas',$areas);
    }
    public function vitsa_generarPassword($value='')
    {
        return view('institucion.generarPassword');
    }

    public function agregar_alumno(agregaralumnoRequest $datos)
    {
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
                     $venDependiente = VendedorInstitucion::insertar_dentro($datos, $id_vendedor[0]->id);
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
                                    return "ok"; 
                                    }
                                }
                                return "error";
                     }
             }
        }
    }
    /*Peticiones en ajax mediante vue y vue-resource*/

    public function agregar_mision(Request $data)
    {
        $this->validate($data, ['mision' => 'required']);

             $institucion = \DB::table('institucion')
                    ->where('id', \Auth::guard("institucion")->user()->id)
                    ->update(['mision' => $data->mision]);

                    if (count($institucion)>0) {
                        return "ok";
                    }   
                    return "error";
            
    }
     public function agregar_vision(Request $data)
    {
             $this->validate($data, ['vision' => 'required']);

             $institucion = \DB::table('institucion')
                    ->where('id', \Auth::guard("institucion")->user()->id)
                    ->update(['vision' => $data->vision]);

                    if (count($institucion)>0) {
                        return "ok";
                    }   
                    return "error";
            
    }
    public function traer_mision()
    {
          $mision = Institucion::datos();
          return response()->json($mision->mision);
    }
    public function traer_vision()
    {
          $vision = Institucion::datos();
          return response()->json($vision->vision);
    }
    public function traerDatosInstitucion(){

    	$instituto = Institucion::where('id','=',\Auth::guard("institucion")->user()->id)->get();
    	return $instituto;
    	
    }
    public function insertarArea(Request $data){
        
        $area = Area::insertar($data);
        return $area;

    }
    public function traerAreas(){

        return Area::traer();
    }
    public function aceptarSolicitudUsuario(Request $data){
        
        $aceptarUser = Vendedor::aceptarusuario($data[0]);
        $user = User::find($data[0]);
        
             \Session::put('user',$user->nombres.' '.$user->apellidos);//obtener usuario y enviarlo a mail.blade.php
             
        if($aceptarUser == 1){
                
                 Mail::send(['text'=>'emails.mail'],['name','janin'],function ($message) use ($user)
                {
                    $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
                    $message->to($user['email'],'to jano');
                });
          return "ok";
        }
        return "error";
    }
    public function traerNotificaciones(){

       $notificar = Institucion::notificaciones();

          foreach ($notificar as $not) {
             return $not->notificar;
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

    public function actualizar_nombre(Request $data){
           $this->validate($data,['nombre' => 'required|unique:institucion,nombre',]);
           $nombre = Institucion::actualizarNombre($data->nombre);
           return $nombre;
    }
    public function actualizar_rs(Request $data){
          $this->validate($data,['razonSocial' => 'required',]);
          $rs = Institucion::actualizarRs($data->razonSocial); 
          return $rs;
    }
    public function actualizar_tel1(Request $data){
            $this->validate($data,['teléfono1' => 'required|max:9',]);
            $tel1 = Institucion::actualizarTel1($data->teléfono1);
            return $tel1;
    }
    public function actualizar_tel2(Request $data){
           $this->validate($data,['teléfono2' => 'required|max:9',]);
           $tel2 = Institucion::actualizarTel2($data->teléfono2);
           return $tel2;
    }
    public function actualizar_direccion(Request $data){
           $this->validate($data,['dirección' => 'required',]);
           $direccion = Institucion::actualizarDireccion($data->dirección);
           return $direccion;
    }
    public function actualizar_correo(Request $data){
           $this->validate($data,['correo' => 'required',]);
           $correo = Institucion::actualizarCorreo($data->correo);
           return $correo;
    }
    public function actualizar_clave(Request $data){

      $this->validate($data,
            [
            'clave_actual' => 'required',
            'clave_nueva' => 'required',
            'confirm_clave_nueva' => 'required|same:clave_nueva'
        ]);
        $pass = Institucion::find(\Auth::guard('institucion')->user()->id)->get();
        if (\Hash::check($data->clave_actual, $pass[0]->password)) {
                $clave = Institucion::actualizarClave($data->clave_nueva);
                return $clave;
        }
        return redirect()->back()->withErrors(['Clave actual incorrecta']);
        
       //$clave = Institucion::;
    }
    public function eliminarEncargado(Request $encargado){
      //$eliminarFoto = idF
      $eliminarEncargado = Usuarioinstitucion::where('id_user',$encargado->id)->delete();
      $eliminarFoto = Fotoperfil::where('id_user',$encargado->id)->delete();
      $eliminarPassestado = Passwordcuenta::where('id_user', $encargado->id)->delete();
      $eliminarusuario = User::where('id',$encargado->id)->delete();
      return "okaaa";
    }
    public function ingresar_pagweb(Request $dato){

          $this->validate($dato,[
                'paginaWeb' => 'required | url',
          ]);

          $ingresarweb = Institucion::ingresar_paginaweb($dato->paginaWeb);

          if ($ingresarweb) {
              
              \Session::flash('web', 'Sitio web ingresado');
              return redirect()->back();
          }
    }

    public function actualizar_nombreArea(Request $dato){
           $this->validate($dato,[
                'nombreDeArea' => 'required',
          ]);

            $ingresarNombre = Area::actualizar_nombre($dato); 
            if ($ingresarNombre) {

              \Session::flash('ingreso', 'Operación exitosa');
                return redirect()->back();
            }
            return redirect()->back()->withErrors(['Error en la operación']);
    }

    public function actualizar_descripcion(request $dato)
    {
        $this->validate($dato,[
                'descripcion' => 'required',
          ]);

            $ingresarDesc = Area::actualizar_descripcion($dato); 
            if ($ingresarDesc) {

              \Session::flash('ingreso', 'Operación exitosa');
                return redirect()->back();
            }
            return redirect()->back()->withErrors(['Error en la operación']);
    }

    public function buscarUsuarioParaCambiarPassword(Request $dato)
    {
        $user = User::filtroBusarUser($dato->buscar);
        return response()->json($user);
    }

    /*PUBLICACION DE LOS PRODUCTOS*/
    public function publicarproducto(productoRequest $datos){

       $insertFotoProducto = foto_producto::insertar($datos);

       if ($insertFotoProducto > 0) {
           
           $insertProducto = producto_institucion::insertar($datos, $insertFotoProducto);

           if ($insertProducto > 0) {

                $tienda = Tienda_institucion::encargado_id_tienda();
                
                $insertTiendaProducto = Tienda_producto_institucion::insertar($insertProducto, $tienda[0]->id, '1');
               
               if ($insertTiendaProducto > 0) {
                   \Session::flash('registro', 'Producto registrado correctasmente');
                return redirect()->back();
               }
               return "Mal todo";
               /*\Session::flash('registro', 'Producto registrado correctasmente');
                return redirect()->back();*/
           }
           return redirect()->back()->withErrors(['Algo salió mal']);
        }
    }
    /*FIN DE PUBLICACION DE LOS PRODUCTOS*/
}
