<?php

namespace App\Http\Controllers;

use App\User;
use App\cliente;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class loginClienteController extends Controller
{


    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function handleProviderCallback($service)
    {

        if($service == "facebook"){

          $social = Socialite::driver($service)->fields([
                    'id',
                    'first_name', 
                    'last_name', 
                    'email', 
                    'gender', 
                ]);
        }else{

          $social = Socialite::driver($service);

        }

        $userSocial = $social->user();

        $finduser = User::where('email', $userSocial->email)->first();

        if ($finduser) {
            Auth::login($finduser);
            return redirect('/inicio_cliente');

        }else{

             $user = User::insertarCliente($userSocial , 1);

             dd($user);

        	 if($user){

            $idUser  = User::where('email', $userSocial->email)->first();

            $cliente = cliente::guardarCliente($userSocial, $idUser);

            if($cliente){

              $finduser = User::where('email', $userSocial->email)->first();

              Auth::login($finduser);
              return redirect('/inicio_cliente');
              
            }else{
              return "NO User Encontrado";
            }
          }else{
            return "NO Cliente Encontrado";
          }
        }

    }

    public function authCliente(Request $datos){

           $finduser = User::where('email', $datos->correo)->first();

           if($finduser && $finduser->id_rol == 4){

                Auth::login($finduser);

                return redirect('/inicio_cliente');

           }else{

               return "NO User Encontrado";

           }
    }

    public function logout(){
    	Auth::logout();
       return redirect('/inicio_cliente');
    }

}
