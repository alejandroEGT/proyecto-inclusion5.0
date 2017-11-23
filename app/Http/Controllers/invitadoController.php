<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Requests\institucionRequest;
use App\Institucion;
use App\Sexo;
use Illuminate\Http\Request;
use App\Http\Requests\resetpasswordRequest;
use App\reset_password;
use Illuminate\Support\Facades\Mail;
class invitadoController extends Controller
{   
    public function vista_inicio(){

            return view('invitado.inicio');
    }


    public function vista_registros(){

    	 	return view('invitado.multiRegistro');
    }
    public function vista_formUser(){
        try{
    		$sexo = Sexo::all();
    		return view('invitado.form_usuario')->with('sexo',$sexo);
            
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['No hay conexión a base de datos']);
        }     
    }
    public function vista_formUserInstituto(){
        try{
            $institucion = Institucion::all();
            $sexo = Sexo::all();
    		return view('invitado.form_usuario_institucion')
            ->with('institucion', $institucion)
            ->with('sexo', $sexo);

        }catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['No hay conexión a base de datos']);
        }    
    }
    public function vista_formInstitucion(){
    		return view('invitado.form_institucion');
    }
    public function vista_proyecto()
    {
            return view('invitado.multiRegistro');
    }
    public function vista_ayuda()
    {
            return view('invitado.ayuda');
    }


    public function filtroArea(Request $dato){
            $area = Area::where('id_institucion','=',$dato->id)->get();
            return response()->json($area);
    }
    public function vista_recuperarPassword($value='')
    {
            return view('invitado.recuperarPassword');
    }
    public function resetPass(Request $dato)
    {
        
             $this->validate($dato,['correo' => 'required | max:80 |email | exists:institucion,email']);
             
             $genclave = $this->genclave();
          
             $insertar = reset_password::insertar($dato, $genclave);
             if ($insertar) {
                  $correo = $dato->correo;
                    \Session::put('clave',$genclave);
                    Mail::send(['html'=>'emails.reset_pass'],['name','Alejandro'],function ($message) use ($correo)
                                        {
                                          $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
                                          $message->to($correo,'to');
                    });
                    \Session::flash('ingreso', 'El codigo gue enviado a '.$dato->correo);
                    return redirect('/codigo_reset');
             }
             return redirect()->back();

        
    }
    public function vista_codigo_reset()
    {
        return view('invitado.ingresoCodigo');

     
    }
    public function resetPassGo(resetpasswordRequest $datos)
    {
        try{

            $verificarToken = reset_password::where('email', $datos->correo)
                            ->where('token', $datos->codigo)->first();

            if ($verificarToken == true) {
                
                $inst = Institucion::where('email', $datos->correo)->first();
                $inst->password = \Hash::make($datos->clave);
                if ($inst->save()) {
                    
                    $borrarToken = \DB::table('password_resets')->where('email', '=', $datos->correo)->where('token','=', $datos->codigo)->delete();

                    if ($borrarToken == true ) {

                        $correo = $datos->correo;
                        Mail::send(['html'=>'emails.reset_pass_ok'],['name','Alejandro'],function ($message) use ($correo)
                                        {
                                          $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
                                          $message->to($correo,'to');
                        });

                         \Session::flash('ingresado', 'La clave fue reestablecida con exito');
                         return redirect()->back();
                    }
                    return redirect()->back()->withErrors(['Error, imposible de ejercer la operación']);

                }
                return redirect()->back()->withErrors(['Error, imposible de ejercer la operación']);

            }
            return redirect()->back()->withErrors(['El código es incorrecto']);


        }catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        } 
        
    }
    public function genclave(){
      //$cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $cadena_base = '0123456789' ;
      //$cadena_base .= 'kkck';
      $password = '';
      $limite = strlen($cadena_base) - 1;
 
      for ($i=0; $i < 4; $i++)
        $password .= $cadena_base[rand(0, $limite)];
        return $password;
    }
}