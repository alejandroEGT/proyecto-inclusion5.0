<?php

namespace App\Http\Controllers;

use App\Fotoperfil;
use App\Http\Requests\FormUsuarioRequest;
use App\User;
use App\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class vendedorIndependienteController extends Controller
{
    public function vista_inicio()
    {
        $foto = Fotoperfil::traerFoto();
    	return view('vendedorIndependiente.inicio')->with('foto', $foto);
    }
    public function vista_cambiarFoto(){
        return view('vendedorIndependiente.cambiarFoto');
    }

     public function insertar_vendedorIndependiente(FormUsuarioRequest $datos)
    {
        $datos->flash();
        $insert = User::insertar_vendedor($datos);
        if ($insert) {
           
            $id_user = User::where('email','=',"$datos->correo")->get();
                
            $vendedor = Vendedor::insertar_aprobado($datos, $id_user[0]->id);
            if ($vendedor) {

                    $foto = Fotoperfil::fotoDefault($id_user[0]->id);
                    if ($foto) {
                        return "ok";
                    }
                    return "error";
            }        
        }
        return "error";
    }
     public function traerFotoVendedor(){

        $dato = Fotoperfil::traerFoto();
        return $dato;
    }
    public function guardar_foto(Request $dato)
    {   
         $this->validate($dato, ['fotoP' => 'required']);
        $guardar = Fotoperfil::guardar($dato);
         \Session::flash('cambio', 'Foto cambiada');
        return redirect()->back();
    }


       public function mis_datos()
    {


        $foto = Fotoperfil::traerFotobyid(Auth::user()->id);
        return view('vendedorIndependiente.mis_datos')->with('foto', $foto);
                                                     
    }

    public function ingresar_productos()
    {
        return view('vendedorIndependiente.ingresar_productos');
    }

      public function ingresar_servicios()
    {
        return view('vendedorIndependiente.ingresar_servicios');
    }

       public function modificar_productos()
    {
        return view('vendedorIndependiente.modificar_productos');
    }

         public function modificar_servicios()
    {
        return view('vendedorIndependiente.modificar_servicios');
    }


}


