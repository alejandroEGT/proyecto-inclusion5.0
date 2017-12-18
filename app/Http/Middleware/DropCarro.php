<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;

class DropCarro
{

    protected $session;
    protected $timeout = 60;

    public function __construct(Store $session){
        $this->session = $session;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

       dd($request);
    }
}
