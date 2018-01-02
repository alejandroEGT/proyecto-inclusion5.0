<?php

namespace App\Http\Middleware;

use Closure;

class cliente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (\Auth::check()) {
            
            if(\Auth::user()->id_rol == 4){

                if(!$request->session()->has('lastActivityTime')){
                    $request->session()->put('lastActivityTime', time());
                }

                if((time() - $request->session()->get('lastActivityTime') > 7200)){
                 
                    $request->session()->forget('lastActivityTime');
                        $id_cliente = \App\cliente::where('id_user', \Auth::user()->id)->first();
                        $carro = \App\carro::where('id_cliente',$id_cliente->id)->where('id_estado',1)->first();

                        if(is_null($carro)){
                            auth()->logout();
                        }else{
                            $carro->id_estado = 2;

                            if($carro->save()){

                                $borrar = \App\detalle_carro::where('id_carro', $carro->id)->delete();

                                if($borrar >0){
                                    auth()->logout();
                                }
                                    auth()->logout();
                            }
                        }
                }
                return $next($request);
            }
            return redirect('inicio_cliente');
        }
        return redirect()->back()->withErrors(['Porfavor ingrese a su sesión']);
    }
}
