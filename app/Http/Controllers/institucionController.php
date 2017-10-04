<?php

namespace App\Http\Controllers;

use App\Area;
use App\Fotoperfil;
//use App\Http\Requests\agregaralumnoRequest;
//use App\Http\Requests\institucionRequest;

use App\Http\Requests\institucionRequest;
use App\Http\Requests\agregaralumnoRequest;
use App\Http\Requests\productoInstiRequest;
use App\Institucion;
use App\Sexo;
use App\User;
use App\Vendedor;
use App\VendedorInstitucion;
use App\categoria_producto;
use App\Tienda_institucion;
use App\foto_producto;
use App\foto_producto_institucion;
use App\producto_institucion;
use App\Tienda_producto_institucion;
use App\estado_tienda_producto;
use Illuminate\Http\Request;
use App\Http\Requests\productoRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Usuarioinstitucion;
use App\Passwordcuenta;
use ConsoleTVs\Charts\Charts;

//use DB;
class institucionController extends Controller
{
    
    public function vista_institucion(){

          $datosInstitucion = Institucion::datos();
          $productos = producto_institucion::traetProductosDesdeAdmin(\Auth::guard('institucion')->user()->id);
            return view('institucion.inicio')
            ->with('institucion', $datosInstitucion)
            ->with('productos', $productos);
      
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
        $categoria_pro = categoria_producto::all();
        $productos = producto_institucion::traetProductosDesdeAdmin(\Auth::guard('institucion')->user()->id);
        
        return view('institucion.publicarProducto')
        ->with('areas',$areas)
        ->with('categoria_pro', $categoria_pro)
        ->with('productos', $productos);
    }
    public function vitsa_generarPassword($value='')
    {
        return view('institucion.generarPassword');
    }
    public function ver_detalleProducto(Request $dato)
    {

      $getId = base64_decode($dato->id);
      $categoria = categoria_producto::all();
      $estadoP = estado_tienda_producto::limit(2)->get();
      $area = Area::all();

      $productos = producto_institucion::detalleProducto($getId);
      return view('institucion.verDetalleProducto')
      ->with('productos', $productos)
      ->with('categoria', $categoria)
      ->with('estadoP', $estadoP)
      ->with('area', $area);
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
                                         Mail::send(['html'=>'emails.clave'],['name','janin'],function ($message) use ($correo)
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
                
                 Mail::send(['html'=>'emails.mail'],['name','janin'],function ($message) use ($user)
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
    public function publicarproducto(productoInstiRequest $datos){
      
       $institucion = Area::traer();

       $insertProducto = producto_institucion::insertar($datos);

       if ($insertProducto > 0) {
           
            $insertFotoProducto = foto_producto_institucion::insertar($datos, $insertProducto);

           if ($insertFotoProducto > 0) {

                $tienda = Tienda_institucion::id_tienda_by_institucion(\Auth::guard('institucion')->user()->id);
                //dd($tienda[0]->id);
                $insertTiendaProducto = Tienda_producto_institucion::insertar($insertProducto, $tienda[0]->id, '1', $datos->area);
               
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

    public function eliminar_producto_institucion(Request $dato)
    {
      $getId= base64_decode($dato->idProducto);
      $getFoto = foto_producto_institucion::where('id_producto',$getId)->get();
      //return $getFoto[0]->foto;
      \File::delete($getFoto[0]->foto);/*ELIMINAR FOTO*/
      
      $foto_prod = foto_producto_institucion::borrar($getFoto[0]->id);
      $tienda_prod_inst = Tienda_producto_institucion::borrar($getId);
      $prod_insti = producto_institucion::borrar($getId);

      return redirect()->back();
    }
    public function actualizar_producto_foto(Request $dato)
    {
      $this->validate($dato,[
                'fotoP1' => 'required|mimes:jpeg,bmp,png,gif|dimensions:max_width=3200,max_height=2850',
          ]);
      //dd($dato->idProducto);
      $actualizar = foto_producto_institucion::actualizar_foto($dato);
      if ($actualizar > 0) {
          \Session::flash('correcto', 'Foto actualizada correctamente');
          return redirect()->back();
      }
      return redirect()->back();
    }
    public function actualizar_producto_nombre(Request $dato)
    {
      $this->validate($dato,[
                'nombre' => 'required | max:50',
          ]);
          $nombre = producto_institucion::actualizar_nombre($dato);
          if ($nombre) {
            \Session::flash('correcto', 'Nombre actualizado correctamente');
            return redirect()->back();
          }
          return redirect()->back();
    }
    public function actualizar_producto_descripcion(Request $dato)
    {
      $this->validate($dato,[
                'descripcion' => 'required | max:250',
          ]);
          $desc = producto_institucion::actualizar_descripcion($dato);
          if ($desc) {
            \Session::flash('correcto', 'Descripcion actualizada correctamente');
            return redirect()->back();
          }
          return redirect()->back();
    }
     public function actualizar_producto_precio(Request $dato)
    {
      $this->validate($dato,[
                'precio' => 'required | numeric',
          ]);
          $cant = producto_institucion::actualizar_precio($dato);
          if ($cant) {
            \Session::flash('correcto', 'Precio actualizado correctamente');
            return redirect()->back();
          }
          return redirect()->back();

    }
    public function actualizar_producto_cantidad(Request $dato)
    {
      $this->validate($dato,[
                'cantidad' => 'required | numeric',
          ]);
          $cant = producto_institucion::actualizar_cantidad($dato);
          if ($cant) {
            \Session::flash('correcto', 'Cantidad actualizada correctamente');
            return redirect()->back();
          }
          return redirect()->back();

    }
    public function actualizar_producto_visibilidad(Request $dato)
    {
      $this->validate($dato,[
                'estadoV' => 'required',
          ]);

          $visibi = producto_institucion::actualizar_visibilidad($dato);
          if ($visibi) {
            return redirect()->back();
          }
          return redirect()->back();

    }public function actualizar_producto_categoria(Request $dato)
    {
      $this->validate($dato,[
                'categoria' => 'required',
          ]);

      $categ = producto_institucion::actualizar_categoria($dato);
          if ($categ) {
            
            return redirect()->back();
          }
          return redirect()->back();

    }public function actualizar_producto_area(Request $dato)
    {
      $this->validate($dato,[
                'area' => 'required',
          ]);
      $area = producto_institucion::actualizar_area($dato);
          if ($area) {
            //\Session::flash('correcto', 'Cantidad actualizada correctasmente');
            return redirect()->back();
          }
          return redirect()->back();
    }
    /*public function FunctionName($value='')
    {
      # code...
    }
    public function FunctionName($value='')
    {
      # code...
    }
    public function FunctionName($value='')
    {
      # code...
    }
    public function FunctionName($value='')
    {
      # code...
    }*/
}
