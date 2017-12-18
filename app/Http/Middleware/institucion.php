<?php

namespace App\Http\Middleware;

use Closure;
//use PulkitJalan\GeoIP\GeoIP;
class institucion
{
    

public function handle($request, Closure $next, $guard = 'institucion')
{
	
		    if (!\Auth::guard($guard)->check()) {
		        return redirect('/inicio');
		    }

		    /*$geoip = new GeoIP();

			$lat = $geoip->getLatitude(); // 51.5141
			$lon = $geoip->getLongitude(); // -3.1969
			dd($geoip->getCity().', '.$geoip->getRegion().', '.$geoip->getCountry());
		   */
		   $stock = \App\Stock::where('id_institucion', \Auth::guard($guard)->user()->id)->first();
		   

		   if(count($stock)>0){


			   $verificar_producto = \App\producto::stock_minimo(\Auth::guard($guard)->user()->id, $stock->cantidad_minima);
			   
			   if(count($verificar_producto) > 0){

			   	 \Session::flash('stock', 'Tienes '.count($verificar_producto).' productos con cantidades inferiores a '.$stock->cantidad_minima.'');
			   }
		   }



		    return $next($request);

	
}




}
