<?php

namespace App\Http\Controllers;

use App\User;
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
        $social = Socialite::driver($service)->user();

        $finduser = User::where('email', $social->email)->first();

        if ($finduser) {
            Auth::login($finduser);

            return "oka";
        }else{

        	/*
            $user = new User;

        $user->name = $social->name;
        $user->email = $social->email;
        $user->password = bcrypt($social->id.'_'.$social->name.'_'.$social->email);
        $user->save();
 
       Auth::login($user);

        return redirect('/home');

        */
        }

    }

    public function authCliente(Request $datos){

           $finduser = User::where('email', $datos->correo)->first();

           if($finduser && $finduser->id_rol == 4){

                Auth::login($finduser);

                return "oka";

           }else{

               return "caca1";

           }
    }

    public function logout(){
    	Auth::logout();
    }

}
