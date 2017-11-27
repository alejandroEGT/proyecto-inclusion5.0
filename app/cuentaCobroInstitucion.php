<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Khipu;

class cuentaCobroInstitucion extends Model
{
    protected function crearCuenta($datos, $idInsti){

    	$recieverID = env('KHIPU_APP_ID');
    	$recieverKey = env('KHIPU_APP_KEY');
    	$configuration = new Khipu\Configuration();

    	$configuration->setReceiverId($recieverID);
    	$configuration->setSecret($recieverKey);
		$configuration->setPlatform('demo-client', '2.0');
		# $configuration->setDebug(true);

	$receivers = new Khipu\Client\ReceiversApi(new Khipu\ApiClient($configuration));

		try {
    	$response = $receivers->receiversPost(
    		  $datos->nombre
        	, $datos->nombre
        	, $datos->correo
        	, 'CL'
        	, $datos->rut
       		, $datos->razonSocial
        	, $datos->nombre
        	, $datos->telefono1
        	, $datos->direccion
        	, $datos->direccion
        	, $datos->direccion
        	, $datos->nombre
        	, 'Institucion'
        	,  $datos->correo
        	,  $datos->telefono2
        );

    		$insertar = new cuentaCobroInstitucion;

    		$insertar->id_institucion = $idInsti;
    		$insertar->receiver_id = $response['receiver_id'];
    		$insertar->secret_key = $response['secret'];

    		if($insertar->save()){
    			return true;
    		}else{
    			return false;
    		}

		} catch (\Khipu\ApiException $e) {
    			echo print_r($e->getResponseBody(), TRUE);
			}	
    }

    protected function datosCuentaCobrador($idProducto){
        $cuenta = \DB::table('cuenta_cobro_institucions')
                    ->select([
                        'cuenta_cobro_institucions.receiver_id as recieverID',
                    ])
                    ->join('institucion','institucion.id','=','cuenta_cobro_institucions.id_institucion')
                    ->join('tiendas_instituciones','tiendas_instituciones.id_institucion','=','institucion.id')
                    ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_tienda','=','tiendas_instituciones.id')
                    ->join('productos','productos.id','=','tienda_producto_instituciones.id_producto')
                    ->where('productos.id', $idProducto)
                    ->first();
        return $cuenta;
    }
}
