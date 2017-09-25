<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta id="token" name="token" value="{{csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
</head>
<body onMouseMove="stopScroll();" onmouseover="estaPulsadoShift(event);">
        <!-- Pushy Menu -->
    <div id="master_invitado">    
        <nav  class="navbar pushy pushy-left" data-focus="#first-link">

            <div class="pushy-content">
                <ul>
                    <li>
                        <label style="color: white; margin-left:4px; font-size: 10px" >@{{nombreNav}}</label>
                    </li>
                    <li class="pushy-link"><a href="/inicio">Inicio</a></li>
                    <li class="pushy-submenu">
                        <button> <i class="fa fa-floppy-o"></i> Registros</button>
                        <ul>
                            <li class="pushy-link"><a href="/ver_usuarios">Registros de usuarios</a></li>
                            <li class="pushy-link"><a href="/formInstitucion">Registro de institución</a></li>
                        </ul>
                    </li>
                    <li class="pushy-submenu">
                        <button><i class="fa fa-sign-in"></i> Login</button>
                        <ul>
                            <li class="pushy-link"><a href="/login_institucion">Institución</a></li>
                            <li class="pushy-link"><a href="/login_encargado">Encargado de área</a></li>
                            <li class="pushy-link"><a href="/login_vendedorInst">Vendedor institucional</a></li>
                            <li class="pushy-link"><a href="/login_vendedor">Vendedor Individual</a></li>
                        </ul>
                    </li>
                    <li class="pushy-submenu">
                        <button>Submenu 4</button>
                        <ul>
                            <li class="pushy-link"><a href="#">Item 1</a></li>
                            <li class="pushy-link"><a href="#">Item 2</a></li>
                            <li class="pushy-link"><a href="#">Item 3</a></li>
                        </ul>
                    </li>
                    <li class="pushy-link"><a href="#">Item 1</a></li>
                    <li class="pushy-link"><a href="#">Item 2</a></li>
                    <li class="pushy-link"><a href="#">Item 3</a></li>
                    <li class="pushy-link"><a href="#">Item 4</a></li>
                </ul>
            </div>
            <div v-if="this.navChrome == true">
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
                            <li class="pushy-link"><a><input @click="clickLupa" type="checkbox"> Lupa</a></li>
                             <li class="pushy-link"><a href="/ayuda">Nuestra ayuda</a></li>
                        </ul>
                    </li>
            </div>
        </nav>

        <!-- oscurece pantalla al deslizar menu -->
        <div class="site-overlay"></div>

        <!-- Your Content -->
        <div id="container">
            <!-- Menu Button -->
            <div class="fx">
            	<button id="menu-btn" class="menu-btn">&#9776; Menú</button>
            </div>
			@yield('content')
        </div>
    </div>    
</body>
	
		<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js" ></script>
		<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" ></script>
        @yield('js')
		<script src="{{ asset('js/toastr.js')}}" ></script>
		<script src="{{asset('js/artyom.js')}}" ></script>
        <script src="/js/invitado/funciones.js"></script>
        <script src="/js/vue/vue.js" ></script>
        <script src="/js/vue/vue-resource.js"></script>
        <script src="/js/vue/invitado_institucion.js"></script>

		<script src="{{ asset('js/pushy.min.js') }}"></script>
		@include('mensajes.activa_desactiva_invitado')
</html>


