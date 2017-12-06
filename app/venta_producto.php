<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class venta_producto extends Model
{
     protected $table = 'venta-producto';

     protected function venta($carro, $total){
          try{

     	     $venta = new venta_producto;
               $now = new \DateTime();

     	     $venta->id_carro = $carro;
     	     $venta->fecha = $now->format('Y-m-d H:i:s');
               $venta->id_pago = 1;
               $venta->total = $total;
               $venta->id_estado = 1;

			if($venta->save()){
					return true;
			}else{
					return false;
			}

          } catch (\Illuminate\Database\QueryException $e){
                    return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
               }

     }

     protected function datosCompra($idCompra){

          $compra = \DB::table('venta-producto')
                    ->select([
                        'venta-producto.id as idVenta',
                        'venta-producto.total as total',
                        'venta-producto.id_carro as idCarro',
                        'users.email as correo'
                    ])
                    ->join('carros','carros.id','=','venta-producto.id_carro')
                    ->join('clientes','clientes.id','=','carros.id_cliente')
                    ->join('users','users.id','=','clientes.id_user')
                    ->where('venta-producto.id', $idCompra)
                    ->where('carros.id_estado',9)
                    ->first();

          return $compra;

     }

     protected function traerFecha($id_institucion)
     {
          $traer = \DB::table('venta-producto')
                    ->select('fecha')
                    ->join('carros','carros.id','=','venta-producto.id_Carro')
                    ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                    ->join('productos','productos.id','=','detalle_carros.id_producto')
                    ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                    ->where('tiendas_instituciones.id_institucion',\Auth::guard('institucion')->user()->id)
                    ->distinct()->get();
          return $traer;
     }
     protected function traerVentas_por_fecha($id_institucion, $fecha)
     {
          $traer = \DB::table('venta-producto')
                    ->select([
                           'venta-producto.fecha as fecha',
                           'venta-producto.id as id_venta',
                           'estado_ventas.nombre as nombre_estado',
                           'venta-producto.total as total'   
                    ])
                    ->join('carros','carros.id','=','venta-producto.id_Carro')
                    ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                    ->join('productos','productos.id','=','detalle_carros.id_producto')
                    ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                    ->join('estado_ventas','estado_ventas.id','=','venta-producto.id_estado')
                    ->where('venta-producto.fecha', $fecha)
                    ->where('tiendas_instituciones.id_institucion',\Auth::guard('institucion')->user()->id)
                     ->where('estado_ventas.id', 3)
                    ->distinct()->get();
          return $traer;
     }

      protected function traerVentas($id_institucion)
     {
          /*$traer = \Db::table('detalle_carros')
                    ->select([
                        'productos.nombre as nombreProducto'
                    ])
                    ->join('productos','productos.id','=','detalle_carros.id_producto')
                    ->join('carros','carros.id','=','detalle_carros.id_carro')
                    ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                    ->where('tiendas_instituciones.id_institucion', \Auth::guard('institucion')->user()->id)->get();
          dd($traer);*/

         $traer = \DB::table('venta-producto')
                    ->select([
                           'venta-producto.fecha as fecha',
                           'venta-producto.id as id_venta',
                           'estado_ventas.nombre as nombre_estado',
                           //'venta-producto.total as total'   
                    ])
                    
                    ->join('carros','carros.id','=','venta-producto.id_Carro')
                    ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                    ->join('productos','productos.id','=','detalle_carros.id_producto')
                    ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                    ->join('estado_ventas','estado_ventas.id','=','venta-producto.id_estado')
                    
                    ->where('tiendas_instituciones.id_institucion',\Auth::guard('institucion')->user()->id)
                     ->where('estado_ventas.id', 3)
                    ->distinct()->get();
          return ($traer);

     }
     protected function pruebaq($id_institucion)
     {

      $traer = \Db::table('detalle_carros')
                   
                    ->join('venta-producto','venta-producto.id_carro','=','detalle_carros.id_carro')
                    ->get();
          return $traer;
       
     }
      protected  function total($id_institucion)/*Precio total sin fecha*/
     {
          /*$traer = \DB::table('venta-producto')
                    
                    ->join('carros','carros.id','=','venta-producto.id_Carro')
                    ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                    ->join('productos','productos.id','=','detalle_carros.id_producto')
                    ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                    ->join('estado_ventas','estado_ventas.id','=','venta-producto.id_estado')
                    
                    ->where('tiendas_instituciones.id_institucion',\Auth::guard('institucion')->user()->id)
                    ->where('estado_ventas.id', 3)
                    ->distinct()->get();
         return dd($traer);*/
         $traer = \DB::table('detalle_carros')
                  ->select(\DB::raw('sum(detalle_carros.cantidad * productos.precio ) as total'))
                  ->join('productos','productos.id','=','detalle_carros.id_producto')
                  ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                  ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                  ->where('tiendas_instituciones.id_institucion', $id_institucion)
                  ->first();

         return $traer;
     }
     protected  function total_segun_fechas($id_institucion, $fecha)/*Precio total segun fecha*/
     {
          $traer = \DB::table('venta-producto')
                    
                    ->join('carros','carros.id','=','venta-producto.id_Carro')
                    ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                    ->join('productos','productos.id','=','detalle_carros.id_producto')
                    ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                    ->join('estado_ventas','estado_ventas.id','=','venta-producto.id_estado')
                    
                    ->where('tiendas_instituciones.id_institucion',\Auth::guard('institucion')->user()->id)
                    ->where('estado_ventas.id', 3)
                    ->where('venta-producto.fecha', $fecha)
                    ->distinct()->sum('venta-producto.total');
         return $traer;
     }

     protected function productos_de_venta($id_venta)
     {
         $traer = \DB::table('venta-producto')
                  ->select([
                      'productos.id as id_producto',
                      'foto_productos.foto as foto',
                      'productos.nombre as nombre',
                      'productos.precio as precio_unitario',
                      'detalle_carros.cantidad as cantidad'
                      

                  ])
                  ->join('carros', 'carros.id','=','venta-producto.id_carro')
                  ->join('pagos','pagos.id','=','venta-producto.id_pago')
                  ->join('clientes','clientes.id','=','carros.id_cliente')
                  ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                  ->join('productos','productos.id','=','detalle_carros.id_producto')
                  ->join('foto_productos','foto_productos.id_producto','productos.id')
                  ->join('users','users.id','=','clientes.id_user')
                  ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                  ->join('tiendas_instituciones','tiendas_instituciones.id','tienda_producto_instituciones.id_tienda')
                  ->where('tiendas_instituciones.id_institucion', \Auth::guard('institucion')->user()->id)
                  ->where('venta-producto.id', $id_venta)
                  

                  ->get();
          return $traer;
     }
     protected function cliente_de_venta($id_venta)
     {
         $traer = \DB::table('venta-producto')
                  ->select([
                        'users.nombres',
                        'users.apellidos',
                        'users.email',
                        'clientes.telefono',
                        'venta-producto.created_at as fecha'
                  ])
                  ->join('carros','carros.id','=','venta-producto.id_carro')
                  ->join('clientes','clientes.id','=','carros.id_cliente')
                  ->join('users','users.id','=','clientes.id_user')
                  ->where('venta-producto.id', $id_venta)
                  
                  ->first();

          return $traer;        
     }
     protected function fechas_ventas()
     {
          $traer = \DB::table('venta-producto')
                    ->select('fecha')

                    ->join('carros','carros.id','=','venta-producto.id_Carro')
                    ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                    ->join('productos','productos.id','=','detalle_carros.id_producto')
                    ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                    ->join('estado_ventas','estado_ventas.id','=','venta-producto.id_estado')
                    
                    ->where('tiendas_instituciones.id_institucion',\Auth::guard('institucion')->user()->id)
                    ->where('estado_ventas.id', 3)
                    
                    ->distinct()->get();
         return $traer;
     }

     protected function cantidad_ventas_por_fecha($fecha)
     {
           $traer = \DB::table('venta-producto')
                    
                    ->join('carros','carros.id','=','venta-producto.id_Carro')
                    ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                    ->join('productos','productos.id','=','detalle_carros.id_producto')
                    ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                    ->join('estado_ventas','estado_ventas.id','=','venta-producto.id_estado')
                    
                    ->where('tiendas_instituciones.id_institucion',\Auth::guard('institucion')->user()->id)
                    ->where('estado_ventas.id', 3)
                    ->where('venta-producto.fecha', $fecha)
                    ->distinct()->count('venta-producto.id');
         return $traer;
     }

     protected function productosVendidos($idVenta){

      $productos = \DB::table('venta-producto')
                    ->select([

                      'venta-producto.id as idVenta',
                      'productos.nombre as nombreProducto',
                      'detalle_carros.cantidad as cantidadProducto',
                      'area.nombre as nombreArea',
                      'institucion.nombre as nombreTienda',
                      'institucion.email as correoInstitucion',
                      'productos.precio as precioProducto'
                        
                    ])
                    ->join('carros','carros.id','=','venta-producto.id_carro')
                    ->join('clientes','clientes.id','=','carros.id_cliente')
                    ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                    ->join('productos','productos.id','=','detalle_carros.id_producto')
                    ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                    ->join('institucion','institucion.id','=','tiendas_instituciones.id_institucion')
                    ->join('area','area.id_institucion','=','institucion.id')
                    ->where('venta-producto.id_estado', 3)
                    ->where('venta-producto.id', $idVenta)
                    ->distinct()->get(); 


      return $productos;

     }


      protected function traerVentasCliente($id_cliente)
     {
          $traer = \DB::table('venta-producto')
                    ->select([
                           'venta-producto.fecha as fecha',
                           'venta-producto.id as id_venta',
                           'estado_ventas.nombre as nombre_estado',
                           'productos.nombre as nombreProducto',
                           'productos.precio as precioProducto',
                           'productos.descripcion as descripcionProducto',
                           'foto_productos.foto as fotoProducto',
                           'detalle_carros.cantidad as cantidadProducto',
                           'venta-producto.total as totalCompra'   
                    ])
                    
                    ->join('carros','carros.id','=','venta-producto.id_Carro')
                    ->join('detalle_carros','detalle_carros.id_carro','=','carros.id')
                    ->join('productos','productos.id','=','detalle_carros.id_producto')
                    ->join('foto_productos','foto_productos.id_producto','=','productos.id')
                    ->join('tienda_producto_instituciones','tienda_producto_instituciones.id_producto','=','productos.id')
                    ->join('tiendas_instituciones','tiendas_instituciones.id','=','tienda_producto_instituciones.id_tienda')
                    ->join('estado_ventas','estado_ventas.id','=','venta-producto.id_estado')
                    ->where('carros.id_cliente',$id_cliente)
                    ->where('carros.id_estado',10)
                    ->where('estado_ventas.id', 3)
                    ->get();
          return $traer;
     }


}
