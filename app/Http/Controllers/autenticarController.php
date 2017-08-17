<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\VendedorInstitucion;
use App\Vendedor;
use App\User;
use App\Http\Requests\userloginRequest;
class autenticarController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
   

    /*Logear una institucion */////////////////////////////////////////////////////////////////////////////////////
  
	public function vista_login()
	{
		return view('invitado.login_institucion');
	}

    public function login(Request $data)/* Logear una institución */
    {
        
    	if (\Auth::guard('institucion')->attempt(['email' => $data->correo, 'password' => $data->clave])) {
           return redirect('/institucion/index');
        }
        return redirect()->back();
    }

    public function logout(){
        \Auth::guard('institucion')->logout();
        return redirect('/inicio');
    }
    /*****************************************************************************************************************


    /**Logear un Vendedor institucionql**/////////////////////////////////////////////////////////////

    public function vista_loginVenInst(){

        return view('invitado.login_vendedorInstitucional');
    }
    
    public function login_vendedorInst(userloginRequest $data){
        
            $verificar = \DB::select("select * from users where email = '".$data->correo."'");

            if(count($verificar)>0 && $verificar[0]->id_rol == 2){  /**"eres vendedor institucional"**/

               
                if (\Auth::attempt(['email' => $data->correo, 'password' => $data->clave])) {
                    // Authentication passed...
                    return redirect('/userDependiente/index');
                
                }
                return redirect()->back();
            }

            return redirect()->back();
        }
        //return redirect()->back();
    
    public function logout_venIns(){
            \Auth::logout();
            return redirect('/inicio');
    }

 /**************************************************************************************************************** */ 

 /**Logear un Vendedor **/////////////////////////////////////////////////////////////
     public function vista_loginVendedor()
     {
            return view('invitado.login_vendedor');
     }
     public function login_vendedor(userloginRequest $data){
            $verificar = \DB::select("select * from users where email = '".$data->correo."'");

             if (count($verificar)>0 && $verificar[0]->id_rol == 1) { /**"eres vendedor individual"**/

                if (\Auth::attempt(['email' => $data->correo, 'password' => $data->clave])) {
                    // Authentication passed...
                    return redirect('/userIndependiente/index');
                
                }
                return redirect()->back();
                
            }
            return redirect()->back();
     }

}
