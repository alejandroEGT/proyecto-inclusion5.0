<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendedorInstitucion extends Model
{
    protected $table = "vendedor-institucion";

    protected function eliminar($idv)
    {
        $eliminar = VendedorInstitucion::where('id_vendedor', $idv)->delete();
        return $eliminar;
    }
    protected function insertar($datos, $id_ven){

    	$vendedor = new VendedorInstitucion;

        $vendedor->id_vendedor = $id_ven;
        $vendedor->id_institucion = $datos->id_institucion;
        $vendedor->id_area = $datos->id_area;

    	if($vendedor->save()){
    		return true;
    	}
    	return true;

    }
    protected function insertar_dentro($datos, $id_ven)
    {
        $vendedor = new VendedorInstitucion;

        $vendedor->id_vendedor = $id_ven;
        $vendedor->id_institucion = \Auth::guard('institucion')->user()->id;
        $vendedor->id_area = $datos->id_area;

        if($vendedor->save()){
            return true;
        }
        return true;
    }
    protected function insertar_desde_area($datos, $id_ven)
    {
        $vendedor = new VendedorInstitucion;

        $vendedor->id_vendedor = $id_ven;
        $vendedor->id_institucion = $datos->idInstitucion;
        $vendedor->id_area = $datos->idArea;

        if($vendedor->save()){
            return true;
        }
        return true;
    }
    protected function idVendedor($id){

        $id = \DB::select("select * from `vendedor` where id_user = ".$id);
        return $id;
    }
    protected function id_institucion()
    {
       $dato = \DB::table('vendedor')
                ->join('vendedor-institucion','vendedor-institucion.id_vendedor','=','vendedor.id')
                ->where('vendedor.id_user', \Auth::user()->id)->first();

       return $dato;         
    }
    protected function traerFoto ($id){

        //return $id;
       $id = \DB::select("CALL `traerFotoPerfil`('".$id."');");
        return $id;
    }
    protected function contarVendedores($id){

        $contar = \DB::select("CALL `contarVendedoresInstitucionales`(".$id.");");
        return $contar[0]->contar;
    }
    
    protected function fotoVendedorInstitucion(){

        $datos = \DB::select("CALL `fotoVendedorInstitucional`(".\Auth::user()->id.");");
        return $datos[0]->foto;

    }
    protected function datosVendedorInstitucion($idArea){

        $datos = \DB::select("CALL `datosVendedorInstitucion`(".$idArea.");");
        if ($datos) {
            return $datos;
        }
        return null;
        
    }
    protected function detalleAlumno($idAlumno)
    {
        $traer = \DB::table('vendedor-institucion')
                  ->select([
                        'users.id as idUser',
                        'fotoperfil.foto as foto',
                        'users.nombres as nombre',
                        'users.apellidos as apellidos',
                        'users.email as correo',
                        'vendedor.telefono as telefono',
                        'estado.nombre as nombreEstado',
                        'area.nombre as nombreArea'
                  ])
                  ->join('vendedor', 'Vendedor.id','=','vendedor-institucion.id_vendedor')
                  ->join('users','users.id','=','Vendedor.id_user')
                  ->join('estado', 'estado.id','=','vendedor.id_estado')
                  ->join('area','area.id','=','vendedor-institucion.id_area')
                  ->join('institucion','institucion.id','=','area.id_institucion')
                  ->join('fotoperfil','fotoperfil.id_user','=','users.id')
                  ->where('users.id', $idAlumno)
                  ->where('Institucion.id', \Auth::guard('institucion')->user()->id)
                  ->get();
        
        if (count($traer)>0) {
          return $traer;
        }
        return null;
    }
    protected function detalleAlumno_enc($idAlumno, $areaId)
    {
        $traer = \DB::table('vendedor-institucion')
                  ->select([
                        'users.id as idUser',
                        'fotoperfil.foto as foto',
                        'users.nombres as nombre',
                        'users.apellidos as apellidos',
                        'users.email as correo',
                        'vendedor.telefono as telefono',

                  ])
                  ->join('vendedor', 'Vendedor.id','=','vendedor-institucion.id_vendedor')
                  ->join('users','users.id','=','Vendedor.id_user')
                  ->join('estado', 'estado.id','=','vendedor.id_estado')
                  ->join('area','area.id','=','vendedor-institucion.id_area')
                  ->join('institucion','institucion.id','=','area.id_institucion')
                  ->join('fotoperfil','fotoperfil.id_user','=','users.id')
                  ->where('users.id', $idAlumno)
                  ->where('area.id', $areaId)
                  ->get();
        
        if (count($traer)>0) {
          return $traer;
        }
        return null;
    }

    protected function datosAlumnoById($id)
    {
        $traer = \DB::table('vendedor-institucion')
                  ->select([
                        'users.id as idUser',
                        'fotoperfil.foto as foto',
                        'users.nombres as nombre',
                        'users.apellidos as apellidos',
                        'users.email as correo',
                        'vendedor.telefono as telefono',
                        'area.nombre as nombreArea',
                        'institucion.nombre as nombreInstitucion',

                  ])
                  ->join('vendedor', 'Vendedor.id','=','vendedor-institucion.id_vendedor')
                  ->join('users','users.id','=','Vendedor.id_user')
                  ->join('estado', 'estado.id','=','vendedor.id_estado')
                  ->join('area','area.id','=','vendedor-institucion.id_area')
                  ->join('institucion','institucion.id','=','area.id_institucion')
                  ->join('fotoperfil','fotoperfil.id_user','=','users.id')
                  ->where('users.id', $id)
                  ->get();
        
        if (count($traer)>0) {
          return $traer;
        }
        return null;
    }

    protected function traerEstadoClave(){

        $estado = \DB::table('password-cuenta')->where('id_user', \Auth::user()->id )->get(); 
        return $estado[0]->id_estado;
    }

    protected function actualizar_area_alumno($area, $idVendedor)
    {
       $update = VendedorInstitucion::where('id_vendedor', $idVendedor)->first();
       $update->id_area = $area;
       if ($update->save()) {
         return true;
       }
       return false;
    }
    

}
