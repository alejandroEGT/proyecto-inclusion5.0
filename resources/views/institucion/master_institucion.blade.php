
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta id="token" name="token" value="{{csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sesión de  {{ Auth::guard('institucion')->user()->email }}</title>
	<link rel="stylesheet" href="{{asset('css/css.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilo_institucion.css')}}">
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nuevocss.css') }}">
</head>

<body  class="body-institucion" onMouseMove="stopScroll();" onmouseover="estaPulsadoShift(event);">

   @inject('validar', "App\Http\Controllers\KhipuController")

   @if ($validar->verificarEstadoCuenta(Auth::guard('institucion')->user()->id) == false)
       <p><center><img src="{{ asset('khipu/k2.png') }}" height="180"></center></p>
       <div class="container">
           <center><p><h4 style="color:black" >Saludos, recuerda que para comenzar a publicar tus productos primero deberas realizar la activación de tu cuenta de cobro en <strong>Khipu</strong>, te llegara un correo en el cual se te cobrara $2.000 pesos por temas de verificación de tu cuenta, los cuales seran devolvidos al dia siguiente.</h4></p>
           <br>
           <p><h4 style="color:black" >Saludos cordiales del equipo <strong>"El Arte Escondido"</strong>.</h4></p>
           <br>
           <a href="{{ url('institucion/logout') }}" class="btn btn-info" >Cerrar sesión</a></center>
       </div>
   @endif
   @if ($validar->verificarEstadoCuenta(Auth::guard('institucion')->user()->id) == true)
        <div id="master">
        <nav  class="navbar pushy pushy-left" data-focus="#first-link">
            <div v-if="this.navChrome == true">
                    {{--<li class="pushy-submenu">
                        <button id="first-link">¿Te ayudamos?</button>
                        <ul>
                            @if (Session::has('activarMicro'))
                                <li class="pushy-link"><a href="{{ url('desactivarmicro') }}"><i class="fa fa-microphone fa-2x micro-on" aria-hidden="true"></i></a></li>
                            @endif

                            @if (empty(Session::get('activarMicro')))
                            <li class="pushy-link"><a href="{{ url('activarmicro') }}">
                                <i class="fa fa-microphone fa-2x micro-off" aria-hidden="true"></i>
                            </a></li>
                            @endif
                            @if (Session::has('activarText'))
                                <li class="pushy-link"><a href="{{ url('desactivartext') }}"><i class="fa fa-commenting fa-2x text-on" aria-hidden="true"></i></a></li>
                            @endif

                            @if (empty(Session::get('activarText')))
                           <li class="pushy-link"><a href="{{ url('activartext') }}">
                                <i class="fa fa-commenting fa-2x text-off" aria-hidden="true"></i></i>
                            </a></li>
                            @endif
                             <li class="pushy-link"><a href="/ayuda">Nuestra ayuda</a></li>
                        </ul>
                    </li>--}}
            </div>
            <div class="pushy-content">
                <ul>
                    <li class="pushy-submenu" >
                        
                        <div class="min-perfil-institucion" >
                            <img v-for="item in db_institucion" :src="'/'+item.logo" alt="" class="img-logo img img-thumbnail"/>
                            <p class="nombre-institucion-perfil" v-for="item in db_institucion">
                                @{{ item.nombre }}
                            </p>
                            <p><a href="{{ url('institucion/logout') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Salir</a></p>
                        </div>
                        
                        <hr/>
                    </li>
                    <li class="pushy-link"><a href="{{ url('institucion/inicio') }}"><i class="fa fa-indent"></i> Inicio</a></li>
                    <li class="pushy-submenu">
                        <button id="ni"><i class="fa fa-database"></i> Nuestra Información <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                        <ul>
                            <li class="pushy-link"><a href="{{ url('institucion/misionyvision') }}">Misión y Visión</a></li>
                            <li class="pushy-link"><a href="{{ url('institucion/datos') }}">Datos específicos</a></li>
                            <li class="pushy-link"><a href="{{ url('institucion/noticia') }}">Publicar noticias</a></li>
                        </ul>
                    </li>
                     <li class="pushy-submenu">
                        <button id="oc"><i class="fa fa-database"></i> Ocultos <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                        <ul>
                            <li class="pushy-link"><a href="{{ url('institucion/productosOcultos') }}"> Productos Ocultos</a></li>
                            {{--<li class="pushy-link"><a href="{{ url('institucion/serviciosOcultos') }}"><i class="fa fa-indent"></i> Servicios Ocultos</a></li>--}}
                        </ul>
                    </li>
                    
                    <li class="pushy-submenu">
                        <button><i class="fa fa-cube"></i> Especialidad / Áreas <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                        <ul v-for="item in db_area">
                            <li class="pushy-link"><a :href="'/institucion/verArea/' + item.id">@{{ item.nombre}}</a></li>
                        </ul>
                    </li>
                   
                    <li class="pushy-link"><a href="{{ url('institucion/notificacio_vendedor') }}"><i class="fa fa-globe"></i> 
                    Solicitud de ingreso de alumnos <span class="badge">@{{ notificacion }}</span></a></li>
                     <li class="pushy-link"><a href="{{ url('institucion/traerProductoEnEspera') }}"><i class="fa fa-globe"></i> 
                    Solicitud de ingreso de productos <span class="badge">@{{ notificacion_prod }}</span></a>
                    </li>
                     {{--<li class="pushy-link"><a href="{{ url('institucion/traerServicioEnEspera') }}"><i class="fa fa-globe"></i> 
                    Solicitud de ingreso de servicios <span class="badge">@{{ notificacion_serv }}</span></a>
                    </li>--}}

                      <li class="pushy-submenu">
                        <button><i class="fa fa-key"></i> Generar contraseñas <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                        <ul>
                            <li class="pushy-link"><a href="{{ url('institucion/generarPassword') }}"> Alumnos</a></li>
                            <li class="pushy-link"><a href="{{ url('institucion/generarPasswordEncargado') }}"> Encargados</a></li>
                            
                        </ul>
                    </li>
                    <li class="pushy-submenu">
                        <button><i class="fa fa-bar-chart"></i> Gráficos <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                        <ul>
                            <li class="pushy-link" ><a href="{{ url('institucion/verVentas') }}">Ventas</a></li>
                            <li class="pushy-link"><a href="{{ url('institucion/grafico_productosAdmin') }}"> Cantidad de productos</a></li>
                            <li class="pushy-link"><a href="{{ url('institucion/my-chart') }}"> Cantidad de personas</a></li>
                            <li class="pushy-link">
                                <a  href="{{ url('institucion/ver_vistas_tienda') }}">Vistas en mi tienda</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="pushy-submenu" >
                        <button>Opciones <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                        <ul>
                            <li class="pushy-link"><a href="{{ url('institucion/stock_minimo') }}">Stock minimo</a></li>
                        </ul>
                    </li>
                    
                  
                    
                   <!-- <li class="pushy-link"><a href="#">Item 2</a></li>
                    <li class="pushy-link"><a href="#">Item 3</a></li>
                    <li class="pushy-link"><a href="#">Item 4</a></li>-->
                </ul>
            </div>
        </nav>

        <!-- oscurece pantalla al deslizar menu -->
            <div class="site-overlay"></div>

        <!-- contenido -->

            <div id="container">
            <!-- Menu Button -->
                <nav class="navbar-fixed-top color-verde">
                        <div class="row">
                            <div class="col-md-1 col-xs-2">
                                    <button class="menu-btn">&#9776; Menú</button>              
                            </div>  
                            <div class="col-md-4 col-xs-offset-1 col-xs-8">
                                <form action="{{ url('institucion/buscador') }}" method="get">
                                    <div class="input-group">
                                    {{ csrf_field() }}
                                        <input name="buscador" type="text" class="form-control" placeholder="buscar instituciones o personas">
                                          <span class="input-group-btn">
                                            <button class="btn btn-search" type="submit"><i class="fa fa-search fa-fw"></i></button>
                                          </span>
                                    </div>
                                </form>    
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="container-fluid" v-for="item in db_institucion" >

                                     <p class="p-right"><strong>@{{item.email}}
                                     </strong><a href="{{ url('institucion/logout') }}"><i class="fa fa-sign-in fa-2x" aria-hidden="true"></i></a></p>
                                     
                                </div>
                            </div>
                        </div>
                            
                </nav>
                <div class="margen">
                @if (Session::has('venta'))
                <div class="alert alert-danger">
                <a href="" class="close" data-dismiss="alert">&times;</a>
                       <center> <i class="fa fa-info-circle" aria-hidden="true"></i> {{ Session::get('venta') }}</center>
                </div>
            @endif
                    <noscript>
                        <div class="alert alert-danger">
                <a href="" class="close" data-dismiss="alert">&times;</a>
                       <center> <i class="fa fa-info-circle" aria-hidden="true"></i> 
                            <h5>Este sitio requiere de javascript, porfavor activarlo</h5>
                       </center>
                   </div>
                    
                    </noscript>
                    @yield('content')

               </div>
            </div>
    </div>   
  @endif
    
</body>
	
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="/bootstrap/js/bootstrap.min.js" ></script>
		
		<script src="{{ asset('js/vue/vue.js') }}" ></script>
        <script src="{{ asset('js/vue/vue-resource.js') }}"></script>
        <script src="{{ asset('js/toastr.js')}}" ></script>
        <script src="{{asset('js/artyom.js')}}" ></script>
        <script src="{{ asset('js/vue/vue_master_institucion.js') }}"></script>
       <!-- <script src="/js/sweetalert2.js" ></script>-->
		<script src="/js/pushy.min.js"></script>
       <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.js" ></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js" ></script>-->
		@include('mensajes.activa_desactiva_institucion')
        @yield('js')

</html>