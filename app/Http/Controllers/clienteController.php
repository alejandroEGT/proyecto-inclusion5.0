<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class clienteController extends Controller
{
    public function inicio_cliente(){
    	return view('inicioCliente.inicio_cliente');
    }

	public function sesion_cliente(){
    	return view('inicioCliente.sesion_cliente');
    }

    public function registro_cliente(){
    	return view('inicioCliente.registro_cliente');
    }

       public function carro_cliente()
    {
   		return view('inicioCliente.carro_cliente');
    }

        public function prueba_cliente()
    {
   		return view('inicioCliente.prueba');
    }

       public function guardar_cliente()
    {
   		
    }

        public function iniciar_cliente()
    {
   		
    }
}
