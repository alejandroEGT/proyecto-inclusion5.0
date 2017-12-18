<?php

namespace App\Http\Controllers;

use App\Tienda_institucion;
use App\carro;
use App\cliente;
use App\detalle_carro;
use App\producto;
use App\venta_producto;
use Illuminate\Http\Request;

class carroController extends Controller
{
   //Esta funcion ingresa un producto al carro de compras desde DetalleProducto
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

	//Esta funcion borra un producto desde el carro de compras
	public function delProducto($id){


		$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

		$carro = carro::where('id_cliente', $id_cliente->id)->where('id_estado', 1)->first();

		$delete = detalle_carro::delProducto($id, $carro);

		return redirect()->back();
	}

	//Esta funcion actualiza la cantidad de un producto desde el carro de compras
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

	   //Esta funcion redirecciona al carro de compras del cliente
       public function miCarro()
    {
    	try{
    		$tiendas = Tienda_institucion::traerTiendas();
	    	$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

	    	$carro = carro::traerDatosCarro($id_cliente);

	    	$total;
	    	for ($i=0; $i < count($carro); $i++) { 
	    		$total[$i] = $carro[$i]->cantidadProducto*$carro[$i]->precioProducto; 
	    	}

	   		return view('inicioCliente.carro_cliente')->with([
	   			'carro' => $carro,
	   			'total' => array_sum($total),
	   			'tiendas' => $tiendas,

	   		]);

	   	} catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back();
        } catch (\Exception $e) {
        		\Session::flash('Prueba', 'Prueba');
        		$tiendas = Tienda_institucion::traerTiendas();
                 return view('inicioCliente.carro_cliente')->with('tiendas',$tiendas);
        }  
	
    }
    //Esta funcion redirecciona al resumen de lo que se desea comprar para asi posteriormente proceder a la compra
    public function detalleCompra(){

    	try{
    		$tiendas = Tienda_institucion::traerTiendas();
	    	$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

	    	$carro = carro::traerDatosCarro($id_cliente);
	    	
	    	$total;
	    	for ($i=0; $i < count($carro); $i++) { 
	    		$total[$i] = $carro[$i]->cantidadProducto*$carro[$i]->precioProducto; 
	    	}
	    	//dd(array_sum($total));
	   		return view('inicioCliente.compra')->with([
	   			'carro' => $carro,
	   			'total' => array_sum($total),
	   			'tiendas' => $tiendas
	   		]);

        } catch (\Exception $e) {
        	return redirect()->back();
        }  
	
    }

    //Esta funcion redirecciona al carro de compras cuando el cliente cancela el pago desde Khipu
    public function cancelado(){

    	try{

    				$id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

   			 		$devolver = carro::devolverProducto($id_cliente);


			   		$carro = carro::where('id_cliente',$id_cliente->id)->where('id_estado',9)->first();

   			 		if(is_null($carro)){
					return redirect()->back();


   			 		}else{

   			 			for ($i=0; $i < count($devolver); $i++) { 

   			 			$updProd[$i] = producto::where('id',$devolver[$i]->idProducto)->first();
   			 			$updProd[$i]->cantidad = $devolver[$i]->stockProducto+$devolver[$i]->cantidadProducto;
            			$updProd[$i]->save();
   			 			    	     
   			 		}

			   			 $carro->id_estado = 1;

			   			 if($carro->save()){

			   			 	$venta = venta_producto::where('id_carro', $carro->id)->where('id_estado', 1)->first();

			   			 	$venta->id_estado = 4;

			   			 	if($venta->save()){

			   			 		   	$tiendas = Tienda_institucion::traerTiendas();
			    	 				return view('inicioCliente.cancelar_compra')->with('tiendas',$tiendas);
			   			 	}

			   			 }
   			 		}

   			 			


    	}catch(Exception $e){
    		return redirect()->back();
    	}
   			 	
     }
    //Esta funcion redirecciona a mis Compras una vez realizado el pago desde Khipu
    public function procesando(){
    	try{

    	     $id_cliente = cliente::where('id_user', \Auth::user()->id)->first();
   			 $carro = carro::where('id_cliente',$id_cliente->id)->where('id_estado',9)->latest()->first();

   			 if(is_null($carro)){

   			 		return redirect()->back();
   			 		
   			 }else{
   			 	$venta = venta_producto::where('id_carro', $carro->id)->where('id_estado', 1)->first();

   			 $venta->id_estado = 2;

   			 if($venta->save()){

		    	$tiendas = Tienda_institucion::traerTiendas();
		    	 return view('inicioCliente.aprobar_comprar')->with('tiendas',$tiendas);

    	}
   			 }

   			     	}catch(Exception $e){
    		return redirect()->back();
    	}
    }

    //Esta funcion cuenta los productos ingresados al carro para que de esta manera sean mostrados al cliente desde el menu
    public function cantidadProductosCarro($idUser){

    	try{
    		$id_cliente = cliente::where('id_user', $idUser)->first();

	    	$carro = carro::cantidadProductosCarro($id_cliente->id);

	    	if($carro){
	    		return count($carro);
	    	}else{
	    		return false;
	    	}

    	}catch(\Exception $e){
    		return redirect()->back();
    	}

    }

}