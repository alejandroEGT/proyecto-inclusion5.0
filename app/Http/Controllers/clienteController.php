<?php

namespace App\Http\Controllers;
use App\Fotoperfil;
use App\Http\Requests\clienteRequest;
use App\Sexo;
use App\Tienda_institucion;
use App\User;
use App\cliente;
use App\producto;
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

       public function carro_cliente()
    {
   		return view('inicioCliente.carro_cliente');
    }


        public function prueba_cliente()
    {
     
        $ver_producto = producto::ver_producto();
        return view('inicioCliente.prueba')->with('ver_producto',$ver_producto);


    }

       public function guardar_cliente(Request $datos){

   		    $user = User::insertarCliente($datos,1);

          if($user){

            $idUser  = User::where('email', $datos->correo)->first();

           $cliente = cliente::guardarCliente($datos, $idUser);

            if($cliente){

              $foto = Fotoperfil::fotoDefault($idUser->id);

              return "oka";
              
            }else{
              return "caca2";
            }
          }else{
            return "caca1";
          }
    }

    public function updCorreo (Request $datos){

     $update = cliente::updCorreo($datos);

     if($update){
      return "oka";
     }else{
      return "caca";
     }

    }

    public function updTelefono (Request $datos){

     $update = cliente::updTelefono($datos);

     if($update){
      return "oka";
     }else{
      return "caca";
     }

    }

    public function updClave (Request $datos){

     $update = cliente::updClave($datos);

     if($update){
      return "oka";
     }else{
      return "caca";
     }

    }

    
}
