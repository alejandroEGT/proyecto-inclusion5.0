
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
                        
                        <div class="min-perfil-institucion" >
                            <img v-for="item in db_institucion" height="70"  :src="'/'+item.logo" alt=""/>
                            <p class="nombre-institucion-perfil" v-for="item in db_institucion">
                                @{{ item.nombre }}
                            </p>
                            <p><a href="{{ url('institucion/logout') }}"><img src="/ico/arrows.png"  alt=""/></a></p>
                        </div>
                        
                        <hr/>
                    </li>
                    <li class="pushy-link"><a href="{{ url('institucion/index') }}">Inicio</a></li>
                    <li class="pushy-submenu">
                        <button>Nuestra Información</button>
                        <ul>
                            <li class="pushy-link"><a href="{{ url('institucion/misionyvision') }}">Misión y Visión</a></li>
                            <li class="pushy-link"><a href="#">Datos específicos</a></li>
                            <li class="pushy-link"><a href="noticia">Publicar noticias</a></li>
                        </ul>
                    </li>
                    <li class="pushy-submenu">
                        <button>Nuestro equipo</button>
                        <ul>
                            <li class="pushy-link"><a href="#">Inicio</a></li>
                            <li class="pushy-link"><a href="#">Login de institución</a></li>
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
                    <li class="pushy-link"><a href="{{ url('institucion/notificacio_vendedor') }}"><i class="fa fa-globe"></i> Notificaciones <span class="badge">@{{ notificacion }}</span></a></li>
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
                        <div class="row">
                            <div class="col-md-2">
                                    <button class="menu-btn">&#9776; Menu</button>              
                            </div>  
                            <div class="col-md-4">

                                <input class="form-control"  type="text" name="" placeholder="buscar novedades, instituciones o personas" >
                            </div>
                            <div class="col-md-6">
                                <div class="container-fluid" v-for="item in db_institucion" >

                                     <p class="p-right">Registrado como: <strong>@{{item.email}}
                                     </strong><a href="logout"><img src="/ico/arrows.png"  alt=""/></a></p>
                                     
                                </div>
                            </div>
                        </div>
                            
                </nav>
                
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