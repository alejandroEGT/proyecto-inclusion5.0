<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Institucion extends Authenticatable
{
    use Notifiable;
    protected $table="institucion";

     protected $fillable = [
         'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function insertar($datos){
        $url="logo";
        $file = $datos->file('logo')->getClientOriginalExtension();
        $imageName = time().'.'.$datos->file('logo')->getClientOriginalExtension();//nombre de la imagen como tal.
    	
    	$instituto = new Institucion;
    	$instituto->rut = $datos->rut;
    	$instituto->nombre = $datos->nombre;
    	$instituto->razonSocial = $datos->razonSocial;
    	$instituto->telefono1 = $datos->telefono1;
    	$instituto->telefono2 = $datos->telefono2;
    	$instituto->direccion = $datos->direccion;
    	$instituto->logo = $url.'/'.$imageName;
    	$instituto->email = $datos->correo;
    	$instituto->password = bcrypt($datos->clave);
    	if($instituto->save()){
            $datos->file('logo')->move(public_path($url), $imageName);
    		return 1;
    	}
    	else{
    		return 0;
    	}
    }


    private function logo($datos){
    	$url="logo";
    	$file = $datos->file('logo')->getClientOriginalExtension();
    	$imageName = time().'.'.$datos->file('logo')->getClientOriginalExtension();//nombre de la imagen como tal.
        if($datos->file('logo')->move(public_path($url), $imageName))// verifica que la imagen subida se valla a la ruta del servifor.
        {
        	return ($url.'/'.$imageName);
        }
    }

    protected function notificaciones(){

            $notificar = \DB::select('call `notificarVendedor`('.\Auth::guard('institucion')->user()->id.');');
            return $notificar;
    }
    protected function usuariosEsperando(){
            $espera = \DB::select("CALL `usuariosEsperando`(".\Auth::guard('institucion')->user()->id.");");
            return $espera;
    }

    protected function datos(){
            $datos = \DB::select('select * from `institucion` where id ='.\Auth::guard('institucion')->user()->id);
            return $datos[0];
    }
    protected function traerMision()
    {
            $mision = \DB::select('select vision from `institucion` where id = '.\Auth::guard('institucion')->user()->id);
            return $mision;
    }
     protected function traerVision()
    {
            $vision = \DB::select('select vision from `institucion` where id = '.\Auth::guard('institucion')->user()->id);
            return $vision;
    }
     protected function buscar($dato){

        $resultado = \DB::select("CALL `buscar_institucion`('%".$dato."%');");
        return $resultado;
    }
}
