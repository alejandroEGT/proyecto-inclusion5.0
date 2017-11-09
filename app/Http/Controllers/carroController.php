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

	public function delProducto($id){

		$getId = base64_decode($id);

		$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

		$carro = carro::where('id_cliente', $id_cliente->id)->first();

		$delete = detalle_carro::delProducto($getId, $carro);

		if($delete){
			return redirect()->back();
		}
	}

	public function actProducto(Request $datos){

		$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

		$carro = carro::where('id_cliente', $id_cliente->id)->first();

		$update = detalle_carro::actProducto($datos, $carro);

		if($update){
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

