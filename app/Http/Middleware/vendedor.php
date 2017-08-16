<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class vendedor
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
            # code...
            return $next($request);
            //return redirect('userIndependiente/index');
            //dd("el vendedor esta logeado y es vendedor");
        }
        return redirect('inicio');
        //dd("parece que no estas logeado ni eres vendedor");
        //return $next($request);
    }
}
