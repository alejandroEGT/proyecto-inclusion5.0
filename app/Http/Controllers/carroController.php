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

		$getId = base64_decode($datos->id);/*id del producto*/

		$producto = producto::producto_id($getId);
		$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

		$agrega_carro = carro::crearCarro($id_cliente->id);
		if ($agrega_carro >0 ) {
			
			$ingresar_producto = detalle_carro::ingProducto($datos, $agrega_carro, $producto);

		}

		if(\Session::has('correcto')){
			\Session::get('correcto');
			return redirect()->back();
		}

		if($ingresar_producto){
			\Session::flash('correcto', 'Producto Agregado Correctamente.');
             return redirect()->back();
		}else{
			\Session::flash('correcto', 'Algo ha ocurrido, Intente nuevamente.');
             return redirect()->back();
		}
		/*$getId = base64_decode($datos->id);

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
		}*/
		
	}

	public function delProducto($id){


		$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

		$carro = carro::where('id_cliente', $id_cliente->id)->where('id_estado', 1)->first();

		$delete = detalle_carro::delProducto($id, $carro);

		return redirect()->back();
	}

	public function actProducto(Request $datos){

		$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

		$carro = carro::where('id_cliente', $id_cliente->id)->where('id_estado', 1)->first();
		
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
    	try{
	    	$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

	    	$carro = carro::traerDatosCarro($id_cliente);
	    	
	    	$total;
	    	for ($i=0; $i < count($carro); $i++) { 
	    		$total[$i] = $carro[$i]->cantidadProducto*$carro[$i]->precioProducto; 
	    	}
	    	//dd(array_sum($total));
	   		return view('inicioCliente.carro_cliente')->with([
	   			'carro' => $carro,
	   			'total' => array_sum($total)
	   		]);

	   	} catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back();
          }
	
    }

    public function detalleCompra(){

    	try{
	    	$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

	    	$carro = carro::traerDatosCarro($id_cliente);
	    	
	    	$total;
	    	for ($i=0; $i < count($carro); $i++) { 
	    		$total[$i] = $carro[$i]->cantidadProducto*$carro[$i]->precioProducto; 
	    	}
	    	//dd(array_sum($total));
	   		return view('inicioCliente.compra')->with([
	   			'carro' => $carro,
	   			'total' => array_sum($total)
	   		]);

	   	} catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back();
          }
	
    }


    public function cancelado(){

    	
    	 return view('inicioCliente.cancelar_compra');
    }
}

