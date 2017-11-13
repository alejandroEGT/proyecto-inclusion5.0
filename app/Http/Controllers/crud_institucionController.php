<?php

namespace App\Http\Controllers;

use App\Http\Requests\institucionRequest;
use App\Institucion;
use App\User;
use App\Tienda_institucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class crud_institucionController extends Controller
{
   
      public function insertar(institucionRequest $datos)
    {
        try{
            
            $retornar = Institucion::insertar($datos);

            if($retornar > 0){

                $idInstitucion = Institucion::where('email', $datos->correo)->get();

                $creartienda = Tienda_institucion::insertar($idInstitucion[0]->id);
                if ($creartienda) {
                    $correo = $datos->correo;
                    \Session::put('nombre',$datos->nombre);
                    Mail::send(['html'=>'emails.registroInstitucion'],['name','Alejandro'],function ($message) use ($correo)
                                        {
                                          $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
                                          $message->to($correo,'to');
                    });
                    \Session::flash('ingresado', 'Institución registrada');
                    return redirect()->back();
                }
                $datos->flash();
                return redirect()->back()->withErrors(['Algo salió mal']);
            }
            $datos->flash();
            return redirect()->back()->withErrors(['Algo salió mal']);

        } catch (\Illuminate\Database\QueryException $e) {
                $datos->flash();
                return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }
    }
 }
