<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class foto_servicio extends Model
{
    protected $table = "foto_servicios";

    protected function insertar($datos, $idser)
    {

        $url="foto_servicios";
        $file = $datos->file('fotoP1')->getClientOriginalExtension();
        $imageName = time().'.'.$datos->file('fotoP1')->getClientOriginalExtension();//nombre de la imagen como tal.

        $insert = new foto_servicio;
        $insert->id_servicio = $idser;
        $insert->nombre = $url.'/'.$imageName;

        if ($insert->save()) {
             $datos->file('fotoP1')->move(public_path($url), $imageName);
            return $insert->id;
        }
        return 0;
    }
     protected function borrar($id)
    {
        $getFoto = foto_servicio::find($id);
        \File::delete($getFoto->foto);/*ELIMINAR FOTO*/
        $tpi = \DB::table('foto_servicios')->where('id', '=', $id)->delete();
        return $tpi;
    }

     protected function actualizar_foto($dato)
    {
        $url="foto_productos";
        $getFoto = foto_servicio::where('id_servicio',$dato->idServicio)->get();
        \File::delete($getFoto[0]->foto);/*ELIMINAR FOTO*/
        $file = $dato->file('fotoP1')->getClientOriginalExtension();
        $imageName = time().'.'.$dato->file('fotoP1')->getClientOriginalExtension();//nombre de la imagen como tal.

        $update = foto_servicio::find($getFoto[0]->id);
        $update->foto = $url.'/'.$imageName;
        if ($update->save()) {
              $dato->file('fotoP1')->move(public_path($url), $imageName);
              return 1;
        }
        return 0;
    }
}
