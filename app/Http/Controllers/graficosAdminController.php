<?php

namespace App\Http\Controllers;

use App\Area;
use App\ContadorInstitucion;
use App\Tienda_institucion;
use App\User;
use App\producto;
use App\venta_producto;
use Charts;
use Illuminate\Http\Request;
use PDF;

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
      
      $array_pais;
      $pais;
      $ver_pais;
      $array_contar_por_pais;
      $ciudad;
      $final;
      $tienda_institucion = Tienda_institucion::where('id_institucion', \Auth::guard('institucion')->user()->id )->first();
      
       $contar_total  = ContadorInstitucion::where('id_tienda', $tienda_institucion->id)->sum('cantidad');

       $pais = ContadorInstitucion::where('id_tienda', $tienda_institucion->id)->distinct()->get();

       
       for ($i=0; $i < count($pais); $i++) { 

            if ($pais[$i]->codigo_pais != null) {
                $array_pais[$i] = $pais[$i]->codigo_pais;
                $array_contar_por_pais[$i] = ContadorInstitucion::where('id_tienda', $tienda_institucion->id)->where('codigo_pais', $pais[$i]->codigo_pais)->sum('cantidad');

            }
        
       }

       $codigo_pais = array_unique($array_pais);
    
       $val_codigo_pais = array_values($array_pais);
       $val_contar_x_pais = array_values($array_contar_por_pais);

       $array_paices = ContadorInstitucion::paices(\Auth::guard('institucion')->user()->id);

       
      /*$sum = 0;
       foreach ($array_paices as $c ) {
         $ciudad[$sum++] = ContadorInstitucion::ciudad(\Auth::guard('institucion')->user()->id, $c->codigo_pais);
          echo $ciudad[0][0]->ciudad.'<br>';
       }*/
       //dd(($array_paices)) ;
       
       for ($i=0; $i < count($array_paices); $i++) { 
          $ciudad[$i] = ContadorInstitucion::ciudad(\Auth::guard('institucion')->user()->id, $array_paices[$i]->codigo_pais);
          for ($u=0; $u < count($ciudad[$i]); $u++) { 
              $final[$i][$u] = ContadorInstitucion::sumar_por_ciudad(\Auth::guard('institucion')->user()->id, $ciudad[$i][$u]->ciudad);
            
          }
       }

       for ($i=0; $i < count($array_paices) ; $i++) { 
           
           $pais[$i] = ContadorInstitucion::where('codigo_pais', $array_paices[$i]->codigo_pais)->select('pais')->first();

           $ver_pais[$i] = $pais[$i]->pais;
       }
       //dd($final);


       //dd($ciudad[0][0]->ciudad);
       /*foreach ($array_paices as $pais) {
          echo $pais->codigo_pais;
       }*/
       //dd("////////");
       //dd(ContadorInstitucion::sumar_por_ciudad(\Auth::guard('institucion')->user()->id,"Santiago"));
//return $ver_pais;
      
            $chart = Charts::create('geo', 'google')
            ->Title('Mapa geográfico de vistas')
            ->ElementLabel('Vistas')
            ->Labels($val_codigo_pais)
            ->Colors(['#5DADE2','#2471A3'])
            ->Values($val_contar_x_pais)
            ->region("CL")
            ->Dimensions(600,00)
            ->Responsive(false);
    

       return view('institucion.grafico_vista_tienda')
       ->with('chart_vistas', $chart)
       ->with('detalle', $final)
       ->with('vistastotal', $contar_total);
    }

    public function descargar_grafico_venta()
    {

      $array_cantidad;
      $fecha_venta = venta_producto::fechas_ventas();

      for ($i=0; $i < count($fecha_venta); $i++) { 
           $array_fecha[$i] = $fecha_venta[$i]->fecha;
           $cantidad = venta_producto::cantidad_ventas_por_fecha($fecha_venta[$i]->fecha);
           $array_cantidad[$i] = $cantidad;

        }

      $chart = Charts::create('area', 'highcharts','fusioncharts')
            ->title('Ventas realizadas (Cantidad)')
            ->elementLabel('Cantidad de ventas')
           ->Labels($array_fecha)
            ->values($array_cantidad)
            ->dimensions(1000,500)

            ->responsive(true);

      $pdf = PDF::loadHTML(view('institucion.reporte_grafico_venta', compact(['chart'])));
         //return $pdf->download("grafico_ventas".date('d-m-Y')."pdf");
         return $pdf->stream('test.pdf');
    }














    /*public function vista_grafico_visitas_tienda(Request $dato)
    {
      $dato->flash();
      $tienda_institucion = Tienda_institucion::where('id_institucion', \Auth::guard('institucion')->user()->id )->first();
  
       $vistas =ContadorInstitucion::where('id_tienda', $tienda_institucion->id)->select('created_at')->distinct('created_at')->get();
      
       $contar  = ContadorInstitucion::where('id_tienda', $tienda_institucion->id)->sum('cantidad');
      dd($vistas);
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
    }*/
}
