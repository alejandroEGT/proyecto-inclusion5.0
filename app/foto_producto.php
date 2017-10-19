<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class foto_producto extends Model
{
    protected $table = "foto_productos";


    protected function insertar($datos, $idprod)
    {

        $url="foto_productos";
        $file = $datos->file('foto')->getClientOriginalExtension();
        $imageName = time().'.'.$datos->file('foto')->getClientOriginalExtension();//nombre de la imagen como tal.

        $insert = new foto_producto;
        $insert->id_producto = $idprod;
        $insert->foto = $url.'/'.$imageName;

        if ($insert->save()) {
             $datos->file('foto')->move(public_path($url), $imageName);
            return $insert->id;
        }
        return 0;
    }

    protected function borrar($id)
    {
        $getFoto = foto_producto::find($id);
        \File::delete($getFoto->foto);/*ELIMINAR FOTO*/
        $tpi = \DB::table('foto_productos')->where('id', '=', $id)->delete();
        return $tpi;
    }

    protected function actualizar_foto($dato)
    {
        $url="foto_productos";
        $getFoto = foto_producto::where('id_producto',$dato->idProducto)->get();
        \File::delete($getFoto[0]->foto);/*ELIMINAR FOTO*/
        $file = $dato->file('foto')->getClientOriginalExtension();
        $imageName = time().'.'.$dato->file('foto')->getClientOriginalExtension();//nombre de la imagen como tal.

        $update = foto_producto::find($getFoto[0]->id);
        $update->foto = $url.'/'.$imageName;
        if ($update->save()) {
              $dato->file('foto')->move(public_path($url), $imageName);
              return 1;
        }
        return 0;
    }
}
