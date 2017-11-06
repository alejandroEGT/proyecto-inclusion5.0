<?php

namespace App\Http\Controllers;

use App\Fotoperfil;
use App\Http\Requests\FormUsuarioRequest;
use App\Tienda_producto_vendedor;
use App\Tienda_servicio_vendedor;
use App\Tienda_vendedor;
use App\User;
use App\Vendedor;
use App\categoria_producto;
use App\categoria_servicio;
use App\foto_producto;
use App\foto_servicio;
use App\producto;
use App\servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class vendedorIndependienteController extends Controller
{
    public function vista_inicio()
    {
        $foto = Fotoperfil::traerFoto();
    	return view('vendedorIndependiente.inicio')->with('foto', $foto);
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
        return redirect()->back();
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
        $categoria_serv = categoria_servicio::all();
        $vendedor = Vendedor::where('id_user',\Auth::user()->id)->first();
        $servicio = Tienda_servicio_vendedor::mostrar_servicios_vendedor($vendedor->id);

        return view('vendedorIndependiente.ingresar_servicios')
              ->with('servicio', $servicio)
              ->with('categoria_serv', $categoria_serv);
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

    public function publicarServicio(Request $datos)
      {
       
       try{

               $insertServicio = servicio::insertar($datos);

               if ($insertServicio > 0) {
                //dd($insertProducto);
                   
                   $insertFotoServicio = foto_servicio::insertar($datos, $insertServicio);
                   // dd($insertFotoProducto);


                   if ($insertFotoServicio > 0) {
                        $vendedor = Vendedor::where('id_user',\Auth::user()->id)->first();
                        $tienda = Tienda_vendedor::where('id_vendedor',$vendedor->id)->first();/*Modifique aqui hoy*/
                        $insertTiendaServicio = Tienda_servicio_vendedor::insertar($insertServicio, $tienda->id, '1');


                       
                       if ($insertTiendaServicio > 0) {
                           \Session::flash('registro', 'servicio registrado correctamente');
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


       public function eliminar_servicio_vendedor(Request $dato)
      {

        $getFoto = foto_servicio::where('id_servicio',$dato->idServicio)->get();
        \File::delete($getFoto[0]->foto);/*ELIMINAR FOTO*/
        
        $foto_prod = foto_servicio::borrar($getFoto[0]->id);
        $tienda_prod_ven = Tienda_servicio_vendedor::borrar($dato->idServicio);
        return redirect()->back();
    }
}


