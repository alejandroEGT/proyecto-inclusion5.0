<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fotoperfil extends Model
{
    protected $table="fotoperfil";

    protected function fotoDefault($iduser)
    {
    	$fotodef = new Fotoperfil;
    	$fotodef->id_user = $iduser;
    	$fotodef->foto = "ico/default-avatar.png";/*Imagen por default*/
    	if ($fotodef->save()) {
    		return true;
    	}
    	return false;
    }
    protected function traerFoto(){
        //$foto = \DB::select("CALL `traerFotoPerfil`(".\Auth::user()->id.");");
        $foto = Fotoperfil::where('id_user', \Auth::user()->id )->get();
        return $foto[0]->foto;
    }
    protected function traerFotobyid($iduser){

        $foto = \DB::select("CALL `traerFotoPerfil`(".$iduser.");");
        return $foto[0]->foto;
    }

    protected function guardar($datos)
    {

         $url="fotoPerfil";
         $file = $datos->file('fotoP')->getClientOriginalExtension();
         $imageName = time().'.'.$datos->file('fotoP')->getClientOriginalExtension();//nombre de la imagen como tal.
        
        $id_foto = \DB::table('fotoperfil')->where('id_user','=', \Auth::user()->id )->get();
        
        $saveFoto = Fotoperfil::find($id_foto[0]->id);

        $saveFoto->foto = $url.'/'.$imageName;/*Pasando ruta de imagen a la base de datos*/

        if($saveFoto->save()){
            $datos->file('fotoP')->move(public_path($url), $imageName);
            return 1;
        }
        else{
            return 0;
        }
    }
    protected function eliminar($id){

        $eliminar = Fotoperfil::where('id_user', $id)->delete();
    }
<<<<<<< HEAD
    protected function actualizar_foto($dato)
    {

        $url="fotoPerfil";
        $getFoto = Fotoperfil::where('id_user',$dato->idUser)->get();

        if ($getFoto[0]->foto === "ico/default-avatar.png") {
            
                $file = $dato->file('foto')->getClientOriginalExtension();
                $imageName = time().'.'.$dato->file('foto')->getClientOriginalExtension();//nombre de la imagen como tal.

                $update = Fotoperfil::find($getFoto[0]->id);
                $update->foto = $url.'/'.$imageName;
                if ($update->save()) {
                      $dato->file('foto')->move(public_path($url), $imageName);
                      return 1;
                }
                return 0;

        }
        
         \File::delete($getFoto[0]->foto);/*ELIMINAR FOTO*/
                $file = $dato->file('foto')->getClientOriginalExtension();
                $imageName = time().'.'.$dato->file('foto')->getClientOriginalExtension();//nombre de la imagen como tal.

                $update = Fotoperfil::find($getFoto[0]->id);
                $update->foto = $url.'/'.$imageName;
                if ($update->save()) {
                      $dato->file('foto')->move(public_path($url), $imageName);
                      return 1;
                }
                return 0;



       
=======

    protected function fotoSocial($datos, $iduser){

        $foto = new Fotoperfil;
        $foto->id_user = $iduser;
        $foto->foto =  $datos->avatar_original;
        if ($foto->save()) {
            return true;
        }
        return false;
>>>>>>> 92b7ad0282efcc4072fbfea61503115507c0a127
    }
}

