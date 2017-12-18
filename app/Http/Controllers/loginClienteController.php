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


  //Funciones que permitian la identificacion con facebook y google+

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
//Aqui terminan las funciones que permitian la identificacion con facebook y google+



    //Esta funcion identifica al cliente permitiendole de esta manera acceder a su cuenta
    public function authCliente(Request $data){
        //dd("jano");
           try{
                  
                  $verificar = User::where('email', $data->correo)->first();


                  if(count($verificar)>0 && $verificar->id_rol == 4){  /**"eres vendedor institucional"**/
                 
                      if (\Auth::attempt(['email' => $data->correo, 'password' => $data->pass])) {
              
                          return redirect('/inicio_cliente');    
                      }
                      return redirect()->back()->withErrors(['datos incorrectos, intente nuevamente']);
                  }
                  return redirect()->back();
            }catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withErrors(['Algo no anda bien, posiblemente datos mal ingresados o no hay conexión']);
       } 

    }

    //Esta funcion cierra la session del cliente
    public function logout(){
    	Auth::logout();
       return redirect('/inicio_cliente');
    }

}
