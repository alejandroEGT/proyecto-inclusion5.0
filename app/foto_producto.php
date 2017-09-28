<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class foto_producto extends Model
{
    protected $table = "foto_productos";

    protected function insertar($datos)
    {

    	 $url="foto_productos";
        $file = $datos->file('fotoP1')->getClientOriginalExtension();
        $imageName = time().'.'.$datos->file('fotoP1')->getClientOriginalExtension();//nombre de la imagen como tal.

    	$insert = new foto_producto;
    	$insert->nombre = $url.'/'.$imageName;

    	if ($insert->save()) {
             $datos->file('fotoP1')->move(public_path($url), $imageName);
    		return $insert->id;
    	}
    	return 0;
    }
}
