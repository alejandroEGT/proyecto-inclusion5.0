<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fotoperfil extends Model
{
    protected $table="fotoperfilvendedor";

    protected function fotoDefault($id_vendedor)
    {
    	$fotodef = new Fotoperfil;
    	$fotodef->id_vendedor = $id_vendedor;
    	$fotodef->foto = "ico/default-avatar.png";/*Imagen por default*/
    	if ($fotodef->save()) {
    		return true;
    	}
    	return false;
    }
    protected function traerFoto(){

        $foto = \DB::select("CALL `traerFotoPerfil`(".\Auth::user()->id.");");
        return $foto[0]->foto;
    }

    protected function guardar($datos)
    {

         $url="fotoPerfil";
         $file = $datos->file('fotoP')->getClientOriginalExtension();
         $imageName = time().'.'.$datos->file('fotoP')->getClientOriginalExtension();//nombre de la imagen como tal.

        $id_vendedor = Vendedor::idVendedor(\Auth::user()->id);
        
        $id_foto = \DB::table('fotoperfilvendedor')->where('id_vendedor','=', $id_vendedor[0]->id)->get();
        
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
}

