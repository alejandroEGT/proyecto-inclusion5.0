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
}
