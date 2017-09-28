
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta id="token" name="token" value="{{csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sesión de  {{ Auth::guard('institucion')->user()->email }}</title>
	<link rel="stylesheet" href="{{asset('css/css.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilo_institucion.css')}}">
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
</head>
<body  class="body-institucion">
        
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
                    <li class="pushy-link"><a href="{{ url('institucion/inicio') }}"><i class="fa fa-indent"></i> Inicio</a></li>
                    <li class="pushy-submenu">
                        <button><i class="fa fa-database"></i> Nuestra Información</button>
                        <ul>
                            <li class="pushy-link"><a href="{{ url('institucion/misionyvision') }}">Misión y Visión</a></li>
                            <li class="pushy-link"><a href="{{ url('institucion/datos') }}">Datos específicos</a></li>
                            <li class="pushy-link"><a href="noticia">Publicar noticias</a></li>
                        </ul>
                    </li>
                    <li class="pushy-submenu">
                        <button><i class="fa fa-users"></i> Nuestro equipo</button>
                        <ul>
                            <li class="pushy-link"><a href="#">Inicio</a></li>
                            <li class="pushy-link"><a href="#">Login de institución</a></li>
                            <li class="pushy-link"><a href="#">Item 3</a></li>
                        </ul>
                    </li>
                    <!--<li class="pushy-submenu">
                        <button>Submenu 3</button>
                        <ul>
                            <li class="pushy-link"><a href="#">Item 1</a></li>
                            <li class="pushy-link"><a href="#">Item 2</a></li>
                            <li class="pushy-link"><a href="#">Item 3</a></li>
                        </ul>
                    </li>-->
                    <li class="pushy-submenu">
                        <button><i class="fa fa-cube"></i> Especialidad / Áreas</button>
                        <ul v-for="item in db_area">
                            <li class="pushy-link"><a :href="'/institucion/verArea/' + item.id">@{{ item.nombre}}</a></li>
                        </ul>
                    </li>
                    <li class="pushy-link"><a href="{{ url('institucion/notificacio_vendedor') }}"><i class="fa fa-globe"></i> 
                    Notificaciones <span class="badge">@{{ notificacion }}</span></a></li>
                     <li class="pushy-link"><a href="{{ url('institucion/generarPassword') }}"><i class="fa fa-key"></i> Generar Contraseñas</a></li>
                    <li class="pushy-link"><a href="{{ url('institucion/grafico') }}"><i class="fa fa-indent"></i> Grafico</a></li>
                     <li class="pushy-link"><a href="{{ url('institucion/my-chart') }}"><i class="fa fa-indent"></i> GraficoChart</a></li>
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
                                        <input name="buscador" type="text" class="form-control" placeholder="buscar novedades, instituciones o personas">
                                          <span class="input-group-btn">
                                            <button class="btn btn-search" type="submit"><i class="fa fa-search fa-fw"></i></button>
                                          </span>
                                    </div>
                                </form>    
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="container-fluid" v-for="item in db_institucion" >

                                     <p class="p-right">Registrado como: <strong>@{{item.email}}
                                     </strong><a href="{{ url('institucion/logout') }}"><img src="/ico/arrows.png"  alt=""/></a></p>
                                     
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
        <script src="/js/vue/vue_master_institucion.js"></script>
        <script src="/js/sweetalert2.js" ></script>
		<script src="/js/pushy.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.js" ></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js" ></script>
		{{--@include('mensajes.activa_desactiva') --}}
        @yield('js')

</html>