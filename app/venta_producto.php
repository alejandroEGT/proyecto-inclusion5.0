<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class venta_producto extends Model
{
     protected $table = 'venta-producto';

     protected function venta($carro, $total){
          try{

     	     $venta = new venta_producto;
               $now = new \DateTime();

     	     $venta->id_carro = $carro;
     	     $venta->fecha = $now->format('Y-m-d H:i:s');
               $venta->id_pago = 1;
               $venta->total = $total;
               $venta->id_estado = 1;

			if($venta->save()){
					return true;
			}else{
					return false;
			}

          } catch (\Illuminate\Database\QueryException $e){
                    return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
               }

     }

     protected function datosCompra($idCompra){

          $compra = \DB::table('venta-producto')
                    ->select([
                        'venta-producto.id as idVenta',
                        'venta-producto.total as total',
                        'venta-producto.id_carro as idCarro',
                        'users.email as correo'
                    ])
                    ->join('carros','carros.id','=','venta-producto.id_carro')
                    ->join('clientes','clientes.id','=','carros.id_cliente')
                    ->join('users','users.id','=','clientes.id_user')
                    ->where('venta-producto.id', $idCompra)
                    ->where('carros.id_estado',9)
                    ->first();

          return $compra;

     }





}
