<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta id="token" name="token" value="{{csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sesión de  {{ Auth::user()->email }}</title>
  
	<link rel="stylesheet" href="{{asset('css/css.css')}}">
    

	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
</head>

<!-- onMouseMove="stopScroll();" onmouseover="estaPulsadoShift(event);"-->
<body class="body-vendedor" onmouseover="estaPulsadoShift(event);" >
        
<div id="master-vendedorDependiente" class="animated fadeIn" >

    @if (Session::get('estado') == 2)
            @yield('esperando')
    @endif
    @if (Session::get('estado') == 1)

        <nav  class="navbar pushy pushy-left" data-focus="#first-link">
            <div class="pushy-content">
                <ul>
                    <li class="pushy-submenu" >
                        
                        <div class="min-perfil-vendedor" >            
                              <img :src="'/'+fotoPerfil" height="50" alt="" class="img-logo img img-thumbnail">
                            <p class="nombre-perfil">
                               {{ Auth::user()->nombres.' '.Auth::user()->apellidos }}
                            </p>
                            <p><a href="{{ url('userDependiente/logout') }}">Salir</a></p>
                        </div>
                        
                        <hr>
                    </li>
                     <li class="pushy-link"><a href="{{ url('userDependiente/inicio') }}"><i class="fa fa-indent" aria-hidden="true"></i> Inicio</a></li>
                    
                    <li class="pushy-link"><a href="{{ url('userDependiente/datos') }}"><i class="fa fa-database" aria-hidden="true"></i> Mis Datos</a></li>
                    <li class="pushy-link"><a href="{{ url('userDependiente/publicarProducto') }}"><i class="fa fa-cubes" aria-hidden="true"></i> Publicar productos</a></li>
                   {{-- <li class="pushy-link"><a href="{{ url('userDependiente/publicarServicio') }}">Publicar servicios</a></li>--}}
                    <li class="pushy-link"><a href="{{ url('userDependiente/traerProductoEnEspera') }}"><i class="fa fa-gavel" aria-hidden="true"></i> Productos en espera</a></li>
                    {{--<li class="pushy-link"><a href="{{ url('userDependiente/traerServicioEnEspera') }}">Servicios en espera</a></li>--}}
                    <!--<li class="pushy-submenu">
                        <button>Formularios</button>
                        <ul>
                            <li class="pushy-link"><a href="index">Inicio</a></li>
                            <li class="pushy-link"><a href="/login">Login de institución</a></li>
                            <li class="pushy-link"><a href="#">Item 3</a></li>
                        </ul>
                    </li>-->
                    <!--<li class="pushy-submenu">
                        <button>foto 3</button>
                        <ul>
                            <li class="pushy-link"><a href="foto">foto</a></li>
                            <li class="pushy-link"><a href="#">Item 2</a></li>
                            <li class="pushy-link"><a href="#">Item 3</a></li>
                        </ul>
                    </li>-->
                    <li class="pushy-submenu">
                        <button><i class="fa fa-cube"></i> Novedades</button>
                        <ul>
                            <li class="pushy-link"><a href="{{ url('userDependiente/ventas') }}">productos vendidos</a></li>
                        </ul>
                    </li>
                   
                    <!--<li class="pushy-link"><a href="#">Item 2</a></li>
                    <li class="pushy-link"><a href="#">Item 3</a></li>
                    <li class="pushy-link"><a href="#">Item 4</a></li>-->
                
                    <li class="pushy-submenu">
                        <button id="first-link">¿Te ayudamos?</button>
                        <ul>
                            @if (Session::has('activarMicro'))
                                <li class="pushy-link"><a href="{{ url('userDependiente/desactivarmicro') }}"><i class="fa fa-microphone fa-2x micro-on" aria-hidden="true"></i></a></li>
                            @endif

                            @if (empty(Session::get('activarMicro')))
                            <li class="pushy-link"><a href="{{ url('userDependiente/activarmicro') }}">
                                <i class="fa fa-microphone fa-2x micro-off" aria-hidden="true"></i>
                            </a></li>
                            @endif
                            @if (Session::has('activarText'))
                                <li class="pushy-link"><a href="{{ url('userDependiente/desactivartext') }}"><i class="fa fa-commenting fa-2x text-on" aria-hidden="true"></i></a></li>
                            @endif

                            @if (empty(Session::get('activarText')))
                           <li class="pushy-link"><a href="{{ url('userDependiente/activartext') }}">
                                <i class="fa fa-commenting fa-2x text-off" aria-hidden="true"></i></i>
                            </a></li>
                            @endif
                             <li class="pushy-link"><a href="/ayuda">Nuestra ayuda</a></li>
                        </ul>
                    </li>
                </ul> 
            </div>
        </nav>

        <!-- oscurece pantalla al deslizar menu -->
        <div class="site-overlay"></div>

        <!-- Your Content -->
        <div id="container">
            <!-- Menu Button -->
                <nav class="navbar-fixed-top color-verde">
                        <div class="row">
                            <div class="col-md-2 col-xs-2">
                                <div v-if="estadoPassword != 1"><!--contraseña sin cambiar no permite interactuar con menu-->
                                    <button class="menu-btn">&#9776; Menu</button> 
                                </div>             
                            </div>  
                           <div v-if="estadoPassword != 1">
                                <div class="col-xs-offset-1 col-xs-4 col-md-4 ">
                             @if (Session::has('activarMicro'))
                                <a href="{{ url('userDependiente/desactivarmicro') }}"><i class="fa fa-microphone fa-2x micro-on" aria-hidden="true"></i>&nbsp;</a>
                            @endif

                            @if (empty(Session::get('activarMicro')))
                           <a href="{{ url('userDependiente/activarmicro') }}">
                                <i class="fa fa-microphone fa-2x micro-off" aria-hidden="true">&nbsp;</i>
                            </a>
                            @endif
                            @if (Session::has('activarText'))
                               <a href="{{ url('userDependiente/desactivartext') }}"><i class="fa fa-commenting fa-2x text-on" aria-hidden="true"></i>&nbsp;</a>
                            @endif

                            @if (empty(Session::get('activarText')))
                           <a href="{{ url('userDependiente/activartext') }}">
                                <i class="fa fa-commenting fa-2x text-off" aria-hidden="true">&nbsp;</i></i>
                            </a>
                            @endif
                            @if (Session::get('activarDalt'))
                                <a href="{{ url('userDependiente/desactivarDalt') }}">
                                    <i class="fa fa-eye fa-2x text-off" aria-hidden="true"></i>
                                </a>
                            @endif
                             @if (empty(Session::get('activarDalt')))
                                <a href="{{ url('userDependiente/activarDalt') }}">
                                    <i class="fa fa-eye fa-2x text-off" aria-hidden="true"></i>
                                </a>
                            @endif
                            </div>
                           </div>
                            {{--<div class="col-md-4 col-xs-10">
                                <form action="{{ url('userDependiente/buscador') }}" method="get">
                                    <div class="input-group">
                                    {{ csrf_field() }}
                                        <input name="buscador" type="text" class="form-control" placeholder="buscar novedades, instituciones o personas">
                                          <span class="input-group-btn">
                                            <button class="btn btn-search" type="submit"><i class="fa fa-search fa-fw"></i></button>
                                          </span>
                                    </div>
                                </form> 
                                
                            </div>--}}
                            <div class="col-md-offset-1 col-md-4 ">
                                <div class="container-fluid" >
                                     <p class="p-right"><label onmouseover="fun_p(this)">{{Auth::user()->email}}</label></p>
                                </div>
                            </div>
                        </div>
                            
                </nav>
                
                <div class="margen">
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
        @endif 
       
    </div>    
</body>
	
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="/bootstrap/js/bootstrap.min.js" ></script>
		<script src="/js/toastr.js" ></script>
		<script src="/js/vue/vue.js" ></script>
        <script src="/js/vue/vue-resource.js"></script>
        <script src="/js/vue/vue_master_vendedorInstitucion.js"></script>
        <script src="{{asset('js/artyom.js')}}" ></script>
        @include('mensajes.activa_desactiva_alumno')
		<script src="/js/pushy.min.js"></script>
         @yield('js')

</html>