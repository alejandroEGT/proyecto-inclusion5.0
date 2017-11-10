<?php

namespace App\Http\Controllers;
use App\Area;
use App\ContadorInstitucion;
use App\Fotoperfil;
use App\Http\Requests\clienteRequest;
use App\Institucion;
use App\Sexo;
use App\Tienda_institucion;
use App\Tienda_vendedor;
use App\User;
use App\carro;
use App\cliente;
use App\foto_producto;
use App\producto;
use App\servicio;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class clienteController extends Controller
{

    public function verificarUser(){

        if(Auth::user() && Auth::user()->id_rol!=4){
            Auth::logout();
        }
    }

    public function inicio_cliente(){

      $tiendas = Tienda_institucion::traerTiendas();
      $tiendas_vendedor = Tienda_vendedor::traerTiendas();
      //dd($tiendas);
      $ver_producto = producto::ver_producto();
     //dd($ver_producto);

      $this->verificarUser();
      return view('inicioCliente.inicio_cliente')->with('ver_producto',$ver_producto)
                                                 ->with('tiendas_vendedor',$tiendas_vendedor)
                                                 ->with('tiendas',$tiendas);

    }

     public function vista_productos($id){

          $this->verificarUser();  
        $producto = producto::producto_id($id);
        return view('inicioCliente.vista_productos')->with('producto',$producto);
                                                 
    }  

    public function ver_mas_producto(){
      $this->verificarUser();
      $ver_mas = producto::ver_mas_producto();
       $tiendas = Tienda_institucion::traerTiendas();
       $tiendas_vendedor = Tienda_vendedor::traerTiendas();
      return view ('inicioCliente.inicio_cliente_mas')->with('ver_mas',$ver_mas)
                                                      ->with('tiendas_vendedor',$tiendas_vendedor)
                                                      ->with('tiendas',$tiendas);
    }


    public function perfil_cliente(){


      $id_cliente = cliente::where('id_user', Auth::user()->id)->first();

      $foto = Fotoperfil::traerFotobyid(Auth::user()->id);

      return view('inicioCliente.perfil_cliente')->with('id_cliente',$id_cliente)
                                                 ->with('foto', $foto);

    }     


	public function sesion_cliente(){
    $this->verificarUser();
    	return view('inicioCliente.sesion_cliente');
    }

    public function registro_cliente(){
      $this->verificarUser();
    	
      $sexo = Sexo::all();
      

      return view('inicioCliente.registro_cliente')->with('sexo',$sexo);


    }

        public function prueba_cliente()
    {
      $this->verificarUser();
     
        $ver_producto = producto::ver_producto();
        return view('inicioCliente.prueba')->with('ver_producto',$ver_producto);


    }

       public function guardar_cliente(Request $datos){

      try{
   		  $user = User::insertarCliente($datos,1);
        $idUser  = User::where('email', $datos->correo)->first();
        $cliente = cliente::guardarCliente($datos, $idUser);
          if($cliente){
              $foto = Fotoperfil::fotoDefault($idUser->id);
              $carro = carro::crearCarro($idUser);

            \Session::flash('Advertencia', 'Registro exitosamente');
             return redirect()->back();

          }else{
            \Session::flash('Advertencia', 'Lo sentimos, a ocurrido un error en el registro, intentelo nuevamente');
             return redirect()->back();
                }

      } catch (\Illuminate\Database\QueryException $e){
      return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }
          }

              
              

  


    public function updCorreo (clienteRequest $datos){

      try{
        $cliente = cliente::where('id_user', \Auth::user()->id)->first();

        if($cliente->facebook_id != null){
          \Session::flash('Advertencia', 'tu correo electronico no puede ser actualizado porque iniciaste la sesion con redes sociales');
                    return redirect()->back();
        }

       $update = cliente::updCorreo($datos);

       if($update){
         \Session::flash('Advertencia', 'Tu correo ha sido actualizado exitosamente');
                    return redirect()->back();
       }else{
         \Session::flash('Advertencia', 'Lo sentimos no se pudo realizar la operación');
                    return redirect()->back();
       }
     } catch (\Illuminate\Database\QueryException $e){
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }

    }

    public function updTelefono (Request $datos){

    try{
        $this->validate($datos,[
          'telefono' => 'required | numeric | min:9',
          'repetirTelefono' => 'required |  numeric | min:9 | same:telefono'
       ]);
        $update = cliente::updTelefono($datos);

       if($update){
         \Session::flash('Advertencia', 'Tu numero de telefono ha sido actualizado exitosamente');
                    return redirect()->back();
       }else{
            \Session::flash('Advertencia', 'Lo sentimos no se pudo realizar la operación');
                    return redirect()->back();
       }
     } catch (\Illuminate\Database\QueryException $e){
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }

    }

    public function updClave (Request $datos){

    try{
        $cliente = cliente::where('id_user', \Auth::user()->id)->first();
      
        if($cliente->facebook_id != null){
          \Session::flash('Advertencia', 'tu contraseña no puede ser actualizado porque iniciaste la sesion con redes sociales');
           return redirect()->back();
        }
     
       $this->validate($datos,[
          'passAntigua' => 'required | min:6 | max:50 ',
          'passNueva' => 'required | min:6 | max:50',
          'repPassNueva' => 'required | min:6 | max:50 | same:passNueva'
       ]);

       $update = cliente::updClave($datos);

        if($update){
         \Session::flash('Advertencia', 'Tu numero de telefono ha sido actualizado exitosamente');
          return redirect()->back();
       }
          return redirect()->back()->withErrors(['No es posible actualizar tu contraseña']);

    } catch (\Illuminate\Database\QueryException $e){
          return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
          }

    }


    public function filtrarProducto(Request $datos){

    try{
      $this->verificarUser();
      $this->validate($datos,[
                'buscador' => 'required',
          ]);
      $productos = producto::filtrar_desde_cliente($datos->buscador);


      return view('inicioCliente.nuestroProducto')
      ->with('productos', $productos)
      ->with('titulo', "Filtrado de productos");

    } catch (\Illuminate\Database\QueryException $e){
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }
    }



public function ver_detalleProducto(Request $dato)
    {
      $this->verificarUser();
      $getId = base64_decode($dato->id);
      $productos = producto::detalleProducto_cliente($getId);
      $tiendas = Tienda_institucion::traerTiendas();
      $ver_producto = producto::ver_productos_tienda();


      return view('inicioCliente.verDetalleProducto')
      ->with('ver_producto',$ver_producto)
      ->with('tiendas',$tiendas)
      ->with('productos', $productos);
 }

     public function vista_perfilInst(request $dato){


        try{
           //////////////////aqui un contador de visitas ////////////////
            
            //dd($dato->ip());
            //prueba de contador de visitas ////
            //dd($dato->cookies);
            //dd(request()->cookie('laravel_session'));
              $idI = base64_decode($dato->idinstitucion);
              $tienda_institucion = Tienda_institucion::where('id_institucion', $idI)->first();
              $contadorTiendaInst = new ContadorInstitucion;

              $contadorTienda = ContadorInstitucion::where('id_tienda', $tienda_institucion->id)
                                ->where('laravel_session', $dato->ip())->first();
                     
              

              if($contadorTienda == true){ /*El usuario si ha visitado el perfil*/


                if(date('d-m-Y')  !=  date('d-m-Y', strtotime($contadorTienda->updated_at) )){

          

                    $contadorTienda->cantidad++;
                    $contadorTienda->save();

                  }

            
              }else{
              /*o si no*/   
              
                $contadorTiendaInst->id_tienda = $tienda_institucion->id;
                $contadorTiendaInst->laravel_session = $dato->ip(); 
                $contadorTiendaInst->cantidad++;
                $contadorTiendaInst->save();
              }

            ////////fin de prueba //////////////

              $idI = base64_decode($dato->idinstitucion);
              $institucion = Institucion::find($idI);
              $productos = producto::verProductosVisibles($institucion->id, 5);
              $areas = Area::where('id_institucion', $idI)->get();
              $servicios = servicio::mostrarServicioDesdeAdmin($institucion->id, 5);

              return view('inicioCliente.perfil_institucion')
              ->with('institucion', $institucion)
              ->with('servicios', $servicios)
              ->with('productos', $productos)
              ->with('idInstitucion', $dato->idinstitucion)
              ->with('areas', $areas);
         } catch (\Illuminate\Database\QueryException $e){
            return redirect()->back();
          }
    
    }

    public function updFoto(Request $dato)
    {


       $this->validate($dato,[
                    'foto' => 'required|mimes:jpeg,bmp,png,gif|dimensions:max_width=5500,max_height=5500',
              ]);

      $update= Fotoperfil::actualizar_foto($dato);

      if($update > 0){
        \Session::flash('Advertencia', 'Tu foto de perfil ha sido actualizado exitosamente');
                  return redirect()->back();
      }
      return redirect()->back()->withErrors(['No es posible actualizar tu foto de perfil']);
    }
}
