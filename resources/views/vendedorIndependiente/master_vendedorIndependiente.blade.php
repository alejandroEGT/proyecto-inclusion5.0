<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta id="token" name="token" value="{{csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sesión de  {{ Auth::user()->email }}</title>
	<link rel="stylesheet" href="{{asset('css/css.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilo_vendedor.css')}}">

	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
</head>

<body onMouseMove="stopScroll();" onmouseover="estaPulsadoShift(event);">
        
<div id="master-vendedorIndependiente" class="animated fadeIn" >

        <nav  class="navbar pushy pushy-left" data-focus="#first-link">
            <div class="pushy-content">
                <ul>
                    <li class="pushy-submenu" >
                        
                        <div class="min-perfil-vendedor" >            
                              <img :src="'/'+fotoPerfil" height="50" alt="">
                            <p class="nombre-perfil">
                               {{ Auth::user()->nombres.' '.Auth::user()->apellidos }}
                            </p>
                            <p><a href="{{ url('userIndependiente/logout') }}"><img src="/ico/arrows.png"  alt=""></a></p>
                        </div>
                        
                        <hr>
                    </li>
                    <li class="pushy-submenu">
                        <button id="first-link">¿Te ayudamos?</button>
                        <ul>
                            @if (Session::has('activarMicro'))
                                <li class="pushy-link"><a href="/desactivarmicro"><i class="fa fa-microphone fa-2x micro-on" aria-hidden="true"></i></a></li>
                            @endif

                            @if (empty(Session::get('activarMicro')))
                            <li class="pushy-link"><a href="/activarmicro">
                                <i class="fa fa-microphone fa-2x micro-off" aria-hidden="true"></i>
                            </a></li>
                            @endif
                            @if (Session::has('activarText'))
                                <li class="pushy-link"><a href="/desactivartext"><i class="fa fa-commenting fa-2x text-on" aria-hidden="true"></i></a></li>
                            @endif

                            @if (empty(Session::get('activarText')))
                           <li class="pushy-link"><a href="/activartext">
                                <i class="fa fa-commenting fa-2x text-off" aria-hidden="true"></i></i>
                            </a></li>
                            @endif
                             <li class="pushy-link"><a href="/ayuda">Nuestra ayuda</a></li>
                        </ul>
                    </li>
                    <li class="pushy-link"><a href="#">Mis Datos</a></li>
                    <li class="pushy-submenu">
                        <button>Formularios</button>
                        <ul>
                            <li class="pushy-link"><a href="index">Inicio</a></li>
                            <li class="pushy-link"><a href="/login">Login de institución</a></li>
                            <li class="pushy-link"><a href="#">Item 3</a></li>
                        </ul>
                    </li>
                    <li class="pushy-submenu">
                        <button>foto 3</button>
                        <ul>
                            <li class="pushy-link"><a href="foto">foto</a></li>
                            <li class="pushy-link"><a href="#">Item 2</a></li>
                            <li class="pushy-link"><a href="#">Item 3</a></li>
                        </ul>
                    </li>
                    <li class="pushy-submenu">
                        <button><i class="fa fa-cube"></i> Especialidad / Areas</button>
                        <ul>
                            <li class="pushy-link"><a href="#"><!--Aqui nombe--></a></li>
                        </ul>
                    </li>
                    <li class="pushy-link"><a href="#"><i class="fa fa-globe"></i> Notificaciones</a></li>
                    <li class="pushy-link"><a href="#">Item 2</a></li>
                    <li class="pushy-link"><a href="#">Item 3</a></li>
                    <li class="pushy-link"><a href="#">Item 4</a></li>
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
                                    <button class="menu-btn">&#9776; Menu</button>              
                            </div>  
                            <div class="col-md-4 col-xs-10">

                                 <form action="{{ url('userIndependiente/buscador') }}" method="get">
                                    <div class="input-group">
                                    {{ csrf_field() }}
                                        <input name="buscador" type="text" class="form-control" placeholder="buscar novedades, instituciones o personas">
                                          <span class="input-group-btn">
                                            <button class="btn btn-search" type="submit"><i class="fa fa-search fa-fw"></i></button>
                                          </span>
                                    </div>
                                </form> 
                            </div>
                            <div class="col-md-6">
                                <div class="container-fluid" >
                                     <p class="p-right"><label onmouseover="fun_p(this)">Registrado como: {{Auth::user()->email}}</label></p>
                                </div>
                            </div>
                        </div>
                            
                </nav>
                
               <div class="margen">
                    @yield('content')

               </div>
            </div>
       
    </div>    
</body>
	
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="/bootstrap/js/bootstrap.min.js" ></script>
		<script src="/js/toastr.js" ></script>
		<script src="/js/vue/vue.js" ></script>
        <script src="/js/vue/vue-resource.js"></script>
        <script src="/js/vue/vue_master-vendedorIndependiente.js"></script>
        @include('mensajes.activa_desactiva')
		<script src="/js/pushy.min.js"></script>

</html>