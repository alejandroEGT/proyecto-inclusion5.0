<?php

namespace App\Http\Controllers;

use App\Area;
use App\ContadorInstitucion;
use App\Tienda_institucion;
use App\User;
use App\producto;
use Charts;
use Illuminate\Http\Request;

class graficosAdminController extends Controller
{
    public function graficochart(Request $dato){
          
          $array;
          $contar;
      $areas = Area::traer();
          for ($i=0; $i < count($areas) ; $i++) { 
            $contarAlumnos = Area::contarAlumnosPorArea($areas[$i]->id);
            $array[$i] = $areas[$i]->nombre;
            $contar[$i] = $contarAlumnos;
          }

          //return $array;
          //return $contar;
            $chart = Charts::create($dato->tipo, 'highcharts')
            ->title('Personas (Cantidad)')
            ->elementLabel('Cantidad de personas')
           ->Labels($array)
            ->values($contar)
            ->dimensions(1000,500)
            ->responsive(true);
         /*Charts::create('pie', 'highcharts')
            ->Title('My nice chart')
            ->Labels($array)
            ->Values($contar)
            ->ElementLabel("Cantidad de personas")
            ->yAxisTitle("Personas")
           
            ->Dimensions(1000,1000)
            ->Responsive(true);*/

        //return view('frontend.user.dashboard',['chart'=>$chart]);
        return view('institucion.graficochart',['chart' => $chart]);

    }

    public function grafico_productosAdmin(Request $dato)
    {
    	 $array;
          $contar;
      	  $areas = Area::traer();
          for ($i=0; $i < count($areas) ; $i++) { 
            $contarProductos = producto::traerProductosByArea($areas[$i]->id);
            $contarTodoProducto = producto::traerTodosProductosByAdmin(\Auth::guard('institucion')->user()->id);
            $array[$i] = $areas[$i]->nombre;
            $contar[$i] = $contarProductos;
          }

          //return $array;
          //return $contar;
            $chart_productos = Charts::create($dato->tipo, 'highcharts')
            ->title('Productos por área o especialidad (Cantidad)')
            ->elementLabel('Cantidad de productos')
           ->Labels($array)
            ->values($contar)
            ->dimensions(1000,500)

            ->responsive(true);


            return view('institucion.grafico_cantidad_productos', [
              'chart_productos' => $chart_productos,
              'contarTodoProducto' => $contarTodoProducto
            ]);
    }

    public function vista_grafico_visitas_tienda(Request $dato)
    {
      $dato->flash();
      $tienda_institucion = Tienda_institucion::where('id_institucion', \Auth::guard('institucion')->user()->id )->first();
  
       $vistas =ContadorInstitucion::find(39);
       $contar  = ContadorInstitucion::where('id_tienda', $tienda_institucion->id)->sum('cantidad');
      //dd($vistas);
      $chart = Charts::database( $vistas, $dato->tipo, 'highcharts')
      ->title('Cronología de visitas de la institución')
      ->elementLabel("Vistas")
      ->values('panchito')
      ->Dimensions(1000, 500)
      ->Responsive(false)
       ->groupByDay($dato->mes, $dato->anio);

       return view('institucion.grafico_vista_tienda')
       ->with('chart_vistas', $chart)
       ->with('vistastotal', $contar);
    }
}
