<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\producto;
use Charts;

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
}
