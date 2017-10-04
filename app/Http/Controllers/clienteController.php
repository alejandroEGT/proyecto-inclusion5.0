<?php

namespace App\Http\Controllers;
use App\Sexo;
use App\Tienda_institucion;
use App\User;
use App\cliente;
use App\foto_producto_institucion;
use App\producto_institucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class clienteController extends Controller
{
    public function inicio_cliente(){

      $tiendas = Tienda_institucion::all();
      $productos = \DB::select('SELECT * from fProducto');
      //una consulta que traiga los productos con la foto

    	return view('inicioCliente.inicio_cliente')->with('productos',$productos)
                                                 ->with('tiendas',$tiendas);
      

                
      
    }

     public function vista_productos($id){

        $productos = \DB::select('SELECT * from fProducto');



        return view('inicioCliente.vista_productos')->with('productos',$productos);
                                                  
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
   		return view('inicioCliente.prueba');
    }

       public function guardar_cliente(Request $datos){

   		    $user = User::insertarCliente($datos);

          if($user){

            $idUser  = User::where('email', $datos->correo)->first();

           $cliente = cliente::guardarCliente($datos, $idUser);

            if($cliente){
              return "oka";
              
            }else{
              return "caca2";
            }
          }else{
            return "caca1";
          }
    }



    
}
