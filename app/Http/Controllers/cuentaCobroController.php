<?php

namespace App\Http\Controllers;

use App\cuentaCobroInstitucion;
use App\producto;
use Illuminate\Http\Request;
use Khipu;

class cuentaCobroController extends Controller
{
    public function crearCobro (Request $datos){

    $getId = base64_decode($datos->id);

    $cobro = cuentaCobroInstitucion::datosCuentaCobrador($getId);

    $configuration = new Khipu\Configuration();

    $configuration->setReceiverId($cobro->recieverID);
    $configuration->setSecret($cobro->secretKey);

    $client = new Khipu\ApiClient($configuration);
    $payments = new Khipu\Client\PaymentsApi($client);

    try {
    $opts = array(
        "transaction_id" => "MTI-100",
        "return_url" => "",
        "cancel_url" => "",
        "picture_url" => "",
        "notify_url" => "",
        "notify_api_version" => "1.3"
    );

    $response = $payments->paymentsPost($cobro->nombreProducto //Motivo de la compra
        , "CLP" //Moneda
        , $cobro->precio*$datos->cantidad //Monto
        , $opts //campos opcionales
        );


   return redirect($response->getPaymentUrl());
    
} catch (\Khipu\ApiException $e) {
    echo print_r($e->getResponseBody(), TRUE);
}

}

public function testo(Request $datos){
    dd($datos);
}

}