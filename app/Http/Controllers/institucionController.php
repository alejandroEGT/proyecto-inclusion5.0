<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;
use App\Institucion;
use App\Area;
use App\Vendedor;
class institucionController extends Controller
{
    
    public function vista_institucion(){

         
        //if (\Auth::guard('institucion')->check()) {
            return view('institucion.inicio');
       // }
       // return redirect('/inicio');
    }
    public function vista_agregarAE(){
            return view('institucion.agregar_area_especialidad');
    }

    public function vista_notificacio_vendedor(){

            $usuariosEsperando = Institucion::usuariosEsperando();
           // return($usuariosEsperando);
            return view('institucion.notificaciones_vendedor')->with('userEsperando', $usuariosEsperando);

    }
     public function send()
    {
         Mail::send(['text'=>'emails.mail'],['name','janin'],function ($message)
        {

            $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido nigga"');

            $message->to("$correo",'to jano');

        });

    }

    /*Peticiones en ajax mediante vue y vue-resource*/

    public function traerDatosInstitucion(){

    	$instituto = Institucion::where('id','=',\Auth::guard("institucion")->user()->id)->get();
    	return $instituto;
    	
    }
    public function insertarArea(Request $data){
        
        $area = Area::insertar($data);
        return $area;

    }
    public function traerAreas(){

        return Area::traer();
    }
    public function aceptarSolicitudUsuario(Request $data){
        
        $aceptarUser = Vendedor::aceptarusuario($data[0]);
        $user = User::find($data[0]);
        
             \Session::put('user',$user->nombres.' '.$user->apellidos);
        
       
        if($aceptarUser == 1){
                
                 Mail::send(['text'=>'emails.mail'],['name','janin'],function ($message) use ($user)
                {

                    $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido nigga"');

                    $message->to($user['email'],'to jano');

                });



          return "ok";
        }
        return "error";
    }
    public function traerNotificaciones(){

       $notificar = Institucion::notificaciones();

          foreach ($notificar as $not) {
             return $not->notificar;
          }
    }
}
