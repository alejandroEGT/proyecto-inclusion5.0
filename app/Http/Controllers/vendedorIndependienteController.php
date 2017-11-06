<?php

namespace App\Http\Controllers;

use App\Fotoperfil;
use App\Http\Requests\FormUsuarioRequest;
use App\Tienda_producto_vendedor;
use App\Tienda_vendedor;
use App\User;
use App\Vendedor;
use App\categoria_producto;
use App\estado_tienda_producto;
use App\foto_producto;
use App\producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class vendedorIndependienteController extends Controller
{
    public function vista_inicio()
    {   
        $vendedor = Vendedor::where('id_user', \Auth::user()->id)->first();
        $foto = Fotoperfil::traerFoto();
        $productos = producto::traerproductoVendedor($vendedor->id, 4);
    	return view('vendedorIndependiente.inicio')
      ->with([
        'foto' => $foto,
        'productos' => $productos
      ]);
    }
    public function vista_cambiarFoto(){
        return view('vendedorIndependiente.cambiarFoto');
    }

     public function insertar_vendedorIndependiente(FormUsuarioRequest $datos)
    {
        /*try{*/
            $insert = User::insertar_vendedor($datos);
            if ($insert) {
               
                $id_user = User::where('email','=',"$datos->correo")->get();
                    
                $vendedor = Vendedor::insertar_aprobado($datos, $id_user[0]->id);
                if ($vendedor) {

                        $foto = Fotoperfil::fotoDefault($id_user[0]->id);
                        if ($foto) {
                            $getVendedor = Vendedor::where('id_user', $id_user[0]->id)->first();
                             $insertarTiendaVendedor = Tienda_vendedor::insertar($getVendedor->id);
                             if ($insertarTiendaVendedor) {
                                 \Session::flash('ingresado', 'Usuario registrado con exito');
                                 return redirect()->back();
                             }
                        }
                        $datos->flash();
                }        
            }
            $datos->flash();

       /* } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
          } */
    }
     public function traerFotoVendedor(){

        $dato = Fotoperfil::traerFoto();
        return $dato;
    }
    public function guardar_foto(Request $dato)
    {   
         $this->validate($dato, ['fotoP' => 'required']);
        $guardar = Fotoperfil::guardar($dato);
         \Session::flash('cambio', 'Foto cambiada');
        return redirect('userIndependiente/mis_datos');
    }


       public function mis_datos()
    {


        $foto = Fotoperfil::traerFotobyid(Auth::user()->id);
        return view('vendedorIndependiente.mis_datos')->with('foto', $foto);
                                                     
    }

    public function ingresar_productos()
    {
            
            $categoria_pro = categoria_producto::all();
            $vendedor = Vendedor::where('id_user',\Auth::user()->id)->first();
            $productos = Tienda_producto_vendedor::mostrar_productos_vendedor($vendedor->id);


            return view('vendedorIndependiente.ingresar_productos')
                ->with('productos', $productos)
                ->with('categoria_pro', $categoria_pro);

        
    }


      public function ingresar_servicios()
    {
        return view('vendedorIndependiente.ingresar_servicios');
    }

       public function modificar_productos()
    {
        return view('vendedorIndependiente.modificar_productos');
    }

         public function modificar_servicios()
    {
        return view('vendedorIndependiente.modificar_servicios');
    }

   
      public function publicarproducto(Request $datos)
      {
       
       try{

               $insertProducto = producto::insertar($datos);

               if ($insertProducto > 0) {
                //dd($insertProducto);
                   
                   $insertFotoProducto = foto_producto::insertar($datos, $insertProducto);
                   // dd($insertFotoProducto);


                   if ($insertFotoProducto > 0) {
                        $vendedor = Vendedor::where('id_user',\Auth::user()->id)->first();
                        $tienda = Tienda_vendedor::where('id_vendedor',$vendedor->id)->first();/*Modifique aqui hoy*/
                        $insertTiendaProducto = Tienda_producto_vendedor::insertar($insertProducto, $tienda->id, '1');


                       
                       if ($insertTiendaProducto > 0) {
                           \Session::flash(' ', 'Producto registrado correctamente');
                           return redirect()->back();
                       }
                       return "Mal todo";
                   }
                   return redirect()->back()->withErrors(['Algo salió mal']);
                }

            } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
            }
      }
      public function eliminar_producto_vendedor(Request $dato)
      {

        $getFoto = foto_producto::where('id_producto',$dato->idProducto)->get();
        //return $getFoto[0]->foto;
        //dd($getFoto[0]->foto);
        \File::delete($getFoto[0]->foto);/*ELIMINAR FOTO*/
        
        $foto_prod = foto_producto::borrar($getFoto[0]->id);
        $tienda_prod_ven = Tienda_producto_vendedor::borrar($dato->idProducto);
        //$prod_insti = producto::borrar($dato->idProducto);

        return redirect()->back();
    }
    public function ver_detalleProducto(Request $dato)
    {
      $getId = base64_decode($dato->id);
      $categoria = categoria_producto::all();
      $estadoP = estado_tienda_producto::limit(2)->get();
      //$area = Area::traerArea();
      $vendedor = Vendedor::idVendedor(\Auth::user()->id);
      //dd($vendedor[0]->id);
      $productos = producto::verDetalleProducto($getId, $vendedor[0]->id);
      
      return view('vendedorIndependiente.verDetalleProducto')
      ->with('productos', $productos)
      ->with('categoria', $categoria)
      ->with('estadoP', $estadoP);
    }

    public function actualizar_producto_foto(Request $dato)
    {
      try{
          $this->validate($dato,[
                    'foto' => 'required|mimes:jpeg,bmp,png,gif|dimensions:max_width=5500,max_height=5500',
              ]);
          //dd($dato->idProducto);
          $actualizar = foto_producto::actualizar_foto($dato);
          if ($actualizar > 0) {
              \Session::flash('correcto', 'Foto actualizada correctamente');
              return redirect()->back();
          }
          return redirect()->back();

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }
    }
     public function actualizar_producto_nombre(Request $dato)
    {
        try{
               $this->validate($dato,[
                    'nombre' => 'required | max:50',
              ]);
              $nombre = producto::actualizar_nombre($dato);
              if ($nombre) {
                \Session::flash('correcto', 'Nombre actualizado correctamente');
                return redirect()->back();
              }
              return redirect()->back();
       } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }
    }
    public function actualizar_producto_descripcion(Request $dato)
    {
      try{
            $this->validate($dato,[
                    'descripcion' => 'required | max:250',
              ]);
              $desc = producto::actualizar_descripcion($dato);
              if ($desc) {
                \Session::flash('correcto', 'Descripcion actualizada correctamente');
                return redirect()->back();
              }
              return redirect()->back();
       } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }
    }
     public function actualizar_producto_cantidad(Request $dato)
     {
      try{
            $this->validate($dato,[
                  'cantidad' => 'required | numeric',
            ]);
            $cant = producto::actualizar_cantidad($dato);
            if ($cant) {
              \Session::flash('correcto', 'Cantidad actualizada correctamente');
              return redirect()->back();
            }
            return redirect()->back();

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }     

    }
     public function actualizar_producto_visibilidad(Request $dato)
    {
      try{
               $this->validate($dato,[
                    'estadoV' => 'required',
              ]);

              $visibi = Tienda_producto_vendedor::actualizar_visibilidad($dato);
              if ($visibi) {
                return redirect()->back();
              }
              return redirect()->back();

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }       

    }
    public function actualizar_producto_categoria(Request $dato)
    {
      try{
            $this->validate($dato,[
                    'categoria' => 'required',
              ]);

            $categ = producto::actualizar_categoria($dato);
              if ($categ) {
                
                return redirect()->back();
              }
              return redirect()->back();

      } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }    

    }
     public function actualizar_producto_precio(Request $dato)
    {
        try{
             $this->validate($dato,[
                  'precio' => 'required | numeric',
            ]);
            $cant = producto::actualizar_precio($dato);
            if ($cant) {
              \Session::flash('correcto', 'Precio actualizado correctamente');
              return redirect()->back();
            }
            return redirect()->back();

       } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
       }

    }

}


