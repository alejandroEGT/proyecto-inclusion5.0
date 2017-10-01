<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class foto_producto_institucion extends Model
{
    protected $table = "foto_productos_instituciones";

    protected function insertar($datos, $idprod)
    {

    	 $url="foto_productos_instituciones";
        $file = $datos->file('fotoP1')->getClientOriginalExtension();
        $imageName = time().'.'.$datos->file('fotoP1')->getClientOriginalExtension();//nombre de la imagen como tal.

    	$insert = new foto_producto_institucion;
        $insert->id_producto = $idprod;
    	$insert->foto = $url.'/'.$imageName;

    	if ($insert->save()) {
             $datos->file('fotoP1')->move(public_path($url), $imageName);
    		return $insert->id;
    	}
    	return 0;
    }

    protected function borrar($id)
    {
        $tpi = \DB::table('foto_productos_instituciones')->where('id', '=', $id)->delete();
        return $tpi;
    }

    protected function actualizar_foto($dato)
    {
        $url="foto_productos_instituciones";
        $getFoto = foto_producto_institucion::where('id_producto',$dato->idProducto)->get();
        \File::delete($getFoto[0]->foto);/*ELIMINAR FOTO*/
        $file = $dato->file('fotoP1')->getClientOriginalExtension();
        $imageName = time().'.'.$dato->file('fotoP1')->getClientOriginalExtension();//nombre de la imagen como tal.

        $update = foto_producto_institucion::find($getFoto[0]->id);
        $update->foto = $url.'/'.$imageName;
        if ($update->save()) {
              $dato->file('fotoP1')->move(public_path($url), $imageName);
              return 1;
        }
        return 0;
    }
}
