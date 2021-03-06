<?php

namespace App\Http\Controllers;

use App\Area;
use App\Encargado;
use App\Fotoperfil;
use App\Http\Requests\agregarAlumnoDesdeAreaRequest;
use App\Http\Requests\noticiaRequest;
use App\Http\Requests\productoRequest;
use App\Institucion;
use App\Passwordcuenta;
use App\Sexo;
use App\Tienda_institucion;
use App\Tienda_producto_institucion;
use App\Tienda_producto_vendedor;
use App\Tienda_servicio_institucion;
use App\User;
use App\Usuarioinstitucion;
use App\Vendedor;
use App\VendedorInstitucion;
use App\categoria_producto;
use App\categoria_servicio;
use App\estado_noticia;
use App\estado_tienda_producto;
use App\estado_tienda_servicio;
use App\foto_producto;
use App\foto_servicio;
use App\noticia;
use App\producto;
use App\servicio;
use App\venta_producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class encargadoController extends Controller
{
    public function vista_inicio(){

        $encargado = Encargado::traerDatos();
        $productos = producto::verProductoDesdeArea($encargado[0]->id_area, 15);
        $servicios = servicio::verServicioDesdeArea($encargado[0]->id_area, 15);
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
        $productos = producto::verProductoDesdeArea($encargado[0]->id_area, 5);

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
        $vendedor = Vendedor::where('id_user',$usuario->id)->first();
        $foto = Fotoperfil::traerFotobyid($idu);
        $productos = producto::traerproductoVendedor($vendedor->id, 5);
        
        return view('encargadoArea.perfil_vendedor')
        ->with('foto',$foto)
        ->with('usuario',$usuario)
        ->with('vendedor',$vendedor)
        ->with('productos', $productos);
    }
    public function ver_todo_producto()
    {
        $encargado = Encargado::traerDatos();
        $producto = producto::verProductoDesdeArea($encargado[0]->id_area, 5);
        //dd ($producto);
        return view('encargadoArea.verTodoProducto')->with([
          'productos' => $producto,
          'contador' => 1
        ]);
    }
     public function ver_todo_servicio()
    {
        $encargado = Encargado::traerDatos();
        $servicios = servicio::mostrarServicioDesdeArea($encargado[0]->id_area, 5);
        //dd($producto);
        return view('encargadoArea.verTodoServicio')->with([
          'servicios' => $servicios,
          'contador' => 1
        ]);
    }
    public function vista_perfilVenInst($iduser){
        $idu = base64_decode($iduser);
          //return $idu;
        $usuario = User::find($idu);
        $vendedor = Vendedor::where('id_user',$usuario->id)->get();
        $vendedorInstitucion = VendedorInstitucion::where('id_vendedor',$vendedor[0]->id)->get();
        $institucion = Institucion::find($vendedorInstitucion[0]->id_institucion);
      
        $productos = producto::verProductoDesdeArea($vendedorInstitucion[0]->id_area , 5);
        $servicios = servicio::mostrarServicioDesdeArea($vendedorInstitucion[0]->id_area, 5);
        $foto = Fotoperfil::traerFotobyid($idu);
        
        return view('encargadoArea.perfil_vendedorInstitucion')
        ->with('foto',$foto)
        ->with('usuario',$usuario)
        ->with('vendedor',$vendedor[0]->telefono)
        ->with('vendedor_id', $vendedor[0]->id)
        ->with('institucion', $institucion)
        ->with('productos', $productos)
        ->with('servicios', $servicios)
        ->with('idInstitucion', base64_encode($vendedorInstitucion[0]->id_institucion));;
        
        //return view('encargadoArea.perfil_vendedorInstitucion')->with('foto',$foto)->with('usuario',$usuario);
    }

     public function vista_perfilInst($idinstitucion){

        $idI = base64_decode($idinstitucion);
        $institucion = Institucion::find($idI);
        $productos = producto::verProductosVisibles($institucion->id, 5);
        $areas = Area::where('id_institucion', $idI)->get();
        $servicios = servicio::mostrarServicioDesdeAdmin($institucion->id, 5);

        return view('encargadoArea.perfil_institucion')
        ->with('institucion', $institucion)
        ->with('servicios', $servicios)
        ->with('productos', $productos)
        ->with('idInstitucion', $idinstitucion)
        ->with('areas', $areas);
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
      
      return view('encargadoArea.verDetalleproducto')
      ->with('productos', $productos)
      ->with('categoria', $categoria)
      ->with('estadoP', $estadoP)
      ->with('area', $area);
    }
    public function vista_detalleProductoEspera(Request $dato)
    {
      $getId = base64_decode($dato->idProducto);
      $categoria = categoria_producto::all();
      $estadoP = estado_tienda_producto::limit(2)->get();
      $area = Area::traerArea();
      $encargado = Encargado::traerDatos();

      $productos = producto::detalleProducto_area($getId, $encargado[0]->id_area);
      
      return view('encargadoArea.detalleProductoEspera')
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
    public function vista_detalleServicioEspera(Request $dato)
    {
      $getId = base64_decode($dato->idServicio);
      $categoria = categoria_servicio::all();
      $estadoS = estado_tienda_servicio::limit(2)->get();
      $area = Area::all();
      $encargado = Encargado::traerDatos();

      $servicio = servicio::detalleServicio_desdeArea($getId, $encargado[0]->id_institucion, $encargado[0]->id_area);
      //return $servicio;
      return view('encargadoArea.detalleServicioEspera')
              ->with('categoria',$categoria)
              ->with('estadoS',$estadoS)
              ->with('area',$area)
              ->with('servicio',$servicio);
    
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
            
            return view('encargadoArea.areaExterna')->with([
                'institucion' => $institucion,
                'area' => $area,
                'productos' => $productos,
                'servicios' => $servicios,
                'alumnos' => $alumnos,
                'encargado' => $encargado
            ]);
        
    }
    public function vista_detalleProductoVendedor(Request $datos)
    {
     
      $idProducto = base64_decode($datos->idProducto);
      $idVendedor = base64_decode($datos->idVendedor);

      $producto = producto::verDetalleProducto($idProducto, $idVendedor);
      //dd($producto);
       return view('encargadoArea.detalleProductoVendedor')->with('producto', $producto);
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
                        //\Session::flash('clave', 'Contraseña actualizada correctasmente');
                        \Session::flash('cambioClave', 'Contraseña actualizada correctamente');/*Mostrar cambio de clave en el inicio cuando se actualize*/
                        return redirect('encargadoArea/inicio');
                }
                return "Error...";
    }

    public function actualizar_correo(Request $dato){

        $this->validate($dato,[
            'correo' => 'required | email | unique:users,email',
        ]);

        $actualizarCorreo = User::actualizarCorreo($dato->correo);

        if ($actualizarCorreo) {
            \Session::flash('ingresado', 'Correo actualizado');
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
            \Session::flash('ingresado', 'Nº telefónico actualizado');
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
                                        \Session::flash('registro', 'Alumno registrado correctamente');
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

        $this->validate($datos,[
                'logo' => 'required|mimes:jpeg,bmp,png,gif|dimensions:max_width=2500,max_height=2850',
          ]);
        $encargado = Encargado::traerDatos();

        $logo = Area::guardarIcono($datos, $encargado[0]->id_institucion, $encargado[0]->id_area);
        
        if ($logo) {
            \Session::flash('ingresado', 'Logo actualizado');
            return redirect()->back();
        }
        return redirect()->back()->withErrors(['No se pudo realizar la operación']);
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
       
       try{
        
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

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
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
       $noticia->titulo = ucfirst($datos->titulo);
       if ($noticia->save()) {
            \Session::flash('correcto', 'Título actualizado');
              return redirect()->back();
       }
    }
    public function actualizar_texto_noticia(Request $datos)
    {
       $this->validate($datos,['texto' => 'required|max:3500',]);
        $noticia = noticia::find($datos->noticia);
        $noticia->texto = ucfirst($datos->texto);
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
    public function ver_detalleNoticia_general(Request $dato)
    {   
        $noticia = noticia::unica_general(base64_decode($dato->idNoticia));
        //dd($noticia);
        return view('encargadoArea.noticia_individual_general')->with('noticia', $noticia);
    }
    public function ver_detalleNoticia_local(Request $dato)
    {   
        $encargado = encargado::traerDatos();
        $noticia = noticia::unica_local(base64_decode($dato->idNoticia), $encargado[0]->id_institucion);
        //dd($noticia);
         $estado_noticia = estado_noticia::all();
        return view('encargadoArea.noticia_individual_local')
               ->with('noticia', $noticia)
               ->with('estado_noticia', $estado_noticia);
    }
    public function vista_todo_producto_alumno(Request $dato)
    {
      $idAlumno = base64_decode($dato->id);
      $vendedor = Vendedor::find($idAlumno);
      $vendedorInst = VendedorInstitucion::where('id_vendedor', $vendedor->id)->first();
      $vista_alumno = VendedorInstitucion::detalleAlumno($vendedor->id_user, $vendedorInst->id_institucion );
      $alumno = VendedorInstitucion::where('id_vendedor', $idAlumno)->first();
      
      $productos = producto::verProductoDesdeArea($alumno->id_area, 10);
      return view('encargadoArea.verTodoProductoAlumno')
             ->with('alumno', $vista_alumno->first())
             ->with('institucion_id', $vendedorInst->id_institucion)
             ->with('productos', $productos);
    }
    public function vista_todo_producto_area(Request $dato)
    {
      $area_id = base64_decode($dato->id);
      $area = Area::find($area_id);

      $productos = producto::verProductoDesdeArea($area_id, 10);
      return view('encargadoArea.verTodoProductoArea')
           ->with('institucion_id', $area->id_institucion)
           ->with('area', $area)
           ->with('productos', $productos);
    }

    public function vista_todo_producto_institucion(request $dato)
    {
      $id_institucion = base64_decode($dato->id);
      $vista_institucion = Institucion::find($id_institucion);

      $productos = producto::traetProductosDesdeAdmin($id_institucion, 10);
      return view('encargadoArea.verTodoProductoInstitucion')
             ->with('institucion', $vista_institucion)
             ->with('productos', $productos);
    }
    public function vista_todo_producto_vendedor(request $dato)
    {
       $id_vendedor =base64_decode($dato->id);
       $vista_vendedor = Vendedor::traerDatos($id_vendedor);
       //dd($vista_vendedor);

      $productos = Tienda_producto_vendedor::mostrar_productos_vendedor($id_vendedor);
      return view('encargadoArea.verTodoProductoVendedor')
             ->with('vendedor', $vista_vendedor)
             ->with('productos', $productos);
    }
    public function vista_todo_servicio_alumno(Request $dato)
    {
       $alumno_id = base64_decode($dato->id);
       $vendedor = Vendedor::find($alumno_id);
       $vendedorInst = VendedorInstitucion::where('id_vendedor', $vendedor->id)->first();
       $alumno_vista = Vendedor::traerDatos($vendedor->id);
       $servicios = servicio::verServicioDesdeArea($vendedorInst->id_area, 10);

       return view('encargadoArea.verTodoServicioAlumno')
              ->with([
                  'servicios' => $servicios,
                  'alumno' => $alumno_vista,
                  'institucion_id' => $vendedorInst->id_institucion,
              ]);
    }
    public function vista_todo_servicio_area(Request $dato)
    {
       $area_id = base64_decode($dato->id);
   
       $area = Area::find($area_id);
       $servicios = Tienda_servicio_institucion::mostrarServiciosArea_paginador($area_id, $area->id_institucion);

       return view('encargadoArea.verTodoServicioArea')
              ->with([
                  'servicios' => $servicios,
                  'area' => $area,
                  //'institucion_id' => $vendedorInst->id_ins,
              ]);
    }
    public function vista_todo_servicio_institucion(Request $dato)
    {
      $institucion_id = base64_decode($dato->id);
      $institucion = Institucion::find($institucion_id);
      $servicios = servicio::mostrarServicioDesdeAdmin($institucion_id, 10);
      //dd($servicios);
      return view('encargadoArea.verTodoServicioInstitucion')->with([
          'institucion' => $institucion,
          'servicios' => $servicios
      ]);
    }
    public function vista_venta(Request $dato)
    {   
        
        $encargado = encargado::traerDatos();
        $fechas = venta_producto::fechas_ventas_enc($encargado[0]->id_area);
        $lista_ventas = venta_producto::traerVentas_para_area($encargado[0]->id_area, $encargado[0]->id_institucion); 
     

        return view('encargadoArea.ventas')->with([
            'ventas' => $lista_ventas,
            'fechas' => $fechas
        ]);
          /*   
          $array_fecha;
          $array_cantidad;

          $fecha_venta = venta_producto::fechas_ventas();

          for ($i=0; $i < count($fecha_venta); $i++) { 
             $array_fecha[$i] = date('d/m/Y', strtotime($fecha_venta[$i]->fecha));
             $cantidad = venta_producto::cantidad_ventas_por_fecha($fecha_venta[$i]->fecha);
             $array_cantidad[$i] = $cantidad;

          }
        //$array_fecha;
        //$array_cantidad;

          $fechas = venta_producto::traerFecha(\Auth::guard('institucion')->user()->id);
          $total = venta_producto::total(\Auth::guard('institucion')->user()->id);
          $ventas = venta_producto::traerVentas(\Auth::guard('institucion')->user()->id);

          //dd($ventas);
         // $query = venta_producto::pruebaq(\Auth::guard('institucion')->user()->id);
           $chart = Charts::create('area', 'highcharts')
              ->title('ventas realizadas (Cantidad)')
              ->elementLabel('Cantidad de ventas')
             ->Labels($array_fecha)
              ->values($array_cantidad)
              ->dimensions(1000,500)

              ->responsive(true);

          return view('institucion.ventas')->with([
                  'fechas' => $fechas,
                  'total' => $total->total,
                  'ventas' => $ventas,
                  'chart' => $chart,
                  //'query' => $query
          ]);
          */

       
    }
     public function traerVentas(Request $dato)
    {

        $array_fechas;
        $array_cantidad;
         $encargado = encargado::traerDatos();
        $fecha_venta = venta_producto::fechas_ventas_enc($encargado[0]->id_area);

        for ($i=0; $i < count($fecha_venta); $i++) { 
           $array_fecha[$i] = $fecha_venta[$i]->fecha;
           $cantidad = venta_producto::cantidad_ventas_por_fecha($fecha_venta[$i]->fecha, $encargado[0]->id_institucion);
     
           $array_cantidad[$i] = $cantidad;

        }
           //$fecha_venta = venta_producto::fechas_ventas();
          
           $fechas = venta_producto::traerFecha($encargado[0]->id_institucion);
           $total = venta_producto::total_segun_fechas($encargado[0]->id_institucion, $dato->fecha);
           $ventas = venta_producto::traerVentas_por_fecha_enc($encargado[0]->id_area, $dato->fecha);

           /* $chart = Charts::create($dato->tipo, 'highcharts')
            ->title('Ventas realizadas (Cantidad)')
            ->elementLabel('Cantidad de ventas')
           ->Labels($array_fecha)
            ->values($array_cantidad)
            ->dimensions(1000,500)

            ->responsive(true);*/

        return view('encargadoArea.ventas')->with([
                'fechas' => $fechas,
                'total' => $total,
                'ventas' => $ventas,
                //'chart' => $chart
        ]);

    }
   
    
}
