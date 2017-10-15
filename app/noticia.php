<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class noticia extends Model
{
    protected $table = "noticias";

    protected function insertar($datos, $idInstitucion)
    {
    	 $url="foto_noticias";
        $file = $datos->file('foto')->getClientOriginalExtension();
        $imageName = time().'.'.$datos->file('foto')->getClientOriginalExtension();//nombre de la imagen como tal.

    	$noticia = new noticia;
    	$noticia->titulo = $datos->titulo;
    	$noticia->texto = $datos->texto;
    	$noticia->foto = $url.'/'.$imageName;
    	$noticia->id_estado = $datos->estado;
    	$noticia->id_institucion = $idInstitucion;

    	if ($noticia->save()) {
    		 $datos->file('foto')->move(public_path($url), $imageName);
    		 return 1;
    	}
    	return 0;
    }
    protected function noticias_generales()
    {
        $noticias = noticia::where('id_estado', 1)
        ->orderBy('created_at', 'desc')
        ->take(3)->get();;
        return $noticias;
    }
    protected function noticias_locales($id_institucion)
    {
        $noticias = noticia::where('id_institucion', $id_institucion)
        ->orderBy('created_at', 'desc')
        ->take(3)->get();
        return $noticias;
    }
    protected function estado_noticias()
    {
        $estado = \DB::table('noticias')
                  ->select([
                        'estado_noticias.nombre as nombreEstado'
                   ])
                  ->join('estado_noticias','estado_noticias.id','=','noticias.id_estado')->get();
        return $estado;          
    }
    protected function detalleNoticia($idInst)
    {
        $noticia = \DB::table('noticias')
         ->select([     'noticias.id as id',
                        'noticias.foto as foto',
                        'noticias.titulo as titulo',
                        'noticias.texto as texto',
                        'estado_noticias.nombre as nombreEstado'
                   ])
        ->join('estado_noticias','estado_noticias.id','=','noticias.id_estado')
        ->where('noticias.id_institucion', $idInst)
        ->orderBy('noticias.created_at', 'desc')
        ->paginate(3);
        return $noticia;
    }
    protected function todas()
    {
        $noticia = \DB::table('noticias')
         ->select([     'noticias.id as id',
                        'noticias.foto as foto',
                        'noticias.titulo as titulo',
                        'noticias.texto as texto',
                        'noticias.created_at as creado',
                        'estado_noticias.nombre as nombreEstado',
                        'institucion.id as idInstitucion',
                        'institucion.nombre as nombreInstitucion',
                        'institucion.logo as logoInstitucion'
                   ])
        ->join('estado_noticias','estado_noticias.id','=','noticias.id_estado')
        ->join('institucion','institucion.id','=','noticias.id_institucion')
        ->where('noticias.id_estado', 1)
        ->orderBy('noticias.created_at', 'desc')
        ->paginate(10);
        return $noticia;
    }
}
