<?php

namespace App\Http\Controllers;

use App\User;
use App\carro;
use App\cliente;
use App\cuentaCobroInstitucion;
use App\cuentaCobroVendedor;
use App\detalle_carro;
use App\producto;
use App\venta_producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Khipu;

class KhipuController extends Controller
{

    //Esta funcion inicia el pago con Khipu, de esta manera iniciando la conexion con Khipu, entregando los precios, urls de retorno, cancelado y notificacion, los identificadores de la tiendas, para asi redireccionar al cliente a Khipu para que realize el pago
	public function crearPago(){


    $id_cliente = cliente::where('id_user', \Auth::user()->id)->first();

    $carro = carro::traerDatosCarro($id_cliente);


    $verificarEstadoProducto = detalle_carro::verificarEstadoProducto($carro[0]->idCarro);

    if($verificarEstadoProducto){
        
                        for ($i=0; $i < count($verificarEstadoProducto); $i++) { 


                                    $borrarDetalle[$i] = detalle_carro::where('id', $verificarEstadoProducto[$i]->idDetalle)
                                    ->delete();

                        }
    }


	$receiver_id = ENV('KHIPU_APP_ID');
    $secret = ENV('KHIPU_APP_KEY');
    $subject = 'Compra de Prueba';
    $body = 'Pruebas';

    $ventas = venta_producto::select('id')->latest()->first();

    if(!$ventas){

    $transaction_id = base64_encode(1);

    }else{

    $transaction_id = base64_encode($ventas->id+1);
    }

    $bank_id = '';
    $payer_email = \Auth::user()->email;


    $expires_date = time() + 60*10;

    $picture_url = '';
    $notify_url = 'https://exod.cl/api/notice';
    $return_url = 'https://exod.cl/carro/procesando';
    $cancel_url = 'https://exod.cl/carro/cancelado';
    $custom = '';



    for ($i=0; $i < count($carro); $i++) {  


            $updProd[$i] = producto::where('id',$carro[$i]->idProducto)->first();

            if($updProd[$i]->cantidad == 0){

                        return redirect()->back()->withErrors(['No hay stock disponible del producto '.$carro[$i]->nombreProducto.'.']);

            }else{

            $updProd[$i]->cantidad = $updProd[$i]->cantidad-$carro[$i]->cantidadProducto;

            $updProd[$i]->save();

                        $cobro[$i]  = cuentaCobroInstitucion::datosCuentaCobrador($carro[$i]->idProducto);
                        $total[$i] = $carro[$i]->cantidadProducto*$carro[$i]->precioProducto; 
                        $pagos[$i] = array(
                            "receiver_id" => $cobro[$i]->recieverID, 
                            "subject" => $carro[$i]->cantidadProducto.' '.$carro[$i]->nombreProducto,
                            "amount" => "$total[$i]",
                            "integrator_fee" => "10"
                        ); 

                        $update[$i] = detalle_carro::where('id_carro', $carro[$i]->idCarro)->where('id_producto', $carro[$i]->idProducto)->first();

                        $update[$i]->precio_actual = $carro[$i]->precioProducto;

                        $update[$i]->save();
            
            }

        

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
    

    if(array_has($url, 'error')){

        return redirect()->back()->withErrors(['Hubo un error con Khipu, por favor intenta mas tarde. Si el Problema persiste contactate con los Administradores.']);
    }


            $verificarUsuario = carro::where('id_cliente', $id_cliente->id)->where('id_estado', 1)->first();

                    

            $verificarUsuario->id_estado = 9;

            if($verificarUsuario->save()){

                $venta = venta_producto::venta($carro[0]->idCarro, array_sum($total));

                if($venta){

                    return redirect(array_get($url['multiple-payment'], 'url'));

                }
            }

            

    }


    //Esta funcion recibe la notificacion del pago desde Khipu para asi poder finalizar la venta, enviando de esta manera correos de verificacion al cliente y/o institucion
    public function notice(Request $request){
    
        $receiver_id = ENV('KHIPU_APP_ID');
        $secret = ENV('KHIPU_APP_KEY');
        $api_version = $request->api_version;  // Parámetro api_version
        $notification_token = $request->notification_token; //Parámetro notification_token

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

                    if ($response->getStatus() == 'done') {

                        $idTrans = base64_decode($response->getTransactionId());

                            $venta = venta_producto::datosCompra($idTrans);

                                if($response->getAmount() == $venta->total){

                                    $update = venta_producto::where('id', $venta->idVenta)->first();

                                    $update->id_estado = 3;

                                    $update->save();

                                    $carro = carro::where('id', $venta->idCarro)->first();

                                    $carro->id_estado = 10;
                                    $carro->save();

                                    $correo = $venta->correo;

                                        Mail::send(['html'=>'emails.comprobante'],['name','Alejandro'],function ($message) use ($correo)
                                        {
                                          $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
                                          $message->to($correo,'to');
                                        });

                                        
                                        $compra = venta_producto::productosVendidos($venta->idVenta);

                                            for ($i=0; $i < count($compra); $i++) { 

                                                $mail[$i] = $compra[$i]->correoInstitucion;

                                                $mails = $mail[$i];

                                                \Session::put('nombre', $compra[$i]->nombreTienda);
                                                \Session::put('producto', $compra[$i]->nombreProducto);
                                                \Session::put('cantidad', $compra[$i]->cantidadProducto);
                                                \Session::put('total', $compra[$i]->precioProducto*$compra[$i]->cantidadProducto);

                                            Mail::send(['html'=>'emails.productosVendidos'],['name','Alejandro'],function ($message) use ($mails)
                                            {
                                              $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
                                              $message->to($mails,'to');
                                            });

                                            $mails = '';
                                            
                                            }

                                }

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

    //Esta funcion verifica si la institucion a pagado la activacion de su cuenta de cobro
    public function verificarEstadoCuenta($idInstitucion){

            $institucion = cuentaCobroInstitucion::where('id_institucion', $idInstitucion)->first();


            $khipu_url = 'https://khipu.com/api/1.3/ReceiverStatus';

            $concatenated = "receiver_id=$institucion->receiver_id";

            $hash = hash_hmac('sha256', $concatenated , $institucion->secret_key);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $khipu_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, true);

            $data = array(
            'receiver_id' => $institucion->receiver_id,
            'hash' => $hash
            );

            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $output = curl_exec($ch);

            $info = curl_getinfo($ch);
            curl_close($ch);

            $url = json_decode($output,true);
       

            if($url['ready_to_collect'] == true){
                return true;
            }else{
                return false;
            }
    }


}
