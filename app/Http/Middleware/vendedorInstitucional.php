<?php

namespace App\Http\Middleware;

use Closure;

class vendedorInstitucional
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
        if(\Auth::check()){
            if (\Auth::user()->id_rol == 2) {
                # code...
                return $next($request);
                //dd("el vendedor esta logeado y es vendedor institucional");
            }
        }
        return redirect('inicio');
        dd("parece que no estas logeado ni eres vendedor institucional");
        //
    }
}
