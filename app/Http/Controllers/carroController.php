<?php

namespace App\Http\Controllers;

use App\carro;
use App\cliente;
use App\detalle_carro;
use App\producto;
use Illuminate\Http\Request;

class carroController extends Controller
{
   
	public function ingProducto(Request $datos){

		$getId = base64_decode($datos->id);

		$producto = producto::producto_id($getId);

		$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

		$carro = carro::where('id_cliente', $id_cliente->id)->first();

		$ingresar = detalle_carro::ingProducto($datos, $carro, $producto);

		if($ingresar){
			return redirect()->back();
		}
		
	}



       public function miCarro()
    {

    	$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

    	$carro = carro::traerDatosCarro($id_cliente);

   		return view('inicioCliente.carro_cliente')->with('carro',$carro);
    }
}

