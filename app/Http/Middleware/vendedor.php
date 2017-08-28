<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class vendedor
{
    
    public function handle($request, Closure $next)
    {
      
        if (\Auth::user()->id_rol == 1 && \Auth::check()) {
            
            return $next($request);
        }
        return redirect('inicio');
       
    }
}
