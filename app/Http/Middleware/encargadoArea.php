<?php

namespace App\Http\Middleware;

use Closure;

class encargadoArea
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
            
            if(\Auth::user()->id_rol == 3){
                return $next($request);
            }
            return redirect('inicio');
        }
        return redirect('inicio');
    }
}
