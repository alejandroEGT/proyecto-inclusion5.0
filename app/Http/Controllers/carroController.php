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

		if(\Session::has('correcto')){
			\Session::get('correcto');
			return redirect()->back();
		}

		if($ingresar){
			\Session::flash('correcto', 'Producto Agregado Correctamente.');
             return redirect()->back();
		}else{
			\Session::flash('correcto', 'Algo ha ocurrido, Intente nuevamente.');
             return redirect()->back();
		}
		
	}

	public function delProducto($id){


		$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

		$carro = carro::where('id_cliente', $id_cliente->id)->first();

		$delete = detalle_carro::delProducto($id, $carro);

		return redirect()->back();
	}

	public function actProducto(Request $datos){

		$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

		$carro = carro::where('id_cliente', $id_cliente->id)->first();

		$update = detalle_carro::actProducto($datos, $carro);

		if(\Session::has('Advertencia')){
			\Session::get('Advertencia');
			return redirect()->back();
		}
		if($update){
			\Session::flash('Advertencia', 'Producto Actualizado correctamente.');
             return redirect()->back();
		}else{
			\Session::flash('Advertencia', 'Algo ha ocurrido, Intente nuevamente.');
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

