<?php

namespace App\Http\Middleware;

use Closure;

class institucion
{
    

public function handle($request, Closure $next, $guard = 'institucion')
{
    if (!\Auth::guard($guard)->check()) {
        return redirect('/inicio');
    }
    return $next($request);
}




}
