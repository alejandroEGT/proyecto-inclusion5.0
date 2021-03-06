<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Institucion;

class buscadorController extends Controller
{


    
     public function buscador_inst(Request $dato)
    {   
        try{
            $this->validate($dato, ['buscador' => 'required']);
            $vendedor = User::buscador($dato->buscador);
            $institucion = Institucion::buscar($dato->buscador);
            return view('institucion.buscador_institucion')
            ->with('vendedor',$vendedor)
            ->with('institucion',$institucion);

        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back();

        }
    }
     public function buscador_ven_inst(Request $dato)
    {   
        try{
            $this->validate($dato, ['buscador' => 'required']);
            $vendedor = User::buscador($dato->buscador);
            $institucion = Institucion::buscar($dato->buscador);
            return view('vendedorDependiente.buscador_vendedorInst')
            ->with('vendedor',$vendedor)
            ->with('institucion',$institucion);
            
        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back();

        }
    }
     public function buscador_ven(Request $dato)
    {   
        try{
            $this->validate($dato, ['buscador' => 'required']);
            $vendedor = User::buscador($dato->buscador);
            $institucion = Institucion::buscar($dato->buscador);
            return view('vendedorIndependiente.buscador_vendedor')
            ->with('vendedor',$vendedor)
            ->with('institucion',$institucion);

        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back();

        }
    }
     public function buscador_encargado(Request $dato)
    {   
        try{
            $this->validate($dato, ['buscador' => 'required']);
            $vendedor = User::buscador($dato->buscador);
            $institucion = Institucion::buscar($dato->buscador);
            return view('encargadoArea.buscador_encargado')
            ->with('vendedor',$vendedor)
            ->with('institucion',$institucion);

        } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back();

        }
    }
}
