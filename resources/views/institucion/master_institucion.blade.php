
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta id="token" name="token" value="{{csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sesión de  {{ Auth::guard('institucion')->user()->email }}</title>
	<link rel="stylesheet" href="{{asset('css/css.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilo_institucion.css')}}">
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
</head>
<body onMouseMove="stopScroll();">
        
    <div id="master" >
        <nav  class="navbar pushy pushy-left" data-focus="#first-link">
            <div class="pushy-content">
                <ul>
                    <li class="pushy-submenu" >
                        
                        <div class="min-perfil-instituto" >
                            <img v-for="item in db_institucion" height="70"  :src="'/'+item.logo" alt=""/>
                            <p class="nombre-institucion-perfil" v-for="item in db_institucion">
                                @{{ item.nombre }}
                            </p>
                            <p><a href="logout"><img src="/ico/arrows.png"  alt=""/></a></p>
                        </div>
                        
                        <hr/>
                    </li>
                    <li class="pushy-submenu">
                        <button id="first-link">¿Te ayudamos?</button>
                        <ul>
                            @if (Session::has('activarMicro'))
                                <li class="pushy-link"><a href="desactivarmicro"><i class="fa fa-microphone fa-2x micro-on" aria-hidden="true"></i></a></li>
                            @endif

                            @if (empty(Session::get('activarMicro')))
                            <li class="pushy-link"><a href="activarmicro">
                                <i class="fa fa-microphone fa-2x micro-off" aria-hidden="true"></i>
                            </a></li>
                            @endif
                            @if (Session::has('activarText'))
                                <li class="pushy-link"><a href="desactivartext"><i class="fa fa-commenting fa-2x text-on" aria-hidden="true"></i></a></li>
                            @endif

                            @if (empty(Session::get('activarText')))
                           <li class="pushy-link"><a href="activartext">
                                <i class="fa fa-commenting fa-2x text-off" aria-hidden="true"></i></i>
                            </a></li>
                            @endif
                             <li class="pushy-link"><a href="/ayuda">Nuestra ayuda</a></li>
                        </ul>
                    </li>
                    <li class="pushy-submenu">
                        <button>Formularios</button>
                        <ul>
                            <li class="pushy-link"><a href="index">Inicio</a></li>
                            <li class="pushy-link"><a href="/login">Login de institución</a></li>
                            <li class="pushy-link"><a href="#">Item 3</a></li>
                        </ul>
                    </li>
                    <li class="pushy-submenu">
                        <button>Submenu 3</button>
                        <ul>
                            <li class="pushy-link"><a href="#">Item 1</a></li>
                            <li class="pushy-link"><a href="#">Item 2</a></li>
                            <li class="pushy-link"><a href="#">Item 3</a></li>
                        </ul>
                    </li>
                    <li class="pushy-submenu">
                        <button><i class="fa fa-cube"></i> Especialidad / Areas</button>
                        <ul v-for="item in db_area">
                            <li class="pushy-link"><a href="#">@{{ item.nombre}}</a></li>
                        </ul>
                    </li>
                    <li class="pushy-link"><a href="notificacio_vendedor"><i class="fa fa-globe"></i> Notificaciones <span class="badge">@{{ notificacion }}</span></a></li>
                    <li class="pushy-link"><a href="#">Item 2</a></li>
                    <li class="pushy-link"><a href="#">Item 3</a></li>
                    <li class="pushy-link"><a href="#">Item 4</a></li>
                </ul>
            </div>
        </nav>

        <!-- oscurece pantalla al deslizar menu -->
            <div class="site-overlay"></div>

        <!-- contenido -->
            <div id="container">
            <!-- Menu Button -->
                <nav class="navbar-fixed-top color-verde">
                        <div class="container-fluid" v-for="item in db_institucion" >
                            <p class="p-right">Registrado como: <strong>@{{item.email}}</strong></p>
                        </div>
                </nav>
                <div class="fx">
                	<button class="menu-btn">&#9776; Menu</button>
                </div>
    			@yield('content')

            </div>
    </div>    
</body>
	
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="/bootstrap/js/bootstrap.min.js" ></script>
		<script src="/js/toastr.js" ></script>
		<script src="/js/vue/vue.js" ></script>
        <script src="/js/vue/vue-resource.js"></script>
        <script src="/js/vue/vue_master_institucion.js"></script>
        <script src="/js/sweetalert2.js" ></script>
		<script src="/js/pushy.min.js"></script>
		@include('mensajes.activa_desactiva')      

</html>