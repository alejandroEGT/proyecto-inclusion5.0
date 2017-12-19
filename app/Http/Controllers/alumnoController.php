<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\productoRequest;
use App\Http\Requests\servicioRequest;
use App\User;
use App\Usuarioinstitucion;
use App\VendedorInstitucion;
use App\Fotoperfil;
use App\Vendedor;
use App\Passwordcuenta;
use App\Encargado;
use App\Area;
use App\categoria_producto;
use App\categoria_servicio;
use App\producto;
use App\servicio;
use App\foto_producto;
use App\foto_servicio;
use App\Tienda_institucion;
use App\Tienda_producto_institucion;
use App\Tienda_servicio_institucion;
use App\estado_tienda_servicio;
use App\estado_tienda_producto;
use App\noticia;
use App\estado_noticia;
use App\Institucion;
use Illuminate\Support\Facades\Mail;
use PDF;

class alumnoController extends Controller
{
  public function vista_detalleAlumno_inst(request $dato)
  {
        $getId = base64_decode($dato->id);
        $area = Area::traer();
        $alumno = VendedorInstitucion::detalleAlumno($getId, \Auth::guard('institucion')->user()->id);

        //return $alumno;
        return view('institucion.verDetalleAlumno')
        ->with('alumno', $alumno)
        ->with('area', $area);

  }
public function vista_detalleAlumno_enc(request $dato)
{   
    $getId = base64_decode($dato->id);
    $encargado = Encargado::traerDatos();
    $alumno = VendedorInstitucion::detalleAlumno_enc($getId, $encargado[0]->id_area);
    
    return view('encargadoArea.verDetalleAlumno')->with('alumno', $alumno);
}
public function ver_todo_producto()
{       
        $alumno = VendedorInstitucion::traerDatos();
        $producto = producto::verProductoDesdeArea($alumno->id_area, 5);
        //dd ($producto);
        return view('vendedorDependiente.verTodoProducto')
        ->with([
            'productos' => $producto,
            'contador' => 1
        ]);
}
	public function generarClave(Request $id){

        $genclave = $this->genclave();
        $estadoPass =  \DB::table('password-cuenta')
                        ->where('id_user', $id->id)
                        ->update(['id_estado' => 1]);
                        

        $alumno = User::find($id->id);
        $correo = $alumno->email;

        $alumno->password = bcrypt($genclave);
        if ($alumno->save()) {
        	\Session::put('usuario',$alumno->nombres.' '.$alumno->apellidos);//obtener usuario y enviarlo a clave.blade.php
	        \Session::put('clave',$genclave);//obtener clave y enviarlo a clave.blade.php

	        Mail::send(['html'=>'emails.recuperaClave'],['name','al'],function ($message) use ($correo)
	        {
	            $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
	            $message->to($correo,'to');
	        });

	        return "operacion exitosa"; 
	    }
        
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
        
        return view('vendedorDependiente.perfil_vendedorInstitucion')
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
    public function vista_herramientas()
    {
        return view('vendedorDependiente.herramientas');
    }
    public function vista_perfilInst($idinstitucion){

        $idI = base64_decode($idinstitucion);
        $institucion = Institucion::find($idI);
        $productos = producto::verProductosVisibles($institucion->id, 5);
        $areas = Area::where('id_institucion', $idI)->get();
        $servicios = servicio::mostrarServicioDesdeAdmin($institucion->id, 5);

        return view('vendedorDependiente.perfil_institucion')
        ->with('institucion', $institucion)
        ->with('servicios', $servicios)
        ->with('productos', $productos)
        ->with('idInstitucion', $idinstitucion)
        ->with('areas', $areas);
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
            
            return view('vendedorDependiente.areaExterna')->with([
                'institucion' => $institucion,
                'area' => $area,
                'productos' => $productos,
                'servicios' => $servicios,
                'alumnos' => $alumnos,
                'encargado' => $encargado
            ]);
        
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
      return view('vendedorDependiente.verDetalleProductoInstitucionBuscar')
      ->with('productos', $productos)
      ->with('categoria', $categoria)
      ->with('estadoP', $estadoP)
      ->with('area', $area);
    }

    public function genclave(){
      $cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $cadena_base .= '0123456789' ;
      $cadena_base .= 'kkck';
      $password = '';
      $limite = strlen($cadena_base) - 1;
 
      for ($i=0; $i < 4; $i++)
        $password .= $cadena_base[rand(0, $limite)];
        return $password;
    }

    public function eliminar_alumno($dato)
    {
         //return response()->json($dato[0]);
          try{
           
              $vendedor = Vendedor::idVendedor($dato);

              $fotoalumno = VendedorInstitucion::traerFoto($dato);
              if ("ico/default-avatar.png" === $fotoalumno[0]->foto) {
                
                $eliminarFoto = Fotoperfil::eliminar($dato);
                $eliminarVi = VendedorInstitucion::eliminar($vendedor[0]->id);
                $eliminarvendedor = Vendedor::eliminar($dato);
                $eliminarpasswordcuenta = Passwordcuenta::eliminar($dato);
                $eliminaruser = User::eliminar($dato);
                          
                \Session::flash('correcto', 'Alumno borrado con exito');
                return redirect()->back();

              }
              //return "0";
                $foto = Fotoperfil::where('id_user', $dato)->get();
                //dd($foto[0]->foto);/*CODIGO PENDIENTE PARA BORRAR EN CASO DE QUE SI CAMBIO DE FOTO DEFAULT DE PARTE DEL USUARIO*/
                \File::delete($foto[0]->foto);
                $eliminarFoto = Fotoperfil::eliminar($dato);
                $eliminarVi = VendedorInstitucion::eliminar($vendedor[0]->id);
                $eliminarvendedor = Vendedor::eliminar($dato);
                $eliminarpasswordcuenta = Passwordcuenta::eliminar($dato);
                $eliminaruser = User::eliminar($dato);
                          
                \Session::flash('correcto', 'Alumno borrado con exito');
                return redirect()->back();
            }catch (\Illuminate\Database\QueryException $e) {
                return false;
            }  catch (\Exception $e) {
                 return false;
            }
       
    }
    public function actualizar_foto(Request $dato)
    {
        try{

            $this->validate($dato,['foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg | dimensions:max_width=5500,max_height=5500',]);

            $actualizar = Fotoperfil::actualizar_foto($dato);
            if ($actualizar > 0) {
                \Session::flash('ingresado', 'Foto de perfil actualizada');
                return redirect()->back();
            }
            return redirect()->back();
           

        }catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }
    }

    public function actualizar_nombre(Request $dato)
    {
        try{

            $this->validate($dato,['nombre' => 'required|max:50|min:3',]);

            $user = User::find(\Auth::user()->id);
            $user->nombres = ucfirst($dato->nombre);
            if ($user->save()) {
                \Session::flash('ingresado', 'Nombre actualizado');
                return redirect()->back();
            }
            return redirect()->back()->withErrors(['Algo no anda bien, posible campos erroneos']);

        } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }
    }
    public function actualizar_apellido(Request $dato)
    {
        try{
          $this->validate($dato,['apellido' => 'required|max:50|min:3',]);

            $user = User::find(\Auth::user()->id);
            $user->apellidos =  ucfirst($dato->apellido);
            if ($user->save()) {
                \Session::flash('ingresado', 'Apellido actualizado');
                return redirect()->back();
            }
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);

         } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }   
    }
    public function actualizar_tel(Request $dato)
    {
         try{
            $this->validate($dato,['teléfono' => 'required|numeric',]);

            $user = Vendedor::where('id_user', \Auth::user()->id)->first();
            $user->telefono = $dato->teléfono;
            if ($user->save()) {
                 \Session::flash('ingresado', 'Nº de teléfono actualizado');
                 return redirect()->back();
            }
            return redirect()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);

        } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }
    }
    public function actualizar_fecha(Request $dato)
    {
        try{
            $this->validate($dato,['fecha' => 'required|date',]);

            //$date = new \DateTime($dato->fecha);

            $user = vendedor::where('id_user', \Auth::user()->id)->first();
            $user->fecha_nac =  $dato->fecha;
            if ($user->save()) {
                \Session::flash('ingresado', 'Fecha actualizada');
                return redirect()->back();
            }
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);

         } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }   
    }
    public function actualizar_direccion(Request $dato)
    {
       //$user = User::find(\Auth::user()->id);
    }
    public function actualizar_correo(Request $dato)
    {
        try{
          $this->validate($dato,['correo' => 'required|email|unique:users,email',]);
           $user = User::find(\Auth::user()->id);
            $user->email =  $dato->correo;
            if ($user->save()) {
                \Session::flash('ingresado', 'Correo actualizado');
                return redirect()->back();
            }
            return redirect()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);;

        } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }    
    }
    public function actualizar_clave(Request $data)
    {
         try{
              $this->validate($data,
                    [
                    'clave_actual' => 'required',
                    'clave_nueva' => 'required',
                    'confirm_clave_nueva' => 'required|same:clave_nueva'
                ]);
                $pass = User::find(\Auth::user()->id);
                //dd(\Hash::check($data->clave_actual, $pass->password));
                if (\Hash::check($data->clave_actual, $pass->password)) {
                        $clave = User::find(\Auth::user()->id);
                        $clave->password = bcrypt($data->clave_nueva);
                        if ($clave->save()) {
                            \Session::flash('ingresado', 'Contraseña actualizada');
                            
                          return redirect()->back();
                        }
                        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
                }
                return redirect()->back()->withErrors(['Clave actual incorrecta']);

        } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }        
    }
    public function vista_publicarProducto()
    {
        try{
            $usuario = VendedorInstitucion::traerDatos();
            $categoria_pro = categoria_producto::all();

            //return $encargado[0]->id_institucion.', '.$encargado[0]->id_area;
            //return $usuario->id_area;
            $productos = producto::verProductoDesdeArea($usuario->id_area, 5);

            //return $productos;

            return view('vendedorDependiente.publicarProducto')
                ->with('categoria_pro', $categoria_pro)
                ->with('productos', $productos);

        } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        } 
    }
    /*PUBLICACION DE LOS PRODUCTOS*/
    public function publicarproducto(productoRequest $datos){
       
       try{

           $usuario = VendedorInstitucion::traerDatos();
           
           $insertProducto = producto::insertar($datos);

           if ($insertProducto > 0) {
               
               $insertFotoProducto = foto_producto::insertar($datos, $insertProducto);

               if ($insertFotoProducto > 0) {

                    $tienda = Tienda_institucion::id_tienda_alumno(\Auth::user()->id);/*Modifique aqui hoy*/
                    
                    $insertTiendaProducto = Tienda_producto_institucion::insertar($insertProducto, $tienda[0]->id, '3', $usuario->id_area);
                   
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

     public function vista_publicarServicio()
    { 
        try{
           $alumno = VendedorInstitucion::traerDatos();
           $categoria_serv = categoria_servicio::all();
           $servicios = servicio::mostrarServicioDesdeArea($alumno->id_area, 2);
           return view('vendedorDependiente.publicarServicio')
           ->with('servicios', $servicios)
           ->with('categoria_serv', $categoria_serv);

         } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }  
    }
    public function publicarServicio(servicioRequest $datos)
    {
        try{
              $insertarServicio = servicio::insertar($datos);

              if ($insertarServicio > 0) {
                
                $insertarFotoServicio = foto_servicio::insertar($datos, $insertarServicio);

                if ($insertarFotoServicio > 0) {
                  $idInst = VendedorInstitucion::traerDatos();
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

        } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }       
    }
    public function filtrarProducto(Request $datos)
    {
      $this->validate($datos,[
                'buscar' => 'required',
          ]);
      $alumno = VendedorInstitucion::traerDatos();
      $productos = producto::filtrar_desde_encargado($datos->buscar, $alumno->id_area );

      return view('vendedorDependiente.nuestroProducto')
      ->with('productos', $productos)
      ->with('titulo', "Filtrado de productos");
    }
    public function ver_detalleProducto(Request $dato)
    {
      $getId = base64_decode($dato->id);
      $categoria = categoria_producto::all();
      $estadoP = estado_tienda_producto::limit(2)->get();
      $area = Area::traerArea();
      $alumno = VendedorInstitucion::traerDatos();

      $productos = producto::detalleProducto_area($getId, $alumno->id_area);
      
      return view('vendedorDependiente.verDetalleProducto')
      ->with('productos', $productos)
      ->with('categoria', $categoria)
      ->with('estadoP', $estadoP)
      ->with('area', $area);
    }
    public function filtrarServicio(Request $datos)
    {
      $this->validate($datos,[
                'buscar' => 'required',
          ]);
      $alumno = VendedorInstitucion::traerDatos();
      $servicios = servicio::filtrar_desde_encargado($datos->buscar, $alumno->id_area, $alumno->id_institucion);

      return view('vendedorDependiente.nuestroServicio')
      ->with('servicios', $servicios)
      ->with('titulo', "Filtrado de servicios");
    }
    public function ver_detalleServicio(Request $dato)
    {
      $getId = base64_decode($dato->id);
      $categoria = categoria_servicio::all();
      $estadoS = estado_tienda_servicio::limit(2)->get();
      $area = Area::all();
      $alumno = VendedorInstitucion::traerDatos();

      $servicio = servicio::detalleServicio_desdeArea($getId, $alumno->id_institucion, $alumno->id_area);
      //return $servicio;
      return view('vendedorDependiente.verDetalleServicio')
              ->with('categoria',$categoria)
              ->with('estadoS',$estadoS)
              ->with('area',$area)
              ->with('servicio',$servicio);
    }
     public function ver_todo_servicio()
    {
        $alumno = VendedorInstitucion::traerDatos();
        $servicios = servicio::mostrarServicioDesdeArea($alumno->id_area, 5);
        //dd($producto);
        return view('vendedorDependiente.verTodoServicio')->with([
            'servicios' => $servicios,
            'contador' => 1
        ]);
    }
     public function todas_noticias_generales()
    {
       $noticias_generales = noticia::todas();
       return view('vendedorDependiente.noticias_generales')->with('noticias_generales',$noticias_generales);
    }
      public function todas_noticias_locales()
    {
       $alumno = VendedorInstitucion::traerDatos();
       $estado_noticia = estado_noticia::all();
       $noticias_locales = noticia::detalleNoticia($alumno->id_institucion);
       return view('vendedorDependiente.noticias_locales')
       ->with('noticias_locales', $noticias_locales)
       ->with('estado_noticia',$estado_noticia);
    }
    public function ver_detalleNoticia_general(Request $dato)
    {   
        $noticia = noticia::unica_general(base64_decode($dato->idNoticia));
        //dd($noticia);
        return view('vendedorDependiente.noticia_individual_general')->with('noticia', $noticia);
    }
    public function ver_detalleNoticia_local(Request $dato)
    {   
         $alumno = VendedorInstitucion::traerDatos();
         $noticia = noticia::unica_local(base64_decode($dato->idNoticia), $alumno->id_institucion);
        //dd($noticia);
         $estado_noticia = estado_noticia::all();
        return view('vendedorDependiente.noticia_individual_local')
               ->with('noticia', $noticia)
               ->with('estado_noticia', $estado_noticia);
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
      return view('vendedorDependiente.verDetalleServicioInstitucionBuscador')
              ->with('categoria',$categoria)
              ->with('estadoS',$estadoS)
              ->with('area',$area)
              ->with('servicio',$servicio);
    }
     public function traerProductoEnEspera()
    {
      $alumno = VendedorInstitucion::traerDatos();
      $prod_esp = producto::traerProductoEnEspera_desdeArea($alumno->id_institucion, $alumno->id_area, 10);
       return view('vendedorDependiente.productoEspera', ['prod_esp' => $prod_esp]);
    }
    public function traerServicioEnEspera()
    {
       $alumno = VendedorInstitucion::traerDatos();
       $serv_esp = servicio::traer_ServicioEnEspera_desdeArea($alumno->id_institucion, $alumno->id_area, 10);
       return view('vendedorDependiente.servicioEspera', ['serv_esp' => $serv_esp]);
    }

    public function vista_detalleServicioEspera(Request $dato)
    {

      $getId = base64_decode($dato->idServicio);
      $categoria = categoria_servicio::all();
      $estadoS = estado_tienda_servicio::limit(2)->get();
      $area = Area::all();
      $alumno = VendedorInstitucion::traerDatos();
       //dd($alumno);
      $servicio = servicio::detalleServicio_desdeArea($getId, $alumno->id_institucion, $alumno->id_area);

      return view('vendedorDependiente.detalleServicioEspera')
              ->with('categoria',$categoria)
              ->with('estadoS',$estadoS)
              ->with('area',$area)
              ->with('servicio',$servicio);
    
    }
    public function vista_todo_producto_alumno(Request $dato)
    {
      $idAlumno = base64_decode($dato->id);
      $vendedor = Vendedor::find($idAlumno);
      $vendedorInst = VendedorInstitucion::where('id_vendedor', $vendedor->id)->first();
      $vista_alumno = VendedorInstitucion::detalleAlumno($vendedor->id_user, $vendedorInst->id_institucion );
      $alumno = VendedorInstitucion::where('id_vendedor', $idAlumno)->first();
      
      $productos = producto::verProductoDesdeArea($alumno->id_area, 10);
      return view('vendedorDependiente.verTodoProductoAlumno')
             ->with('alumno', $vista_alumno->first())
             ->with('institucion_id', $vendedorInst->id_institucion)
             ->with('productos', $productos);
    }
    public function vista_todo_producto_area(Request $dato)
    {
      $area_id = base64_decode($dato->id);
      $area = Area::find($area_id);

      $productos = producto::verProductoDesdeArea($area_id, 10);
      return view('vendedorDependiente.verTodoProductoArea')
           ->with('institucion_id', $area->id_institucion)
           ->with('area', $area)
           ->with('productos', $productos);
    }

    public function vista_todo_producto_institucion(request $dato)
    {
      $id_institucion = base64_decode($dato->id);
      $vista_institucion = Institucion::find($id_institucion);

      $productos = producto::traetProductosDesdeAdmin($id_institucion, 10);
      return view('vendedorDependiente.verTodoProductoInstitucion')
             ->with('institucion', $vista_institucion)
             ->with('productos', $productos);
    }
    public function vista_todo_producto_vendedor(request $dato)
    {
       $id_vendedor =base64_decode($dato->id);
       $vista_vendedor = Vendedor::traerDatos($id_vendedor);
       //dd($vista_vendedor);

      $productos = Tienda_producto_vendedor::mostrar_productos_vendedor($id_vendedor);
      return view('vendedorDependiente.verTodoProductoVendedor')
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

       return view('vendedorDependiente.verTodoServicioAlumno')
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

       return view('vendedorDependiente.verTodoServicioArea')
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
      return view('vendedorDependiente.verTodoServicioInstitucion')->with([
          'institucion' => $institucion,
          'servicios' => $servicios
      ]);
    }
    public function descargar_comando()
    {
         $pdf = PDF::loadView('vendedorDependiente.comando_voz');
           return $pdf->download("comandos_voz_".date('d-m-Y')."pdf");
    }

    
}
