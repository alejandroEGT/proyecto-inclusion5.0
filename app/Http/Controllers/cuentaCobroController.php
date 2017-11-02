<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cuentaCobroController extends Controller
{
   public function crearIntegrador(){
    
	$recieverID = env('KHIPU_APP_ID');
    $recieverKey = env('KHIPU_APP_KEY');
    $configuration = new Khipu\Configuration();

    $configuration->setReceiverId($recieverID);
    $configuration->setSecret($recieverKey);
	$configuration->setPlatform('demo-client', '2.0');
	# $configuration->setDebug(true);

	$receivers = new Khipu\Client\ReceiversApi(new Khipu\ApiClient($configuration));

	try {
    	$response = $receivers->receiversPost('wololo'
        	, 'Pereira'
        	, 'pablo@micomercio.com'
        	, 'CL'
        	, '123456789'
       		, 'Varios'
        	, 'Mi comercio'
        	, '+565555555'
        	, 'Mi dirección'
        	, 'Mi ciudad'
        	, 'Mi región'
        	, 'Juan Perez'
        	, 'encargado de contacto'
        	,  'contacto@micomercio.com'
        	, '+566666666');

    		dd($response);

		} catch (\Khipu\ApiException $e) {
    			echo print_r($e->getResponseBody(), TRUE);
			}	
	}
}
