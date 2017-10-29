<?php

namespace App\Http\Controllers;

use App\Area;
use App\Fotoperfil;
use App\Http\Requests\institucionRequest;
use App\Http\Requests\agregaralumnoRequest;
use App\Http\Requests\productoInstiRequest;
use App\Http\Requests\noticiaRequest;
use App\Http\Requests\servicioInstRequest;
use App\Institucion;
use App\Sexo;
use App\User;
use App\Vendedor;
use App\VendedorInstitucion;
use App\categoria_producto;
use App\categoria_servicio;
use App\Tienda_institucion;
use App\foto_producto;
use App\foto_servicio;
use App\producto;
use App\Tienda_producto_institucion;
use App\Tienda_servicio_institucion;
use App\estado_tienda_producto;
use App\estado_tienda_servicio;
use App\estado_noticia;
use App\servicio;
use App\noticia;
use App\FotoPefil;
use Illuminate\Http\Request;
use App\Http\Requests\productoRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Usuarioinstitucion;
use App\Passwordcuenta;
use ConsoleTVs\Charts\Charts;

class institucionController extends Controller
{
    
    public function vista_institucion(){

          $datosInstitucion = Institucion::datos();
          $productos = producto::traetProductosDesdeAdmin(\Auth::guard('institucion')->user()->id, 4);
          $servicios = servicio::mostrarServicioDesdeAdmin(\Auth::guard('institucion')->user()->id, 4);
          $noticias_generales = noticia::noticias_generales();
          $noticias_locales = noticia::noticias_locales(\Auth::guard('institucion')->user()->id);

            return view('institucion.inicio')
            ->with('institucion', $datosInstitucion)
            ->with('productos', $productos)
            ->with('servicios', $servicios)
            ->with('noticias_generales',$noticias_generales)
            ->with('noticias_locales',$noticias_locales);
      
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
            $estado_noticia = estado_noticia::all();
            return view('institucion.noticia')->with('estado_noticia', $estado_noticia);
    }
    public function vista_paginaweb(){
          return view('institucion.paginaweb');
    }
    public function vista_datos(){

            $datosInstitucion = Institucion::datos();
            return view('institucion.datos_inst')->with('datos', $datosInstitucion);
    }
    public function ver_detalleNoticia_general(Request $dato)
    {   
        $noticia = noticia::unica_general(base64_decode($dato->idNoticia));
        //dd($noticia);
        return view('institucion.noticia_individual_general')->with('noticia', $noticia);
    }
    public function ver_detalleNoticia_local(Request $dato)
    {
         $noticia = noticia::unica_local(base64_decode($dato->idNoticia), \Auth::guard('institucion')->user()->id);
        //dd($noticia);
         $estado_noticia = estado_noticia::all();
        return view('institucion.noticia_individual_local')
               ->with('noticia', $noticia)
               ->with('estado_noticia', $estado_noticia);
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
    public function ver_todo_producto()
    {
        $producto = producto::traetProductosDesdeAdmin(\Auth::guard('institucion')->user()->id, 5);
        //dd ($producto);
        return view('institucion.verTodoProducto')->with('productos', $producto);
    }
     public function ver_todo_servicio()
    {
        $servicios = servicio::mostrarServicioDesdeAdmin(\Auth::guard('institucion')->user()->id, 5);
        //dd($producto);
        return view('institucion.verTodoServicio')->with('servicios', $servicios);
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
      try{
            $idI = base64_decode($idinstitucion);
            $institucion = Institucion::find($idI);
            $areas = Area::where('id_institucion', $idI)->get();
            //return $institucion->id;
            $productos = producto::verProductosVisibles($institucion->id, 5);
            $servicios = servicio::mostrarServicioDesdeAdmin($institucion->id, 5);
            return view('institucion.perfil_institucion')
            ->with('institucion', $institucion)
            ->with('productos', $productos)
            ->with('servicios', $servicios)
            ->with('idInstitucion', $idinstitucion)
            ->with('areas', $areas);

        } catch (\Exception $e) {
          return redirect()->back();
        }
    }
    public function vista_areaExterna(Request $dato)
    {
        

            $idI = base64_decode($dato->idInstitucion);
            $idA = base64_decode($dato->idArea);

            $institucion = Institucion::find($idI);
            $area = Area::find($idA);
            $productos = producto::areaYinstitucion($idI, $idA);
            $servicios = servicio::areaYinstitucion($idI, $idA);
            $alumnos = VendedorInstitucion::alumnosDeUnArea($idI, $idA);
            $encargado = Usuarioinstitucion::traerEncargado($idI, $idA);
            
            return view('institucion.areaExterna')->with([
                'institucion' => $institucion,
                'area' => $area,
                'productos' => $productos,
                'servicios' => $servicios,
                'alumnos' => $alumnos,
                'encargado' => $encargado
            ]);

        
    }
    public function vista_serviciosEspera()
    {
       $servicios = servicio::traer_ServicioEnEspera(\Auth::guard('institucion')->user()->id, 5);
       return view('institucion.servicioEspera')->with('serv_esp', $servicios);
    }
    public function vista_perfilVenInst($iduser){
         $idu = base64_decode($iduser);
          //return $idu;
        $usuario = User::find($idu);
        $vendedor = Vendedor::where('id_user',$usuario->id)->get();
        $vendedorInstitucion = VendedorInstitucion::where('id_vendedor',$vendedor[0]->id)->get();
        $institucion = Institucion::find($vendedorInstitucion[0]->id_institucion);
        $foto = Fotoperfil::traerFotobyid($idu);

        $productos = producto::verProductoDesdeArea($vendedorInstitucion[0]->id_area , 5);
        
        return view('institucion.perfil_vendedorInstitucion')
        ->with('foto',$foto)
        ->with('usuario',$usuario)
        ->with('vendedor',$vendedor[0]->telefono)
        ->with('institucion', $institucion)
        ->with('productos', $productos)
        ->with('idInstitucion', base64_encode($vendedorInstitucion[0]->id_institucion));
        
        //return view('institucion.perfil_vendedorInstitucion')->with('foto',$foto)->with('usuario',$usuario);
    }

    public function vista_publicarProducto(){

        $areas = Area::traer();
        $categoria_pro = categoria_producto::all();
        $productos = producto::traetProductosDesdeAdmin(\Auth::guard('institucion')->user()->id, 5);
        
        return view('institucion.publicarProducto')
        ->with('areas',$areas)
        ->with('categoria_pro', $categoria_pro)
        ->with('productos', $productos);
    }
    public function vitsa_generarPassword()
    {
        return view('institucion.generarPassword');
    }
    public function ver_detalleProducto(Request $dato)
    {

      $getId = base64_decode($dato->id);
      $categoria = categoria_producto::all();
      $estadoP = estado_tienda_producto::limit(2)->get();
      $area = Area::traer();

      $productos = producto::detalleProducto($getId, \Auth::guard('institucion')->user()->id);
      return view('institucion.verDetalleProducto')
      ->with('productos', $productos)
      ->with('categoria', $categoria)
      ->with('estadoP', $estadoP)
      ->with('area', $area);
    }

    public function ver_detalleProducto_institucion_local(Request $dato)
    {

      $getId = base64_decode($dato->idProducto);
      $getIdInst = base64_decode($dato->idInstitucion);
      $categoria = categoria_producto::all();
      $estadoP = estado_tienda_producto::limit(2)->get();
      $area = Area::all();

      $productos = producto::detalleProducto($getId, $getIdInst);
      return view('institucion.verDetalleProductoInstitucionBuscador')
      ->with('productos', $productos)
      ->with('categoria', $categoria)
      ->with('estadoP', $estadoP)
      ->with('area', $area);
    }
    public function ver_detalleServicio(Request $dato)
    {
      $getId = base64_decode($dato->id);
      $categoria = categoria_servicio::all();
      $estadoS = estado_tienda_servicio::limit(2)->get();
      $area = Area::traer();

      $servicio = servicio::detalleServicio($getId, \Auth::guard('institucion')->user()->id);
      //return $servicio;
      return view('institucion.verDetalleServicio')
              ->with('categoria',$categoria)
              ->with('estadoS',$estadoS)
              ->with('area',$area)
              ->with('servicio',$servicio);
    }
    public function ver_detalleServicio_institucion_local(Request $dato)
    {
      
      $getId = base64_decode($dato->idServicio);
      $getIdInst = base64_decode($dato->idInstitucion);
      $categoria = categoria_servicio::all();
      $estadoS = estado_tienda_servicio::limit(2)->get();
      $area = Area::all();

      $servicio = servicio::detalleServicio($getId, $getIdInst);
      //return $servicio;
      return view('institucion.verDetalleServicioInstitucionBuscador')
              ->with('categoria',$categoria)
              ->with('estadoS',$estadoS)
              ->with('area',$area)
              ->with('servicio',$servicio);
    }
    public function traerProductoEnEspera()
    {
      $prod_esp = producto::traerProductoEnEspera(\Auth::guard('institucion')->user()->id, 10);
       return view('institucion.productoEspera', ['prod_esp' => $prod_esp]);
    }
    public function traerServicioEnEspera()
    {
       $serv_esp = Tienda_servicio_institucion::traerServicioEnEspera(\Auth::guard('institucion')->user()->id, 10);
       return view('institucion.servicioEspera', ['serv_esp' => $serv_esp]);
    }
    public function vista_publicarServicio()
    {
      $areas = Area::traer();
      $categoria_serv = categoria_servicio::all();
      $servicios = servicio::mostrarServicioDesdeAdmin(\Auth::guard('institucion')->user()->id, 1);
      return view('institucion.publicarServicio')
              ->with('categoria_serv', $categoria_serv)
              ->with('servicios', $servicios)
              ->with('areas',$areas);
    }
    public function todas_noticias_locales()
    {
      $estado_noticia = estado_noticia::all();
      $noticias_locales = noticia::detalleNoticia(\Auth::guard('institucion')->user()->id);
      return view('institucion.noticias_locales')
      ->with('noticias_locales', $noticias_locales)
      ->with('estado_noticia',$estado_noticia);
    }
    public function todas_noticias_generales()
    {
       $noticias_generales = noticia::todas();
       return view('institucion.noticias_generales')->with('noticias_generales',$noticias_generales);
    }

    public function agregar_alumno(agregaralumnoRequest $datos)
    {
      try{
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
                                         \Session::flash('ingresado', 'Alumno ingresado');
                                    return redirect()->back();
                                     
                                    }
                                }
                                return redirect()->back()->withErrors(['algo salió mal']);
                     }
             }
        }
      } catch (\Illuminate\Database\QueryException $e) {
                $user = User::where('email', $datos->correo)->first();
                
                if (count($user)>0) {
                      $user->delete();
                      return redirect()->back()->withErrors(['Algo no anda bien en los campos, eliminamos el registro reciente']);
                    
                }
                return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
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
     public function aceptarProducto(Request $dato)
    {
  
      $aceptar = Tienda_producto_institucion::where('id_producto', $dato->id)->first();
      $aceptar->id_estado = '1';
      if ($aceptar->save()) {
         return "true";
      }
      return "false";
    }
    public function aceptarSolicitudServicio(Request $dato)
    {
      $aceptar = Tienda_servicio_institucion::where('id_servicio',$dato->id)->first();
      $aceptar->id_estado = '1';
      if ($aceptar->save()) {
          return "true";
      }
      return "false";
    }
    public function traerNotificaciones(){

       $notificar = Institucion::notificaciones();

          foreach ($notificar as $not) {
             return $not->notificar;
          }
    }
    public function traerNotificaciones_prod()
    {
      $notificar_pod = Tienda_producto_institucion::productoEnEspera();

      return $notificar_pod;
    }
    public function traerNotificaciones_serv()/*cantidad de solicitudes*/
    {
       $notificar_serv = Tienda_servicio_institucion::traer_ServicioEnEspera();
       return $notificar_serv;
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
     public function actualizar_rut(Request $data){
          try{ 
             $this->validate($data,['rut' => 'max:9 | required | numeric | unique:institucion,rut,'. $data->rut,]);
             $rut = Institucion::actualizarRut($data->rut);
             return $rut;
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
          }

    }

    public function actualizar_nombre(Request $data){
          try{ 
             $this->validate($data,['nombre' => 'required|unique:institucion,nombre | max:50',]);
             $nombre = Institucion::actualizarNombre($data->nombre);
             return $nombre;
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
          }

    }
    public function actualizar_rs(Request $data){
      try{
          $this->validate($data,['razonSocial' => 'required | max:50',]);
          $rs = Institucion::actualizarRs($data->razonSocial); 
          return $rs;
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }
    }
    public function actualizar_tel1(Request $data){
        try{
              $this->validate($data,['teléfono1' => 'required|max:9',]);
              $tel1 = Institucion::actualizarTel1($data->teléfono1);
              return $tel1;
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
          }    
    }
    public function actualizar_tel2(Request $data){
        try{
             $this->validate($data,['teléfono2' => 'required|max:9',]);
             $tel2 = Institucion::actualizarTel2($data->teléfono2);
             return $tel2;

          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
          } 
    }
    public function actualizar_direccion(Request $data){
        try{
             $this->validate($data,['dirección' => 'required | max:100',]);
             $direccion = Institucion::actualizarDireccion($data->dirección);
             return $direccion;

          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
          } 
    }
    public function actualizar_correo(Request $data){
        try{
             $this->validate($data,['correo' => 'required | max:80 |email | unique:institucion,email,'. $data->email]);
             $correo = Institucion::actualizarCorreo($data->correo);
             return $correo;

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
          } 
    }
    public function actualizar_clave(Request $data){
      try{
          $this->validate($data,
                [
                'clave_actual' => 'required | min:6',
                'clave_nueva' => 'required | min:6',
                'confirm_clave_nueva' => 'required|same:clave_nueva'
            ]);
            $pass = Institucion::find(\Auth::guard('institucion')->user()->id)->get();
            if (\Hash::check($data->clave_actual, $pass[0]->password)) {
                    $clave = Institucion::actualizarClave($data->clave_nueva);
                    return $clave;
            }
            return redirect()->back()->withErrors(['Clave actual incorrecta']);
            
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
          } 
       //$clave = Institucion::;
    }
    public function actualizar_logo(Request $data)
    {
       try{
              $this->validate($data,['logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg | dimensions:max_width=2250,max_height=2680',]);

              
              $logo = Institucion::actualizarLogo($data);

              if ($logo) {
                 return redirect()->back();
              }
              return redirect()->back();




       } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
          } 
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
                'paginaWeb' => 'required | url | max:50',
          ]);

          $ingresarweb = Institucion::ingresar_paginaweb($dato->paginaWeb);

          if ($ingresarweb) {
              
              \Session::flash('web', 'Sitio web ingresado');
              return redirect()->back();
          }
    }

    public function actualizar_nombreArea(Request $dato){
          try{   
             $this->validate($dato,[
                  'nombreDeArea' => 'required',
            ]);

              $ingresarNombre = Area::actualizar_nombre($dato); 
              if ($ingresarNombre) {

                \Session::flash('ingreso', 'Operación exitosa');
                  return redirect()->back();
              }
              return redirect()->back()->withErrors(['Error en la operación']);

            } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
            }

    }

    public function actualizar_descripcion(request $dato)
    {
      try{
            $this->validate($dato,[
                  'descripcion' => 'required',
            ]);

              $ingresarDesc = Area::actualizar_descripcion($dato); 
              if ($ingresarDesc) {

                \Session::flash('ingreso', 'Operación exitosa');
                  return redirect()->back();
              }
              return redirect()->back()->withErrors(['Error en la operación']);

      } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
      }
    }

    public function buscarUsuarioParaCambiarPassword(Request $dato)
    {
        $user = User::filtroBusarUser($dato->buscar);
        return response()->json($user);
    }

    /*PUBLICACION DE LOS PRODUCTOS*/
    public function publicarproducto(productoInstiRequest $datos){
      
      try{
       $institucion = Area::traer();

       $insertProducto = producto::insertar($datos);

       if ($insertProducto > 0) {
           
            $insertFotoProducto = foto_producto::insertar($datos, $insertProducto);

           if ($insertFotoProducto > 0) {

                $tienda = Tienda_institucion::id_tienda_by_institucion(\Auth::guard('institucion')->user()->id);
                //dd($tienda[0]->id);
                $insertTiendaProducto = Tienda_producto_institucion::insertar($insertProducto, $tienda[0]->id, '1', $datos->area);
               
               if ($insertTiendaProducto > 0) {

                   \Session::flash('registro', 'Producto registrado correctamente');
                return redirect()->back();
               }
               return "Mal todo";
               /*\Session::flash('registro', 'Producto registrado correctasmente');
                return redirect()->back();*/
           }
           return redirect()->back()->withErrors(['Algo salió mal']);
        }
      } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
      }
    }
    /*FIN DE PUBLICACION DE LOS PRODUCTOS*/

    /*PUBLICACION DE LOS SERVICIOS*/
    public function publicarservicio(servicioInstRequest $datos)
    {
      $insertarServicio = servicio::insertar($datos);

      if ($insertarServicio > 0) {
        
        $insertarFotoServicio = foto_servicio::insertar($datos, $insertarServicio);

        if ($insertarFotoServicio > 0) {
           $tienda = Tienda_institucion::id_tienda_by_institucion(\Auth::guard('institucion')->user()->id);
           $insertTiendaServicio = Tienda_servicio_institucion::insertar($insertarServicio, $tienda[0]->id, '1', $datos->area);
           if ($insertTiendaServicio > 0) {
               \Session::flash('registro', 'Servicio registrado correctasmente');
                return redirect()->back();
           }
             return "Mal todo";
        }
         return redirect()->back()->withErrors(['Algo salió mal']);
      }
       
    }
     /*FIN DE PUBLICACION DE LOS SERVICIOS*/
    public function eliminar_producto_institucion(Request $dato)
    {

      $getFoto = foto_producto::where('id_producto',$dato->idProducto)->get();
      //return $getFoto[0]->foto;
      \File::delete($getFoto[0]->foto);/*ELIMINAR FOTO*/
      
      $foto_prod = foto_producto::borrar($getFoto[0]->id);
      $tienda_prod_inst = Tienda_producto_institucion::borrar($dato->idProducto);
      //$prod_insti = producto::borrar($dato->idProducto);

      return "true";
    }
    public function eliminar_servicio_institucion(Request $dato)
    { 
       $getFoto = foto_servicio::where('id_servicio',$dato->idServicio)->get();
       \File::delete($getFoto[0]->nombre);/*ELIMINAR FOTO*/
       $foto_servicio = foto_servicio::borrar($getFoto[0]->id);
       $tienda_serv_inst = Tienda_servicio_institucion::borrar($dato->idServicio);
       $serv_insti = servicio::borrar($dato->idServicio);

       return "true";
      
    }
    public function actualizar_producto_foto(Request $dato)
    {
      try{
          $this->validate($dato,[
                    'foto' => 'required|mimes:jpeg,bmp,png,gif|dimensions:max_width=5500,max_height=5500',
              ]);
          //dd($dato->idProducto);
          $actualizar = foto_producto::actualizar_foto($dato);
          if ($actualizar > 0) {
              \Session::flash('correcto', 'Foto actualizada correctamente');
              return redirect()->back();
          }
          return redirect()->back();

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }
    }
    public function actualizar_producto_nombre(Request $dato)
    {
        try{
               $this->validate($dato,[
                    'nombre' => 'required | max:50',
              ]);
              $nombre = producto::actualizar_nombre($dato);
              if ($nombre) {
                \Session::flash('correcto', 'Nombre actualizado correctamente');
                return redirect()->back();
              }
              return redirect()->back();
       } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }
    }
    public function actualizar_producto_descripcion(Request $dato)
    {
      try{
            $this->validate($dato,[
                    'descripcion' => 'required | max:250',
              ]);
              $desc = producto::actualizar_descripcion($dato);
              if ($desc) {
                \Session::flash('correcto', 'Descripcion actualizada correctamente');
                return redirect()->back();
              }
              return redirect()->back();
       } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }
    }
     public function actualizar_producto_precio(Request $dato)
    {
        try{
             $this->validate($dato,[
                  'precio' => 'required | numeric',
            ]);
            $cant = producto::actualizar_precio($dato);
            if ($cant) {
              \Session::flash('correcto', 'Precio actualizado correctamente');
              return redirect()->back();
            }
            return redirect()->back();

       } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }

    }
    public function actualizar_producto_cantidad(Request $dato)
    {
      try{
            $this->validate($dato,[
                  'cantidad' => 'required | numeric',
            ]);
            $cant = producto::actualizar_cantidad($dato);
            if ($cant) {
              \Session::flash('correcto', 'Cantidad actualizada correctamente');
              return redirect()->back();
            }
            return redirect()->back();

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }     

    }
    public function actualizar_producto_visibilidad(Request $dato)
    {
      try{
               $this->validate($dato,[
                    'estadoV' => 'required',
              ]);

              $visibi = producto::actualizar_visibilidad($dato);
              if ($visibi) {
                return redirect()->back();
              }
              return redirect()->back();

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }       

    }public function actualizar_producto_categoria(Request $dato)
    {
      try{
            $this->validate($dato,[
                    'categoria' => 'required',
              ]);

            $categ = producto::actualizar_categoria($dato);
              if ($categ) {
                
                return redirect()->back();
              }
              return redirect()->back();

      } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }    

    }public function actualizar_producto_area(Request $dato)
    {
      try{
          $this->validate($dato,[
                    'area' => 'required',
              ]);
          $area = producto::actualizar_area($dato);
              if ($area) {
                //\Session::flash('correcto', 'Cantidad actualizada correctasmente');
                return redirect()->back();
              }
              return redirect()->back();

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }          
    }

    public function filtrarProducto(Request $datos)
    {
      $this->validate($datos,[
                'buscar' => 'required | max:100',
          ]);
      $productos = producto::filtrar_desde_admin($datos->buscar);

      return view('institucion.nuestroProducto')
      ->with('productos', $productos)
      ->with('titulo', "Filtrado de productos");
    }
    public function filtrarServicio(Request $datos)
    {
      $this->validate($datos,[
                'buscar' => 'required',
          ]);
      $servicios = servicio::filtrar_desde_admin($datos->buscar);

      return view('institucion.nuestroServicio')
      ->with('servicios', $servicios)
      ->with('titulo', "Filtrado de servicios");
    }

    public function publicarNoticia(noticiaRequest $datos)
    {
     
      $noticia = noticia::insertar($datos, \Auth::guard('institucion')->user()->id);
      if ($noticia > 0) {
        \Session::flash('correcto', 'Noticia ingresada');
         return redirect()->back();
      }
       $datos->flash();
      return redirect()->back()->withErrors(['Algo salió mal']);
    }

    public function actualizar_nombre_alumno(Request $dato)
    {
      try{
         $this->validate($dato,[
                  'nombres' => 'required',
            ]);

           $update = User::actualizarNombres($dato->nombres, $dato->idUser);

           if ($update) {
                \Session::flash('correcto', 'Nombres actualizados');
                return redirect()->back();
           }
      } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }    

    }
    public function actualizar_fecha_alumno(Request $dato)
    {
      try{
         $this->validate($dato,[
                  'fecha' => 'required | date',
            ]);

           $update = vendedor::actualizarFecha($dato->fecha, $dato->idUser);

           if ($update) {
                \Session::flash('correcto', 'Nombres actualizados');
                return redirect()->back();
           }
      } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }    

    }
     public function actualizar_apellido_alumno(Request $dato)
    {
      try{
           $this->validate($dato,[
                    'apellidos' => 'required',
              ]);

             $update = User::actualizarApellidos($dato->apellidos, $dato->idUser);

             if ($update) {
                  \Session::flash('correcto', 'Apellidos actualizados');
                  return redirect()->back();
             }
      } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }    

    }
    public function actualizar_correo_alumno(Request $dato)
    {
      try{
         $this->validate($dato,[
                  'correo' => 'required',
            ]);

           $update = User::actualizar_Correo($dato->correo, $dato->idUser);

           if ($update) {
                \Session::flash('correcto', 'Correo actualizado');
                return redirect()->back();
           }

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }    

    }
    public function actualizar_area_alumno(Request $dato)
    {
      try{
            $this->validate($dato,[
                  'area' => 'required',
            ]);

           $vendedor = Vendedor::where('id_user', $dato->idUser)->first();
           $update = VendedorInstitucion::actualizar_area_alumno($dato->area, $vendedor->id);

           if ($update) {
                \Session::flash('correcto', 'Área actualizada');
                return redirect()->back();
           }
      } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }    

    }
    public function actualizar_numero_alumno(Request $dato)
    {
      try{
           $this->validate($dato,[
                    'numero' => 'required|min:11|numeric',
              ]);

             $update = Vendedor::actualizar_numero($dato->numero, $dato->idUser);

             if ($update) {
                  \Session::flash('correcto', 'Número actualizado');
                  return redirect()->back();
             }
       } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }          

    }
    public function actualizar_foto_alumno(Request $dato)
    {
      try{
          $this->validate($dato,[
                  'foto' => 'required|mimes:jpeg,bmp,png,gif|dimensions:max_width=5500,max_height=5500',
            ]);


           $update = Fotoperfil::actualizar_foto($dato);

           return $update;
      } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }         
    }

    public function actualizar_titulo_noticia(Request $datos)
    {
      try{
         $this->validate($datos,['titulo' => 'required|max:150',]);
         $noticia = noticia::find($datos->noticia);
         $noticia->titulo = $datos->titulo;
         if ($noticia->save()) {
              \Session::flash('correcto', 'Título actualizado');
                return redirect()->back();
         }

      } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }    
    }
    public function actualizar_texto_noticia(Request $datos)
    {
      try{
         $this->validate($datos,['texto' => 'required|max:3500',]);
          $noticia = noticia::find($datos->noticia);
          $noticia->texto = $datos->texto;
          if ($noticia->save()) {
              \Session::flash('correcto', 'Título actualizado');
                return redirect()->back();
         }
       } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }      
    }
    public function actualizar_estado_noticia(Request $datos)
    {
      try{
         $this->validate($datos,['estado' => 'required',]);
         $noticia = noticia::find($datos->noticia);
         $noticia->id_estado = $datos->estado;
         if ($noticia->save()) {
              \Session::flash('correcto', 'Estado actualizado');
                return redirect()->back();
         }
      } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }    
    }
    public function productos_oclutos()
    {
      $productos = producto::productosOcultosDesdeAdmin();
      return view('institucion.nuestroProducto')
      ->with('productos', $productos)
      ->with('titulo', "Productos ocultos"); 
    }
    public function servicios_ocultos()
    {
       $servicios = servicio::serviciosOcultosDesdeAdmin();
       return view('institucion.nuestroServicio')
       ->with('servicios', $servicios)
       ->with('titulo', "Servicios ocultos"); 
    }
    public function actualizar_servicio_nombre(Request $dato)
    {
      try{
          $this->validate($dato,['nombre' => 'required|max:50',]);

          $servicio = servicio::find($dato->idServicio);
          $servicio->nombre = ucfirst($dato->nombre);
          if ($servicio->save()) {
              \Session::flash('correcto', 'Nombre actualizado');
              return redirect()->back();
           } 
       } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }    
    }
    public function actualizar_servicio_descripcion(Request $dato)
    {
      try{
          $this->validate($dato,['descripcion' => 'required|max:250',]);

          $servicio = servicio::find($dato->idServicio);
          $servicio->descripcion = ucfirst($dato->descripcion);
          if ($servicio->save()) {
              \Session::flash('correcto', 'Descripción actualizada');
              return redirect()->back();
           } 
       } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }        
    }
    public function actualizar_servicio_categoria(Request $dato)
    {
      try{
            $this->validate($dato,['categoria' => 'required',]);

            $servicio = servicio::find($dato->idServicio);
            $servicio->id_categoria = $dato->categoria;
            if ($servicio->save()) {
                \Session::flash('correcto', 'Categoría actualizada');
                return redirect()->back();
             } 
       } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }          
    }
    public function actualizar_servicio_visibilidad(Request $dato)
    {
      try{
          $this->validate($dato,['estado' => 'required',]);

          $servicio = Tienda_servicio_institucion::where('id_servicio',$dato->idServicio)->first();
          $servicio->id_estado = $dato->estado;
          if ($servicio->save()) {
              \Session::flash('correcto', 'Estado actualizado');
              return redirect()->back();
           } 
       } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }        
    }
    public function actualizar_servicio_area(Request $dato)
    {
      try{
            $this->validate($dato,['area' => 'required',]);

            $servicio = Tienda_servicio_institucion::where('id_servicio',$dato->idServicio)->first();
            $servicio->id_area = $dato->area;
            if ($servicio->save()) {
                \Session::flash('correcto', 'Estado actualizado');
                return redirect()->back();
             } 
      } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }         
    }
     public function actualizar_servicio_foto(Request $dato)
    {
      try{
          $this->validate($dato,['foto' => 'required|mimes:jpeg,bmp,png,gif|dimensions:max_width=5500,max_height=5500',]);

          $foto = foto_servicio::where('id_servicio',$dato->idServicio)->first();

          \File::delete($foto->nombre);/*ELIMINAR FOTO*/
          $url="foto_servicios";
          $file = $dato->file('foto')->getClientOriginalExtension();
          $imageName = time().'.'.$dato->file('foto')->getClientOriginalExtension();//nombre de la imagen como tal.
          $foto->nombre = $url.'/'.$imageName;
          if ($foto->save()) {
                $dato->file('foto')->move(public_path($url), $imageName);
               
                \Session::flash('correcto', 'Foto actualizada');
                return redirect()->back();
           } 

       } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }        
    }
  
}
