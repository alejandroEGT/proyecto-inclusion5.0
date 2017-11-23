<?php

namespace App\Http\Middleware;

use Closure;


class md_vendedor
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
    
        if (\Auth::user()->id_rol == 1 && \Auth::check()) {
            
            return $next($request);
        }
        return redirect('inicio');
       
    }
}
