<?php

namespace App\Http\Controllers;

use App\carro;
use App\cliente;
use App\detalle_carro;
use App\producto;
use Illuminate\Http\Request;

class carroController extends Controller
{
   
	public function ingProducto(Request $datos, $id){

		$producto = producto::producto_id($id);

 		$producto->idProducto;

		$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

		$carro = carro::where('id_cliente', $id_cliente->id)->first();

		$ingresar = detalle_carro::ingProducto($datos, $carro, $producto);

		if($ingresar){
			return redirect('/inicio_cliente');
		}
		
	}

       public function miCarro()
    {


    	
   		return view('inicioCliente.carro_cliente');
    }
}
