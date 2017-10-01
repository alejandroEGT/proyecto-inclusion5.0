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
use App\Tienda_institucion;
use App\estado_tienda_producto;
use App\foto_producto;
use App\producto;
use App\producto_institucion;
use App\Tienda_producto_institucion;
use App\Http\Requests\productoRequest;
use App\Http\Requests\agregarAlumnoDesdeAreaRequest;
use Illuminate\Support\Facades\Mail;

class encargadoController extends Controller
{
    public function vista_inicio(){
        $encargado = Encargado::traerDatos();
        $productos = producto_institucion::verProductoDesdeArea($encargado[0]->id_institucion, $encargado[0]->id_area);
    	$foto = Fotoperfil::traerFoto();
        $estado_password = Passwordcuenta::traerEstado();
        $logo = Area::traerArea();
    	return view('encargadoArea.inicio')
        ->with('foto',$foto)
        ->with('estado_password',$estado_password)
        ->with('logo', $logo[0]->logo)
        ->with('productos', $productos);
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
        $productos = producto_institucion::verProductoDesdeArea($encargado[0]->id_institucion, $encargado[0]->id_area);

        //return $productos;

        return view('encargadoArea.publicarProducto')
            ->with('categoria_pro', $categoria_pro)
            ->with('productos', $productos);
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
        
        //return view('encargadoArea.perfil_vendedorInstitucion')->with('foto',$foto)->with('usuario',$usuario);
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
    public function ver_detalleProducto(Request $dato)
    {
      $getId = base64_decode($dato->id);
      $categoria = categoria_producto::all();
      $estadoP = estado_tienda_producto::limit(2)->get();
      $area = Area::all();

      $productos = producto_institucion::detalleProducto($getId);
      
      return view('encargadoArea.verDetalleProducto')
      ->with('productos', $productos)
      ->with('categoria', $categoria)
      ->with('estadoP', $estadoP)
      ->with('area', $area);
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

       
       $insertProducto = producto_institucion::insertar($datos);

       if ($insertProducto > 0) {
           
           $insertFotoProducto = foto_producto::insertar($datos, $insertProducto);

           if ($insertFotoProducto > 0) {

                $tienda = Tienda_institucion::id_tienda(\Auth::user()->id);/*Modifique aqui hoy*/
                
                $insertTiendaProducto = Tienda_producto_institucion::insertar($insertProducto, $tienda[0]->id, '1', $encargado[0]->id_area);
               
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

      public function actualizar_producto_foto(Request $dato)
    {
      $this->validate($dato,[
                'fotoP1' => 'required|mimes:jpeg,bmp,png,gif|dimensions:max_width=2500,max_height=2850',
          ]);
      //dd($dato->idProducto);
      $actualizar = foto_producto_institucion::actualizar_foto($dato);
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
          $nombre = producto_institucion::actualizar_nombre($dato);
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
          $desc = producto_institucion::actualizar_descripcion($dato);
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
          $cant = producto_institucion::actualizar_cantidad($dato);
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
    
}
