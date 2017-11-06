<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = "vendedor";

    protected $fillable = [
        'id',
    ];

     protected function insertar_aprobado($datos, $idUser){

        $date = new \DateTime($datos->fecha);
        $vendedor = new Vendedor;
        $vendedor->id_user = $idUser;
        $vendedor->telefono = $datos->telefono;
        $vendedor->fecha_nac = $date->format('Y-m-d');
        $vendedor->id_estado = "1";/* Aceptado*/

        if($vendedor->save()){
            return true;
        }
        return false;

    }
     protected function insertar_esperando($datos, $idUser){

        $date = new \DateTime($datos->fechaDeNacimiento);
        $vendedor = new Vendedor;
        $vendedor->id_user = $idUser;
        $vendedor->telefono = $datos->telefono;
        $vendedor->fecha_nac = $date->format('Y-m-d');
        $vendedor->id_estado = "2";/* esperando*/

        if($vendedor->save()){
            return true;
        }
        return false;

    }
    protected function eliminar($idu)
    {
        $eliminar = Vendedor::where('id_user', $idu)->delete();
        return $eliminar;
    }
    protected function filtrar($idUser){
    	$filtro = \DB::table('vendedor')->select('id')->where('id_user','=', $idUser)->get();
    	return $filtro;
    }

    protected function verificEstado($idUser){
        $estado = \DB::table('vendedor')->select('id_estado')->where('id_user','=', $idUser)->get();
        return $estado;
    }

    protected function aceptarusuario($id){
        $aceptar = \DB::update("update `vendedor` set id_estado = 1 where id_user = ".$id);
        return $aceptar;
    }
    protected function verificarVendedor($correo){

        $verificar = \DB::select(" CALL `verificarVendedorInstitucional`('".$correo."');");
        return $verificar;
    }
    protected function idVendedor($id){
        
         //$id = \DB::select("select * from `vendedor` where id_user = ".$id);
         $id = Vendedor::where('id_user', $id)->get();
        return $id;
    }
     protected function fotoVendedor(){

        $datos = \DB::select("CALL `fotoVendedor`(".\Auth::user()->id.");");
        return $datos[0]->foto;

    }
    protected function actualizar_numero($numero, $iduser)
    {
        $vendedor = Vendedor::where('id_user', $iduser)->first();
        $vendedor->telefono = $numero;
        if ($vendedor->save()) {
            return true;
        }
        return false;
    }
    protected function actualizarFecha($fecha, $idUser)
    {
        $vendedor = Vendedor::where('id_user', $idUser)->first();
        $vendedor->fecha_nac = $fecha;
        if ($vendedor->save()) {
            return true;
        }
        return false;
    }
    protected function traerDatos($idV)
    {
        $traer = \DB::table('vendedor')
                    ->select([
                        'vendedor.id as id',
                        'fotoperfil.foto as foto'
                    ])
                    ->join('users', 'users.id','=','vendedor.id_user')
                    ->join('fotoperfil','fotoperfil.id_user','users.id')
                    ->where('vendedor.id', $idV)->first();
        return $traer;             
    }

}
