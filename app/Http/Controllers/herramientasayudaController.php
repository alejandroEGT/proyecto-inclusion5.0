<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class herramientasayudaController extends Controller
{
  	public function actiar_microfono()
  	{
		  	if(\Session::has('activarText')){
		        \Session::flash('flash_desactivar', 'Desactiva la opcion actual');
		        return redirect()->back();
		    }
		       \Session::put('activarMicro', '1');
		    	//dd(Session::get('activar'));
		       \Session::flash('flash_activadomicro', 'Activando microfono');
		        return redirect()->back();
	}

	public function desactivar_microfono(){

			\Session::flash('flash_desactivadomicro', 'desactivando microfono');
    		\Session::forget('activarMicro');
    		return redirect()->back();
	}

	public function activar_texto(){

			if(\Session::has('activarMicro')){
        		\Session::flash('flash_desactivar', 'Desactiva la opcion actual');
        		return redirect()->back();
    		}
   			\Session::put('activarText', '1');
				//dd(Session::get('activar'));
   			\Session::flash('flash_activadotext', 'Activando dictador de texto');
    			return redirect()->back();
	}

	public function desactivar_texto(){

				\Session::flash('flash_desactivadotext', 'desactivando dictador de texto');
    			\Session::forget('activarText');
    			return redirect()->back();
	}
}
