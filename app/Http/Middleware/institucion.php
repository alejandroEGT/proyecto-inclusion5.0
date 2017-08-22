<?php

namespace App\Http\Middleware;

use Closure;

class institucion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


public function handle($request, Closure $next, $guard = 'institucion')
{
    if (!\Auth::guard($guard)->check()) {
        //return redirect('/inicio');
    }
    return $next($request);
}




}
