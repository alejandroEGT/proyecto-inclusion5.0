<?php
/*
 En este controlador se encuentras las funciones de autentificación de los usuarios del sistema desde la parte administrativa
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\VendedorInstitucion;
use App\Vendedor;
use App\User;
use App\Http\Requests\userloginRequest;
use App\Http\Requests\encargadoRequest;
class autenticarController extends Controller
{

    
    protected $redirectTo = '/home';
    /*Logear una institucion */////////////////////////////////////////////////////////////////////////////////////
  
	public function vista_login()
	{
		return view('invitado.login_institucion');
	}

    public function login(Request $data)/* Logear una institución */
    {   
        try{  
          $data->flash();
            
        	if (\Auth::guard('institucion')->attempt(['email' => $data->correo, 'password' => $data->clave])) {
               return redirect('/institucion/inicio');
            }
            return redirect()->back()->withErrors(['Datos incorrectos, intente nuevamente']);

        }catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien, posiblemente datos mal ingresados o no hay conexión']);
       }     
    }

    public function logout(){
        \Auth::guard('institucion')->logout();
        return redirect('/inicio');
    }
    public function logout_encargado()
    {
         \Auth::logout();
            return redirect('/inicio');
    }
    /*****************************************************************************************************************
    /**Logear un Vendedor institucionql**/////////////////////////////////////////////////////////////

    public function vista_loginVenInst(){

        return view('invitado.login_vendedorInstitucional');
    }
    
    public function login_vendedorInst(userloginRequest $data){
        
           try{
                  $data->flash();
                  $verificar = \DB::select("select * from users where email = '".$data->correo."'");

                  if(count($verificar)>0 && $verificar[0]->id_rol == 2){  /**"eres vendedor institucional"**/
         
                      if (\Auth::attempt(['email' => $data->correo, 'password' => $data->clave])) {
              
                          return redirect('/userDependiente/inicio');    
                      }
                      return redirect()->back()->withErrors(['Datos incorrectos, intente nuevamente']);;
                  }
                   return redirect()->back()->withErrors(['Datos incorrectos, intente nuevamente']);
            }catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withErrors(['Algo no anda bien, posiblemente datos mal ingresados o no hay conexión']);
       } 

    }
        
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

           
        try{  
            $data->flash();  
            $verificar = \DB::select("select * from users where email = '".$data->correo."'");

             if (count($verificar)>0 && $verificar[0]->id_rol == 1) { /**"eres vendedor individual"**/
                if (\Auth::attempt(['email' => $data->correo, 'password' => $data->clave])) {
                    return redirect('/userIndependiente/inicio');
                }
                return redirect()->back()->withErrors(['Datos incorrectos, intente nuevamente']);
                
            }
             return redirect()->back()->withErrors(['Datos incorrectos, intente nuevamente']);
        }catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withErrors(['Algo no anda bien, posiblemente datos mal ingresados o no hay conexión']);
       }     
     }

     public function vista_loginEncargado(){
        
            return view('invitado.login_encargadoArea');
     }
     public function login_loginEncargado(userloginRequest $data){
        
        try{

            $data->flash();
            $verificar = \DB::select("select * from users where email = '".$data->correo."'");
          
                if(count($verificar)>0 && $verificar[0]->id_rol == 3){  /**"eres encargado de area"**/
                
                    if (\Auth::attempt(['email' => $data->correo, 'password' => $data->clave])) {
                        
                        return redirect('/encargadoArea/inicio');    
                    }

                    return redirect()->back()->withErrors(['Datos incorrectos, intente nuevamente']);
                }
                   return redirect()->back()->withErrors(['Datos incorrectos, intente nuevamente']);
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withErrors(['Algo no anda bien, posiblemente datos mal ingresados o no hay conexión']);
       }      
     }

      /*login Cliente*/

    
}
