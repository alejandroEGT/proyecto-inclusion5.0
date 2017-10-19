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
use App\Usuarioinstitucion;
use App\categoria_producto;
use App\categoria_servicio;
use App\Tienda_institucion;
use App\estado_tienda_producto;
use App\foto_producto;
use App\foto_servicio;
use App\producto;
use App\servicio;
use App\noticia;
use App\estado_noticia;
use App\estado_tienda_servicio;
use App\Tienda_producto_institucion;
use App\Tienda_servicio_institucion;
use App\Http\Requests\productoRequest;
use App\Http\Requests\agregarAlumnoDesdeAreaRequest;
use App\http\Requests\noticiaRequest;
use Illuminate\Support\Facades\Mail;

class encargadoController extends Controller
{
    public function vista_inicio(){

        $encargado = Encargado::traerDatos();
        $productos = producto::verProductoDesdeArea($encargado[0]->id_area, 4);
        $servicios = servicio::verServicioDesdeArea($encargado[0]->id_area, 4);
    	  $foto = Fotoperfil::traerFoto();
        $estado_password = Passwordcuenta::traerEstado();
        $logo = Area::traerArea();
        $noticias_generales = noticia::noticias_generales();
        $noticias_locales = noticia::noticias_locales($encargado[0]->id_institucion);
    	return view('encargadoArea.inicio')
        ->with('foto',$foto)
        ->with('estado_password',$estado_password)
        ->with('logo', $logo[0]->logo)
        ->with('productos', $productos)
        ->with('servicios', $servicios)
        ->with('noticias_generales',$noticias_generales)
        ->with('noticias_locales',$noticias_locales);
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

        $encargado = Encargado::traerDatos();
        $categoria_pro = categoria_producto::all();

        //return $encargado[0]->id_institucion.', '.$encargado[0]->id_area;
        $productos = producto::verProductoDesdeArea($encargado[0]->id_area, $encargado[0]->id_area);

        //return $productos;

        return view('encargadoArea.publicarProducto')
            ->with('categoria_pro', $categoria_pro)
            ->with('productos', $productos);
    }

    public function vista_clave(){
      
        return view('encargadoArea.clave');
    }
    public function vista_publicarServicio(Request $datos)
    { 
       $area = Area::traerArea();
       $categoria_serv = categoria_servicio::all();
       $servicios = servicio::mostrarServicioDesdeArea($area[0]->id_area, 2);
       return view('encargadoArea.publicarServicio')
       ->with('servicios', $servicios)
       ->with('categoria_serv', $categoria_serv);
    }
    public function vista_publicarNoticia()
    {
      $estado_noticia = estado_noticia::all();
      return view('encargadoArea.publicarNoticia')->with('estado_noticia', $estado_noticia);
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
    public function ver_todo_producto()
    {
        $encargado = Encargado::traerDatos();
        $producto = producto::verProductoDesdeArea($encargado[0]->id_area, 5);
        //dd ($producto);
        return view('encargadoArea.verTodoProducto')->with('productos', $producto);
    }
     public function ver_todo_servicio()
    {
        $encargado = Encargado::traerDatos();
        $servicios = servicio::mostrarServicioDesdeArea($encargado[0]->id_area, 5);
        //dd($producto);
        return view('encargadoArea.verTodoServicio')->with('servicios', $servicios);
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
        
        //return view('encargadoArea.perfil_vendedorInstitucion')->with('foto',$foto)->with('usuario',$usuario);
    }

     public function vista_perfilInst($idinstitucion){

        $idI = base64_decode($idinstitucion);
        $institucion = Institucion::find($idI);
        $productos = producto::verProductosVisibles($institucion->id, 5);
        $servicios = servicio::mostrarServicioDesdeAdmin($institucion->id, 5);

        return view('encargadoArea.perfil_institucion')
        ->with('institucion', $institucion)
        ->with('servicios', $servicios)
        ->with('productos', $productos)
        ->with('idInstitucion', $idinstitucion);
    }
    public function vista_agregarAlumno(){
        $id_area = Encargado::traerDatos();
        $id_institucion = Encargado::traerDatos(); 
        $sexo = Sexo::all();
        return view('encargadoArea.agregar_alumno')->with('sexo', $sexo)->with('id_institucion', $id_institucion[0]->id_institucion)
              ->with('id_area', $id_area[0]->id_area);
    }
    public function ver_detalleProducto(Request $dato)
    {
      $getId = base64_decode($dato->id);
      $categoria = categoria_producto::all();
      $estadoP = estado_tienda_producto::limit(2)->get();
      $area = Area::traerArea();
      $encargado = Encargado::traerDatos();

      $productos = producto::detalleProducto_area($getId, $encargado[0]->id_area);
      
      return view('encargadoArea.verDetalleProducto')
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
      $area = Area::all();
      $encargado = Encargado::traerDatos();

      $servicio = servicio::detalleServicio_desdeArea($getId, $encargado[0]->id_institucion, $encargado[0]->id_area);
      //return $servicio;
      return view('encargadoArea.verDetalleServicio')
              ->with('categoria',$categoria)
              ->with('estadoS',$estadoS)
              ->with('area',$area)
              ->with('servicio',$servicio);
    }
    public function todas_noticias_locales()
    {
       $encargado = Encargado::traerDatos();
       $estado_noticia = estado_noticia::all();
       $noticias_locales = noticia::detalleNoticia($encargado[0]->id_institucion);
       return view('encargadoArea.noticias_locales')
       ->with('noticias_locales', $noticias_locales)
       ->with('estado_noticia',$estado_noticia);
    }
     public function todas_noticias_generales()
    {
       $noticias_generales = noticia::todas();
       return view('encargadoArea.noticias_generales')->with('noticias_generales',$noticias_generales);
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

                        Mail::send(['html'=>'emails.cambioClave'],['name','janin'],function ($message) use ($correo)
                        {
                            $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
                            $message->to($correo,'to jano');

                        });
                        \Session::flash('clave', 'Contraseña actualizada correctasmente');
                        \Session::flash('cambioClave', 'Contraseña actualizada correctasmente');/*Mostrar cambio de clave en el inicio cuando se actualize*/
                        return redirect()->back();
                }
                return "Error...";
    }

    public function actualizar_correo(Request $dato){

        $this->validate($dato,[
            'correo' => 'required',
        ]);

        $actualizarCorreo = User::actualizarCorreo($dato->correo);

        if ($actualizarCorreo) {
            return redirect()->back();
        }
        return "error";
    }
    public function actualizar_numero(request $dato){

          $this->validate($dato,[
            'teléfono' => 'required|numeric',
          ]);

        $actualizarNumero = Usuarioinstitucion::actualizarNumero($dato->teléfono);

        if ($actualizarNumero == 1) {
            return redirect()->back();
        }
        return "falso falsoe";
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
                                         Mail::send(['html'=>'emails.clave'],['name','janin'],function ($message) use ($correo)
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

    public function traerEstadoClave(){

        $traer = Encargado::traerEstadoClave();
        return $traer;
    }
    /*PUBLICACION DE LOS PRODUCTOS*/
    public function publicarproducto(productoRequest $datos){
       
       $encargado = Encargado::traerDatos();
       
       $insertProducto = producto::insertar($datos);

       if ($insertProducto > 0) {
           
           $insertFotoProducto = foto_producto::insertar($datos, $insertProducto);

           if ($insertFotoProducto > 0) {

                $tienda = Tienda_institucion::id_tienda(\Auth::user()->id);/*Modifique aqui hoy*/
                
                $insertTiendaProducto = Tienda_producto_institucion::insertar($insertProducto, $tienda[0]->id, '3', $encargado[0]->id_area);
               
               if ($insertTiendaProducto > 0) {
                   \Session::flash('registro', 'Producto registrado correctamente, esperar a que la institución lo analice y acepte');
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

      public function actualizar_producto_foto(Request $dato)
    {
      $this->validate($dato,[
                'fotoP1' => 'required|mimes:jpeg,bmp,png,gif|dimensions:max_width=2500,max_height=2850',
          ]);
      //dd($dato->idProducto);
      $actualizar = foto_producto::actualizar_foto($dato);
      if ($actualizar > 0) {
          \Session::flash('correcto', 'Foto actualizada correctasmente');
          return redirect()->back();
      }
      return redirect()->back();
    }
    public function actualizar_producto_nombre(Request $dato)
    {
      $this->validate($dato,[
                'nombre' => 'required | max:50',
          ]);
          $nombre = producto::actualizar_nombre($dato);
          if ($nombre) {
            \Session::flash('correcto', 'Nombre actualizado correctasmente');
            return redirect()->back();
          }
          return redirect()->back();
    }
    public function actualizar_producto_descripcion(Request $dato)
    {
      $this->validate($dato,[
                'descripcion' => 'required | max:250',
          ]);
          $desc = producto::actualizar_descripcion($dato);
          if ($desc) {
            \Session::flash('correcto', 'Descripcion actualizada correctasmente');
            return redirect()->back();
          }
          return redirect()->back();
    }
    public function actualizar_producto_cantidad(Request $dato)
    {
      $this->validate($dato,[
                'cantidad' => 'required | numeric',
          ]);
          $cant = producto::actualizar_cantidad($dato);
          if ($cant) {
            \Session::flash('correcto', 'Cantidad actualizada correctasmente');
            return redirect()->back();
          }
          return redirect()->back();

    }
    public function actualizar_producto_visibilidad(Request $dato)
    {
      $this->validate($dato,[
                'estadoV' => 'required',
          ]);

          $visibi = producto::actualizar_visibilidad($dato);
          if ($visibi) {
            return redirect()->back();
          }
          return redirect()->back();

    }public function actualizar_producto_categoria(Request $dato)
    {
      $this->validate($dato,[
                'categoria' => 'required',
          ]);

      $categ = producto::actualizar_categoria($dato);
          if ($categ) {
            
            return redirect()->back();
          }
          return redirect()->back();

    }public function actualizar_producto_area(Request $dato)
    {
      $this->validate($dato,[
                'area' => 'required',
          ]);
      $area = producto::actualizar_area($dato);
          if ($area) {
            //\Session::flash('correcto', 'Cantidad actualizada correctasmente');
            return redirect()->back();
          }
          return redirect()->back();
    }

    public function publicarServicio(Request $datos)
    {
      $insertarServicio = servicio::insertar($datos);

      if ($insertarServicio > 0) {
        
        $insertarFotoServicio = foto_servicio::insertar($datos, $insertarServicio);

        if ($insertarFotoServicio > 0) {
          $idInst = encargado::where('id_user', \Auth::user()->id)->first();
           $tienda = Tienda_institucion::id_tienda_by_institucion($idInst->id_institucion);
           $insertTiendaServicio = Tienda_servicio_institucion::insertar($insertarServicio, $tienda[0]->id, '3', $idInst->id_area);
           if ($insertTiendaServicio > 0) {
               \Session::flash('registro', 'Servicio registrado correctamente, esperar que la institución analice y acepte el servicio');
                return redirect()->back();
           }
             return "Mal todo";
        }
         return redirect()->back()->withErrors(['Algo salió mal']);
      }
    }
    public function publicarNoticia(noticiaRequest $datos)
    {
      $encargado = Encargado::traerDatos();
      $noticia = noticia::insertar($datos, $encargado[0]->id_institucion);
      if ($noticia > 0) {
        \Session::flash('correcto', 'Noticia ingresada');
         return redirect()->back();
      }
      return redirect()->back()->withErrors(['Algo salió mal']);
    }

    public function actualizar_titulo_noticia(Request $datos)
    {
       $this->validate($datos,['titulo' => 'required|max:150',]);
       $noticia = noticia::find($datos->noticia);
       $noticia->titulo = $datos->titulo;
       if ($noticia->save()) {
            \Session::flash('correcto', 'Título actualizado');
              return redirect()->back();
       }
    }
    public function actualizar_texto_noticia(Request $datos)
    {
       $this->validate($datos,['texto' => 'required|max:3500',]);
        $noticia = noticia::find($datos->noticia);
        $noticia->texto = $datos->texto;
        if ($noticia->save()) {
            \Session::flash('correcto', 'Título actualizado');
              return redirect()->back();
       }
    }
    public function actualizar_estado_noticia(Request $datos)
    {
       $this->validate($datos,['estado' => 'required',]);
       $noticia = noticia::find($datos->noticia);
       $noticia->id_estado = $datos->estado;
       if ($noticia->save()) {
            \Session::flash('correcto', 'Estado actualizado');
              return redirect()->back();
       }
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
      return view('encargadoArea.verDetalleServicioInstitucionBuscador')
              ->with('categoria',$categoria)
              ->with('estadoS',$estadoS)
              ->with('area',$area)
              ->with('servicio',$servicio);
    }
     public function ver_detalleProducto_institucion_local(Request $dato)
    {

      $getId = base64_decode($dato->idProducto);
      $getIdInst = base64_decode($dato->idInstitucion);
      //return $getId.",".$getIdInst;
      $categoria = categoria_producto::all();
      $estadoP = estado_tienda_producto::limit(2)->get();
      $area = Area::all();

      $productos = producto::detalleProducto($getId, $getIdInst);
      return view('encargadoArea.verDetalleProductoInstitucionBuscador')
      ->with('productos', $productos)
      ->with('categoria', $categoria)
      ->with('estadoP', $estadoP)
      ->with('area', $area);
    }
     public function filtrarProducto(Request $datos)
    {
      $this->validate($datos,[
                'buscar' => 'required',
          ]);
      $encargado = encargado::traerDatos();
      $productos = producto::filtrar_desde_encargado($datos->buscar, $encargado[0]->id_area );

      return view('encargadoArea.nuestroProducto')
      ->with('productos', $productos)
      ->with('titulo', "Filtrado de productos");
    }
    public function filtrarServicio(Request $datos)
    {
      $this->validate($datos,[
                'buscar' => 'required',
          ]);
      $encargado = encargado::traerDatos();
      $servicios = servicio::filtrar_desde_encargado($datos->buscar, $encargado[0]->id_area, $encargado[0]->id_institucion);

      return view('encargadoArea.nuestroServicio')
      ->with('servicios', $servicios)
      ->with('titulo', "Filtrado de servicios");
    }
     public function traerProductoEnEspera()
    {
      $encargado = encargado::traerDatos();
      $prod_esp = producto::traerProductoEnEspera_desdeArea($encargado[0]->id_institucion, $encargado[0]->id_area, 10);
       return view('encargadoArea.productoEspera', ['prod_esp' => $prod_esp]);
    }
    public function vista_serviciosEspera()
    {
       $encargado = encargado::traerDatos();
       $servicios = servicio::traer_ServicioEnEspera($encargado[0]->id_institucion, $encargado[0]->id_area,5);
       return view('encargadoArea.servicioEspera')->with('serv_esp', $servicios);
    }
     public function productos_oclutos()
    {
      $encargado = encargado::traerDatos();
      $productos = producto::productosOcultosDesdeArea($encargado[0]->id_institucion, $encargado[0]->id_area);
      return view('encargadoArea.nuestroProducto')
      ->with('productos', $productos)
      ->with('titulo', "Productos ocultos"); 
    }
    public function servicios_ocultos()
    {
       $encargado = encargado::traerDatos();
       $servicios = servicio::serviciosOcultosDesdeArea($encargado[0]->id_institucion, $encargado[0]->id_area);
       return view('encargadoArea.nuestroServicio')
       ->with('servicios', $servicios)
       ->with('titulo', "Servicios ocultos"); 
    }
    
}
