<?php

namespace App\Http\Controllers;
use App\Area;
use App\ContadorInstitucion;
use App\Fotoperfil;
use App\Http\Requests\clienteRequest;
use App\Http\Requests\resetClaveCliente;
use App\Http\Requests\resetpasswordRequest;
use App\Institucion;
use App\Listadeseos;
use App\Sexo;
use App\Tienda_institucion;
use App\Tienda_vendedor;
use App\User;
use App\carro;
use App\cliente;
use App\foto_producto;
use App\noticia;
use App\producto;
use App\reset_password;
use App\servicio;
use App\venta_producto;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PulkitJalan\GeoIP\GeoIP;


class clienteController extends Controller
{

    //Esta funcion verifica si el usuario que se encuentra con su session iniciada pertenesca a los clientes
    public function verificarUser(){

        if(Auth::user() && Auth::user()->id_rol!=4){
            Auth::logout();
        }
    }

    //Esta funcion redirecciona al inicio del cliente donde se muestran productos, tiendas, noticias
    public function inicio_cliente(){
      try{
  

      $tiendas = Tienda_institucion::traerTiendas();
      $tiendas_vendedor = Tienda_vendedor::traerTiendas();
      //dd($tiendas);
      $ver_producto = producto::ver_producto();
      $ver_servicio = servicio::ver_servicio();
      $noticias = noticia::noticias_generales_cliente();
     //dd($noticias);

      $this->verificarUser();
      return view('inicioCliente.inicio_cliente')
      ->with([
        'ver_producto' => $ver_producto,
        'tiendas_vendedor' => $tiendas_vendedor,
        'ver_servicio' => $ver_servicio,
        'tiendas' => $tiendas,
        'noticias' => $noticias
      ]);
       } catch (\Exception $e) {
    return redirect()->back();
             
          } 

    }
    //Esta funcion mostraba anteriormente el producto seleccionado
     public function vista_productos($id){
         try{


          $this->verificarUser();  
          $tiendas = Tienda_institucion::traerTiendas();
          $getId = base64_decode($id);
        $producto = producto::producto_id($getId);
        return view('inicioCliente.vista_productos')->with(['producto' => $producto, 'tiendas' => $tiendas]);
                       } catch (\Exception $e) {
    return redirect()->back();
             
          }                                  
    }  

    //Esta funcion redirecciona a la lista de deseos del cliente
    public function vista_lista_deseos()
    {
        try{

        

       //$lista = Listadeseos::where('id_user', \Auth::user()->id)->get();

      $tiendas = Tienda_institucion::traerTiendas();
      $lista = Listadeseos::traer(\Auth::user()->id);
       return view('inicioCliente.lista_deseos')->with(['lista' => $lista, 'tiendas' => $tiendas]);
                              } catch (\Exception $e) {
    return redirect()->back();
             
          }

    }

    //Esta funcion guarda un producto en la lista de deseos del cliente
    public function guardar_en_lista_deseo(Request $dato)
    {
      $id_prod = base64_decode($dato->idProducto);

      $agregar = Listadeseos::agregar(\Auth::user()->id, $id_prod);

      if ($agregar) {
        
        return redirect()->back()->withErrors(['producto agregado a favoritos']);
      }
      return redirect()->back()->withErrors(['Producto ya listado']);
    }

    //Esta funcion redireccionaba a una extencion del inicio_cliente
    public function ver_mas_producto(){
          try{

      $this->verificarUser();
      $ver_mas = producto::ver_mas_producto();
      $ver_mas_ser = servicio::ver_servicio_mas();
       $tiendas = Tienda_institucion::traerTiendas();
       $tiendas_vendedor = Tienda_vendedor::traerTiendas();
      return view ('inicioCliente.inicio_cliente_mas')->with('ver_mas',$ver_mas)
                                                      ->with('ver_mas_ser',$ver_mas_ser)
                                                      ->with('tiendas_vendedor',$tiendas_vendedor)
                                                      ->with('tiendas',$tiendas);
                                                                                    } catch (\Exception $e) {
    return redirect()->back();
             
          }
    }

    //Esta funcion redirecciona a la vista donde se muestran todos los productos de las instituciones
    public function productos_clientes(){
      try{

       $productos = producto::ver_mas_producto(8);
       $tiendas = Tienda_institucion::traerTiendas();

       return view ('inicioCliente.productos')->with('productos',$productos)
                                              ->with('tiendas',$tiendas);
      } catch (\Exception $e) {
    return redirect()->back();
             
          }
    }

    //Esta funcion redirecciona a la vista donde se muestran todos las noticias de las instituciones
     public function noticias_clientes(){
      try{
   
       $noticias = noticia::noticias_generales_cliente_all(8);
       $tiendas = Tienda_institucion::traerTiendas();

       return view ('inicioCliente.noticias')->with('noticias',$noticias)
                                              ->with('tiendas',$tiendas);
           } catch (\Exception $e) {
    return redirect()->back();
             
          }
    }

    //Esta funcion redirecciona a la vista de una noticia en especifico
     public function verDetalleNoticia(Request $dato)
    {  
       try{
         
          $tiendas = Tienda_institucion::traerTiendas(); 
        $noticia = noticia::verDetalleNoticiaCliente(base64_decode($dato->idNoticia));
        //dd($noticia);
        return view('inicioCliente.verDetalleNoticia')->with('noticia', $noticia)
                                                      ->with('tiendas',$tiendas);
      } catch (\Exception $e) {
    return redirect()->back();
             
          }
    }
        //Esta funcion muestra todas las tiendas/instituciones 
         public function tiendas_clientes(){
          try{
    
       $tiendasAll = Tienda_institucion::traerTiendasAll(4);
       $tiendas = Tienda_institucion::traerTiendas();

       return view ('inicioCliente.tiendas')->with('tiendasAll',$tiendasAll)
                                              ->with('tiendas',$tiendas);
      } catch (\Exception $e) {
    return redirect()->back();
             
          }
    }

    //Esta funcion redirecciona al perfil del cliente en el cual, el cliente puede modificador sus datos
    public function perfil_cliente(){
      try{

      $tiendas = Tienda_institucion::traerTiendas();
      $id_cliente = cliente::where('id_user', Auth::user()->id)->first();

      $foto = Fotoperfil::traerFotobyid(Auth::user()->id);

      return view('inicioCliente.perfil_cliente')->with('id_cliente',$id_cliente)
                                                 ->with('foto', $foto)
                                                  ->with('tiendas', $tiendas);
  } catch (\Exception $e) {
    return redirect()->back();
             
          }  

    }     

    //Esta funcion redirecciona a las compras que el cliente a realizado
    public function mis_compras(Request $dato){
     try{
     
      $paginator = 2;
      $tiendas = Tienda_institucion::traerTiendas();
      $id_cliente = cliente::where('id_user', Auth::user()->id)->first();
      $array_idVenta = venta_producto::idVentaCliente($paginator);


      
      $arrayVenta;     

      for ($i=0; $i < count($array_idVenta) ; $i++) { 
       $arrayVenta[$i] = venta_producto::TraerProductosVentaCliente($id_cliente->id, $array_idVenta[$i]->idVenta); 
      }


          return view('inicioCliente.mis_compras')->with([
                'tiendas' => $tiendas,
                'idVenta' => $array_idVenta,
                'arrayVenta' => $arrayVenta

        ]);  


 } catch (\Exception $e) {
    return redirect()->back();
             
          }
  }

  //Esta funcion redirecciona a la vista donde el cliente puede identificarse
	public function sesion_cliente(){
    $this->verificarUser();
    $tiendas = Tienda_institucion::traerTiendas();
    	return view('inicioCliente.sesion_cliente')->with('tiendas', $tiendas);
    }

    //Esta funcion redirecciona a la vista donde el cliente puede registrarse
    public function registro_cliente(){
      $this->verificarUser();
    	$tiendas = Tienda_institucion::traerTiendas();
      $sexo = Sexo::all();
      

      return view('inicioCliente.registro_cliente')->with(['sexo' => $sexo, 'tiendas' => $tiendas]);


    }

        public function prueba_cliente()
    {
      $this->verificarUser();
     
        $ver_producto = producto::ver_producto();
        return view('inicioCliente.prueba')->with('ver_producto',$ver_producto);


    }

      //Esta funcion registra un cliente, creando asi un usuario, cliente, foto de perfil temporal
       public function guardar_cliente(Request $datos){

      try{

        $this->validate($datos,[
          'nombres' => 'required',
          'apellidos' => 'required',
          'telefono' => 'required',
          'correo' => 'required | email',
          'pass' => 'required | min:6',
          'repPass' => 'required | min:6 | same:pass'
       ]);



   		  $user = User::insertarCliente($datos,1);
        $idUser  = User::where('email', $datos->correo)->first();
        $cliente = cliente::guardarCliente($datos, $idUser);
          if($cliente){
              $foto = Fotoperfil::fotoDefault($idUser->id);
              //$carro = carro::crearCarro($idUser);

            \Session::flash('Advertencia', 'Registro exitosamente');
             return redirect()->back();

          }else{
            \Session::flash('Advertencia', 'Lo sentimos, a ocurrido un error en el registro, intentelo nuevamente');
             return redirect()->back();
                }

      } catch (\Illuminate\Database\QueryException $e){
      return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }
          }

              
              

  

    //Esta funcion permite al cliente actualizar su correo personal con el cual se registro
    public function updCorreo (clienteRequest $datos){

      try{
        $cliente = cliente::where('id_user', \Auth::user()->id)->first();

        if($cliente->facebook_id != null){
          \Session::flash('Advertencia', 'tu correo electronico no puede ser actualizado porque iniciaste la sesion con redes sociales');
                    return redirect()->back();
        }

       $update = cliente::updCorreo($datos);

       if($update){
         \Session::flash('Advertencia', 'Tu correo ha sido actualizado exitosamente');
                    return redirect()->back();
       }else{
         \Session::flash('Advertencia', 'Lo sentimos no se pudo realizar la operación');
                    return redirect()->back();
       }
     } catch (\Illuminate\Database\QueryException $e){
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }

    }

    //Esta funcion permite al cliente actualizar su n° telefonico personal con el cual se registro
    public function updTelefono (Request $datos){

    try{
        $this->validate($datos,[
          'telefono' => 'required | numeric | min:9',
          'repetirTelefono' => 'required |  numeric | min:9 | same:telefono'
       ]);
        $update = cliente::updTelefono($datos);

       if($update){
         \Session::flash('Advertencia', 'Tu numero de telefono ha sido actualizado exitosamente');
                    return redirect()->back();
       }else{
            \Session::flash('Advertencia', 'Lo sentimos no se pudo realizar la operación');
                    return redirect()->back();
       }
     } catch (\Illuminate\Database\QueryException $e){
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }

    }
    //Esta funcion permite al cliente actualizar su contraseña con el cual se registro
    public function updClave (Request $datos){

    try{
        $cliente = cliente::where('id_user', \Auth::user()->id)->first();
  
     
       $this->validate($datos,[
          'passAntigua' => 'required | min:6 | max:50 ',
          'passNueva' => 'required | min:6 | max:50',
          'repPassNueva' => 'required | min:6 | max:50 | same:passNueva'
       ]);

       $update = cliente::updClave($datos);

        if($update){
         \Session::flash('Advertencia', 'Tu contraseña ha sido actualizado exitosamente');
          return redirect()->back();
       }
          return redirect()->back()->withErrors(['No es posible actualizar tu contraseña']);

    } catch (\Illuminate\Database\QueryException $e){
          return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
          }

    }

    //Esta funcion permite buscar productos desde el buscador 
    public function filtrarProducto(Request $datos){

    try{
      $this->verificarUser();

      $this->validate($datos,[
                'buscador' => 'required',
          ]);
      $productos = producto::filtrar_desde_cliente($datos->buscador);
      $servicios = servicio::filtrar_desde_cliente($datos->buscador);

$tiendas = Tienda_institucion::traerTiendas();


      return view('inicioCliente.nuestroProducto')
      ->with('productos', $productos)
      ->with('titulo', "Filtrado de productos")
      ->with('servicios', $servicios)

      ->with('titulo', "Filtrado de servicios")

      ->with('tiendas', $tiendas);


    } catch (\Illuminate\Database\QueryException $e){
        return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        }
    }


//Esta funcion permite ver el detalle en especifico de un producto
public function ver_detalleProducto(Request $dato) {
 try{
 

      $this->verificarUser();
      $tiendas = Tienda_institucion::traerTiendas();
      $getId = base64_decode($dato->id);



      if($getId == null){

        return redirect()->back();

      }else{

      $productos = producto::detalleProducto_cliente($getId);


      if($productos == null){

           return redirect()->back();

      }else{

        $cantidad = 4;

      $ver_producto = producto::ver_productos_tienda($productos->idTienda, $cantidad);

      return view('inicioCliente.verDetalleProducto')
      ->with('ver_producto',$ver_producto)
      ->with('productos', $productos)
      ->with('tiendas', $tiendas);
      }

      }
      } catch (\Exception $e) {
    return redirect()->back();
             
          }


 }

 //Esta funcion permitia ver el detalle de un servicio proporcionado por la institucion
public function ver_detalleServicio(Request  $dato)
{
    $getIds = base64_decode($dato->idS);
    $getIdi = base64_decode($dato->idI);


$tiendas = Tienda_institucion::traerTiendas();
    $servicios = servicio::detalleServicio($getIds, $getIdi);

    return view('inicioCliente.verDetalleServicio')->with([
        'servicios' => $servicios,
        'tiendas' => $tiendas

    ]);
}

    //Esta funcion permite visualizar a la tienda/institucion con su informacion, productos, areas
     public function vista_perfilInst(request $dato){

       
        try{
           //////////////////aqui un contador de visitas ////////////////
            
            //dd($dato->ip());
            //prueba de contador de visitas ////
            //dd($dato->cookies);
            //dd(request()->cookie('laravel_session'));
              $geoip = new GeoIP();
              $idI = base64_decode($dato->idinstitucion);
              $tienda_institucion = Tienda_institucion::where('id_institucion', $idI)->first();
              $contadorTiendaInst = new ContadorInstitucion;

              $contadorTienda = ContadorInstitucion::where('id_tienda', $tienda_institucion->id)
                                ->where('laravel_session', $dato->ip())->first();
                     
              $tiendas = Tienda_institucion::traerTiendas();

              if($contadorTienda == true){ /*El usuario si ha visitado el perfil*/


                if(date('d-m-Y')  !=  date('d-m-Y', strtotime($contadorTienda->updated_at) )){
          

                    $contadorTienda->cantidad++;
                    $contadorTienda->save();

                  }

            

              }
             
              else{ 

              /*o si no*/   
              
                $contadorTiendaInst->id_tienda = $tienda_institucion->id;
                $contadorTiendaInst->laravel_session = $dato->ip(); 
                $contadorTiendaInst->cantidad++;
                $contadorTiendaInst->ciudad = $geoip->getCity();
                $contadorTiendaInst->region = $geoip->getRegion();
                $contadorTiendaInst->pais= $geoip->getCountry();
                $contadorTiendaInst->codigo_pais = $geoip->getCountryCode();
                $contadorTiendaInst->save();

              }
              

            ////////fin de prueba //////////////

              $idI = base64_decode($dato->idinstitucion);
              $institucion = Institucion::find($idI);
              $productos = producto::verProductosVisibles($institucion->id, 8);

              $areas = Area::where('id_institucion', $idI)->get();
              //$alumnos = User::where('id_institucion', $idI)->get();
              $servicios = servicio::mostrarServicioDesdeAdmin($institucion->id, 5);

              return view('inicioCliente.perfil_institucion')
              ->with('institucion', $institucion)
              ->with('servicios', $servicios)
              ->with('productos', $productos)
              ->with('idInstitucion', $dato->idinstitucion)
              ->with('areas', $areas)
              //->with('alumnos',$alumnos)
              ->with('tiendas', $tiendas);
         } catch (\Illuminate\Database\QueryException $e){
            return redirect()->back();
          }catch(\Exception $e){
            return redirect()->back();

          }

  }

    //Esta funcion permite actualizar la foto de perfil del cliente
    public function updFoto(Request $dato)
    {


       $this->validate($dato,[
                    'foto' => 'required|mimes:jpeg,bmp,png,gif|dimensions:max_width=5500,max_height=5500',
              ]);

      $update= Fotoperfil::actualizar_foto($dato);

      if($update > 0){
        \Session::flash('Advertencia', 'Tu foto de perfil ha sido actualizado exitosamente');
                  return redirect()->back();
      }
      return redirect()->back()->withErrors(['No es posible actualizar tu foto de perfil']);
    }


    //Esta funcion borra un producto de la lista de deseos del cliente
    public function eliminarProductoLista(Request $dato)
    {
       $id_producto = base64_decode($dato->id);

       $eliminar = Listadeseos::where('id_producto', $id_producto)
                   ->where('id_user', \Auth::user()->id)->first();

        if($eliminar->delete()){
          \Session::flash('exito', 'Producto quitado');
          return redirect()->back();
        }
        return redirect()->back()->withErrors(['Error al quitar producto']);
    }

    //Recuperar contraseña Cliente

    //Esta funcion genera un codigo el cual permitira al cliente recuperar su contraseña
    public function genclave(){
      $cadena_base = '0123456789' ;
      $password = '';
      $limite = strlen($cadena_base) - 1;
 
      for ($i=0; $i < 4; $i++)
        $password .= $cadena_base[rand(0, $limite)];
        return $password;
    } 

    //Esta funcion redirecciona a la vista donde el cliente puede solicitar su codigo  para recuperar su contraseña
    public function recuperarContrasena(){
      $tiendas = Tienda_institucion::traerTiendas();
      return view('inicioCliente.recuperarContrasena')->with('tiendas',$tiendas);
    }

    //Esta funcion redirecciona a la vista donde el cliente ingresara su codigo y nueva contraseña 
    public function ingresoCodigo(){
      $tiendas = Tienda_institucion::traerTiendas();
      return view('inicioCliente.ingresoCodigo')->with('tiendas',$tiendas);
    }

    //Esta funcion envia el codigo generado al correo del cliente que la solicita
    public function resetPass(Request $dato)
    {
        
       $this->validate($dato,['correo' => 'required | max:80 |email | exists:users,email']);
             
             $genclave = $this->genclave();
          
             $insertar = reset_password::insertar($dato, $genclave);
             if ($insertar) {
                  $correo = $dato->correo;
                    \Session::put('clave',$genclave);
                    Mail::send(['html'=>'emails.reset_pass'],['name','Alejandro'],function ($message) use ($correo)
                                        {
                                          $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
                                          $message->to($correo,'to');
                    });
                    \Session::flash('ingreso', 'El codigo fue enviado a '.$dato->correo);
                    return redirect('/ingresoCodigo');
             }
             return redirect()->back();
    }

    //Esta funcion restaura la contraseña del cliente con la nueva que el cliente ingresa
    public function resetPassGo(resetClaveCliente $datos)
    {
        try{

            $verificarToken = reset_password::where('email', $datos->correo)
                            ->where('token', $datos->codigo)->first();

            if ($verificarToken == true) {
                
                $inst = User::where('email', $datos->correo)->first();
                $inst->password = \Hash::make($datos->clave);
                if ($inst->save()) {
                    
                    $borrarToken = \DB::table('password_resets')->where('email', '=', $datos->correo)->where('token','=', $datos->codigo)->delete();

                    if ($borrarToken == true ) {

                        $correo = $datos->correo;
                        Mail::send(['html'=>'emails.reset_pass_ok'],['name','Alejandro'],function ($message) use ($correo)
                                        {
                                          $message->from('nada@gmail.com', 'Equipo de "El Arte Escondido."');
                                          $message->to($correo,'to');
                        });

                         \Session::flash('ingresado', 'La clave fue reestablecida con exito');
                         return redirect()->back();
                    }
                    return redirect()->back()->withErrors(['Error, imposible de ejercer la operación']);

                }
                return redirect()->back()->withErrors(['Error, imposible de ejercer la operación']);

            }
            return redirect()->back()->withErrors(['El código es incorrecto']);


        }catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['Algo no anda bien en los campos, posible grandes cantidades de caracteres ingresados']);
        } 
        
    }





}
