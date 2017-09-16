<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarioinstitucion extends Model
{
    protected $table = "usuario-institucion";/*Encargado de área*/

     protected function insertar($datos, $idUser)
      {
      		$usuario = new Usuarioinstitucion;
      		$usuario->id_user = $idUser;
      		$usuario->telefono = $datos->telefono;
      		$usuario->id_institucion = \Auth::guard('institucion')->user()->id;
      		$usuario->id_area = $datos->area;
      		if($usuario->save()){
      			return true;
      		}
      		return false;
      } 

      protected function existeuser($id_area){
          $existe = Usuarioinstitucion::where('id_area','=', $id_area)->get();
          
          if($existe){
            return $existe;
          }
          return false;
      }
      protected function traerUser($idarea){

          $user = \DB::select("CALL `traerUsuarioInstitucional`(".$idarea.");");
          return $user[0];
      }

      protected function actualizarNumero($numero){

          $ususarioInst = Usuarioinstitucion::where('id_user', \Auth::user()->id)
                                              ->update(['telefono' => $numero ]);
          return $ususarioInst;
      }
}
