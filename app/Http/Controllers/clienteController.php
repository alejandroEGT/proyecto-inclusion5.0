<?php

namespace App\Http\Controllers;
use App\Area;
use App\Fotoperfil;
use App\Http\Requests\clienteRequest;
use App\Institucion;
use App\Sexo;
use App\Tienda_institucion;
use App\User;
use App\cliente;
use App\foto_producto;
use App\producto;
use App\servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class clienteController extends Controller
{
    public function inicio_cliente(){

      $tiendas = Tienda_institucion::traerTiendas();
      //dd($tiendas);
      $ver_producto = producto::ver_producto();
     //dd($ver_producto);
      return view('inicioCliente.inicio_cliente')->with('ver_producto',$ver_producto)
                                                 ->with('tiendas',$tiendas);

    }

     public function vista_productos($id){

            
        $producto = producto::producto_id($id);
        return view('inicioCliente.vista_productos')->with('producto',$producto);
                                                 
    }  

    public function ver_mas_producto(){
      $ver_mas = producto::ver_mas_producto();
       $tiendas = Tienda_institucion::traerTiendas();
      return view ('inicioCliente.inicio_cliente_mas')->with('ver_mas',$ver_mas)
                                                      ->with('tiendas',$tiendas);
    }


    public function perfil_cliente(){


      $id_cliente = cliente::where('id_user', Auth::user()->id)->first();

      $foto = Fotoperfil::traerFotobyid(Auth::user()->id);

      return view('inicioCliente.perfil_cliente')->with('id_cliente',$id_cliente)
                                                 ->with('foto', $foto);

    }     


	public function sesion_cliente(){
    	return view('inicioCliente.sesion_cliente');
    }

    public function registro_cliente(){
    	
      $sexo = Sexo::all();
      

      return view('inicioCliente.registro_cliente')->with('sexo',$sexo);


    }

        public function prueba_cliente()
    {
     
        $ver_producto = producto::ver_producto();
        return view('inicioCliente.prueba')->with('ver_producto',$ver_producto);


    }

       public function guardar_cliente(Request $datos){

   		    $user = User::insertarCliente($datos,1);


            $idUser  = User::where('email', $datos->correo)->first();

           $cliente = cliente::guardarCliente($datos, $idUser);

            if($cliente){

              $foto = Fotoperfil::fotoDefault($idUser->id);

              \Session::flash('Advertencia', 'Registro exitosamente');
                  return redirect()->back();
              
            }else{
              \Session::flash('Advertencia', 'Lo sentimos, a ocurrido un error en el registro, intentelo nuevamente');
                  return redirect()->back();
                }
          }

              
              

  


    public function updCorreo (clienteRequest $datos){

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

    }

    public function updTelefono (Request $datos){

      $this->validate($datos,[
        'telefono' => 'required | numeric',
        'repetirTelefono' => 'required |  numeric| same:telefono'
     ]);
      $update = cliente::updTelefono($datos);

     if($update){
       \Session::flash('Advertencia', 'Tu numero de telefono ha sido actualizado exitosamente');
                  return redirect()->back();
     }else{
          \Session::flash('Advertencia', 'Lo sentimos no se pudo realizar la operación');
                  return redirect()->back();
     }

    }

    public function updClave (Request $datos){


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

    }


    public function filtrarProducto(Request $datos)
    {
      $this->validate($datos,[
                'buscador' => 'required',
          ]);
      $productos = producto::filtrar_desde_cliente($datos->buscador);

      return view('inicioCliente.nuestroProducto')
      ->with('productos', $productos)
      ->with('titulo', "Filtrado de productos");
    }


public function ver_detalleProducto(Request $dato)
    {

      $getId = base64_decode($dato->id);
      $productos = producto::detalleProducto_cliente($getId);

      return view('inicioCliente.verDetalleProducto')
      ->with('productos', $productos);
 }

     public function vista_perfilInst($idinstitucion){

        $idI = base64_decode($idinstitucion);
        $institucion = Institucion::find($idI);
        $productos = producto::verProductosVisibles($institucion->id, 5);
        $areas = Area::where('id_institucion', $idI)->get();
        $servicios = servicio::mostrarServicioDesdeAdmin($institucion->id, 5);

        return view('inicioCliente.perfil_institucion')
        ->with('institucion', $institucion)
        ->with('servicios', $servicios)
        ->with('productos', $productos)
        ->with('idInstitucion', $idinstitucion)
        ->with('areas', $areas);
    }
}
