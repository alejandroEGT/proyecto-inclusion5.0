<?php

namespace App\Http\Controllers;

use App\Sexo;
use App\User;
use App\cliente;
use App\producto_institucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class clienteController extends Controller
{
    public function inicio_cliente(){

      $productos =  producto_institucion::all();
    	return view('inicioCliente.inicio_cliente')->with('productos',$productos);

      
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
