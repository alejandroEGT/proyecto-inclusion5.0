<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class venta_producto extends Model
{
     protected $table = 'venta-producto';

     protected function venta($carro){

     	     $venta = new venta_producto;

     	     $venta->id_carro = $carro;
     	     $venta->fecha = "caca";

			if($venta->save()){
					return true;
			}else{
					return false;
			}

     }





}
