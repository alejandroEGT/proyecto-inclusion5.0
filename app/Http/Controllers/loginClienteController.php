<?php

namespace App\Http\Controllers;
use App\Fotoperfil;
use App\User;
use App\carro;
use App\cliente;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class loginClienteController extends Controller
{

private $tipo;

public function setTipo($tipo) {
       $this->tipo = $tipo;
  }

  public function getTipo() {
      return $this->tipo;
  }

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
                    'picture',
                ]);
          $this->setTipo(2);

        }else{

          $social = Socialite::driver($service);
          $this->setTipo(3);
        }

        $userSocial = $social->user();
        

        $finduser = User::where('email', $userSocial->email)->first();

        if ($finduser) {
            Auth::login($finduser);
            return redirect('/inicio_cliente');

        }else{

             $user = User::insertarCliente($userSocial , $this->getTipo());

        	 if($user){

            $idUser  = User::where('email', $userSocial->email)->first();

            $cliente = cliente::guardarCliente($userSocial, $idUser);

            if($cliente){

              $foto = Fotoperfil::fotoSocial($userSocial ,$idUser->id);

              $finduser = User::where('email', $userSocial->email)->first();

              $carro = carro::crearCarro($finduser);

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
