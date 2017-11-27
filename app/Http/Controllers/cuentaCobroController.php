<?php

namespace App\Http\Controllers;

use App\carro;
use App\cliente;
use App\cuentaCobroInstitucion;
use App\producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Khipu;

class cuentaCobroController extends Controller
{

public function index(){
    return view('index');
}


public function notice(Request $request){

    $receiver_id = ENV('KHIPU_APP_ID');
    $secret = ENV('KHIPU_APP_KEY');
    $api_version = $request->api_version;  // Parámetro api_version
    $notification_token = $request->notification_token; //Parámetro notification_token
    $amount = 100;

try {
    if ($api_version == '1.3') {
        $configuration = new Khipu\Configuration();
        $configuration->setSecret($secret);
        $configuration->setReceiverId($receiver_id);
        // $configuration->setDebug(true);

        $client = new Khipu\ApiClient($configuration);
        $payments = new Khipu\Client\PaymentsApi($client);

        $response = $payments->paymentsGet($notification_token);
        if ($response->getReceiverId() == $receiver_id ) {
            if ($response->getStatus() == 'done' && $response->getAmount() == $amount) {

                $correo = "bmontecino.96@gmail.com";
 
                                        Mail::send(['html'=>'emails.test'],['name','Prueba'],function ($message) use ($correo)
                                        {
                                          $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
                                          $message->to($correo,'to');
                    });
            }
        } else {
            // receiver_id no coincide
        }
    } else {
        // Usar versión anterior de la API de notificación
    }
} catch (\Khipu\ApiException $exception) {
    print_r($exception->getResponseObject());
}
}


public function send(Request $request){

    $receiver_id = ENV('KHIPU_APP_ID');
    $secret = ENV('KHIPU_APP_KEY');

    $configuration = new Khipu\Configuration();
    $configuration->setReceiverId($receiver_id);
    $configuration->setSecret($secret);
// $configuration->setDebug(true);

$client = new Khipu\ApiClient($configuration);
$payments = new Khipu\Client\PaymentsApi($client);


try {
    $opts = array(
        "body" => "testo",
        "bank_id" => $request->bank_id,
        "payer_email" => $request->email,
        "return_url" => 'https://exod.cl/return',
        "notify_url" => 'https://exod.cl/api/notice',
        "notify_api_version" => "1.3"
    );
    $response = $payments->paymentsPost("testo2" //Motivo de la compra
        , "CLP" //Moneda
        , 100.0 //Monto
        , $opts );

    dd($response);
} catch (\Khipu\ApiException $e) {
    echo print_r($e->getResponseBody(), TRUE);
}
}

public function return(){
    return view('return');
}

    
public function testo(Request $token){


    $id_cliente = cliente::where('id_user', \Auth::user()->id)->first();
    $carro = carro::traerDatosCarro($id_cliente);

    $receiver_id = ENV('KHIPU_APP_ID');
    $secret = ENV('KHIPU_APP_KEY');
    $subject = 'Compra de Prueba';
    $body = 'Pruebas';
    $transaction_id = 'pruebas';
    $bank_id = '';
    $payer_email = \Auth::user()->email;
    $expires_date = ''; //treinta dias a partir de ahora
    $picture_url = '';
    $notify_url = '';
    $return_url = 'https://exod.cl/carro/aceptado';
    $cancel_url = 'https://exod.cl/carro/cancelado';
    $custom = '';

    for ($i=0; $i < count($carro); $i++) { 
            $cobro[$i]  = cuentaCobroInstitucion::datosCuentaCobrador($carro[$i]->idProducto);
            $total[$i] = $carro[$i]->cantidadProducto*$carro[$i]->precioProducto; 
            $pagos[$i] = array(
                "receiver_id" => $cobro[$i]->recieverID, 
                "subject" => $carro[$i]->cantidadProducto.' '.$carro[$i]->nombreProducto,
                "amount" => "$total[$i]",
                "integrator_fee" => "10"
            );  
    }

    $payments = json_encode($pagos);

    $khipu_url = 'https://khipu.com/integratorApi/1.3/createMultiplePaymentURL';

    // creamos el hash
    $concatenated = "receiver_id=$receiver_id&subject=$subject&body=$body&payments=$payments&payer_email=$payer_email&bank_id=$bank_id&expires_date=$expires_date&transaction_id=$transaction_id&custom=$custom&notify_url=$notify_url&return_url=$return_url&cancel_url=$cancel_url&picture_url=$picture_url";

    $hash = hash_hmac('sha256', $concatenated , $secret);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $khipu_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, true);

    $data = array(
        'receiver_id' => $receiver_id,
        'subject' => $subject,
        'body' => $body,
        'transaction_id' => $transaction_id,
        'bank_id' => $bank_id,
        'payer_email' => $payer_email,
        'expires_date' => $expires_date,
        'payments' => $payments,
        'picture_url' => $picture_url,
        'notify_url' => $notify_url,
        'return_url' => $return_url,
        'cancel_url' => $cancel_url,
        'custom' => $custom,
        'hash' => $hash
    );

    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $output = curl_exec($ch);

    $info = curl_getinfo($ch);
    curl_close($ch);

    $url = json_decode($output,true);

    return redirect(array_get($url['multiple-payment'], 'url'));

    }


    public function testo2(){


        $receiver_id = ENV('KHIPU_APP_ID');
    $secret = ENV('KHIPU_APP_KEY');
    $api_version = $_REQUEST['api_version'];  // Parámetro api_version
    $notification_token = $_REQUEST['notification_token']; //Parámetro notification_token
    $amount = 100;

try {
    if ($api_version == '1.3') {
        $configuration = new Khipu\Configuration();
        $configuration->setSecret($secret);
        $configuration->setReceiverId($receiver_id);
        // $configuration->setDebug(true);

        $client = new Khipu\ApiClient($configuration);
        $payments = new Khipu\Client\PaymentsApi($client);

        $response = $payments->paymentsGet($notification_token);
        if ($response->getReceiverId() == RECEIVER_ID) {
            if ($response->getStatus() == 'done' && $response->getAmount() == $amount) {
                $headers = 'From: "Comercio de prueba" <no-responder@khipu.com>' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $subject = 'La compra de prueba funciona';
                $body = <<<EOF
Hola<br/>
<br/>
<p>
Recibes este correo pues el pago de prueba fue conciliado por khipu
</p>

EOF;
                mail($response->getPayerEmail(), $subject, $body, $headers);
            }
        } else {
            // receiver_id no coincide
        }
    } else {
        // Usar versión anterior de la API de notificación
    }
} catch (\Khipu\ApiException $exception) {
    print_r($exception->getResponseObject());
}
    }


}

