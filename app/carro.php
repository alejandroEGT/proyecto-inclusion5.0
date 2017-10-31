<?php

namespace App;

use App\cliente;
use Illuminate\Database\Eloquent\Model;

class carro extends Model
{
   protected function crearCarro ($idUser){

		$carro = new carro;

	    $finduser = cliente::where('id_user', $idUser->id)->first();

		$carro->id_cliente = $finduser->id;
		$carro->id_estado = 1;

		if($carro->save()){
			return true;
		}else{
			return false;
		}

	}

	protected function traerCarro(){
		
	}
}
