<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','id_rol'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    protected function insertar_vendedor($datos){

            $user = new User;

            $user->nombres = $datos->nombres;
            $user->apellidos = $datos->apellidos;
            $user->email = $datos->correo;
            $user->password = \Hash::make($datos->clave);
            $user->id_rol = "1";/* id de vendedor */
            $user->id_sexo = $datos->id_sexo;
            
            if($user->save()){
                return true;
            }
            return false;
    }
     protected function insertar_vendedorDependiente($datos){

            $user = new User;

            $user->nombres = $datos->nombres;
            $user->apellidos = $datos->apellidos;
            $user->email = $datos->correo;
            $user->password = \Hash::make($datos->clave);
            $user->id_rol = "2";/* id de vendedor dependiente */
            $user->id_sexo = $datos->id_sexo;
            
            if($user->save()){
                return true;
            }
            return false;
    }
    protected function insertar_vendedorDependiente_dentro($datos, $clave){

            $user = new User;

            $user->nombres = $datos->nombres;
            $user->apellidos = $datos->apellidos;
            $user->email = $datos->correo;
            $user->password = \Hash::make($clave);
            $user->id_rol = "2";/* id de vendedor dependiente */
            $user->id_sexo = $datos->id_sexo;
            
            if($user->save()){
                return true;
            }
            return false;
    }
    protected function insertar_userInstitucion($datos, $claveGen){

            $user = new User;

            $user->nombres = $datos->nombres;
            $user->apellidos = $datos->apellidos;
            $user->email = $datos->correo;
            $user->password = \Hash::make($claveGen);
            $user->id_rol = "3";/* id de encargado de area de Institucion,  */
            $user->id_sexo = $datos->id_sexo;
            
            if($user->save()){
                return true;
            }
            return false;
    }

    protected function buscador($dato){

            $resultado = \DB::select("CALL `buscar_vendedor`('%".$dato."%');");
            return $resultado;
    }
    protected function actualizarCorreo($correo){

            $usuario = User::find(\Auth::user()->id);
            $usuario->email = $correo;
            if ($usuario->save()) {
                return true; 
            }
            return false;
    }

     static public function filtroBusarUser($buscar){

            

            $resultado = \DB::select("CALL `buscaralumno`('".\Auth::guard('institucion')->user()->id."','%".$buscar."%');");
            return $resultado;
    }

    protected function insertarCliente($datos, $tipo){

        $user = new User;

        switch ($tipo) {
            case '1':
                    $user->nombres = $datos->nombres;
                    $user->apellidos = $datos->apellidos;
                    $user->email = $datos->correo;
                    $user->password = \Hash::make($datos->clave);
                    $user->id_rol = "4";
                    $user->id_sexo = $datos->sexo;

                    if($user->save()){
                        return true;
                    }else{
                        return false;
                    }
                    
                break;

            case '2':
                # code...
                break;

            case '3':
                # code...
                break;
            default:
                # code...
                break;
        }

         
    }
}
