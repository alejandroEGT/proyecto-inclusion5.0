
<!DOCTYPE html>
<html lang="en">
	<head>

	<!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta id="token" name="token" value="{{csrf_token() }}">

		<title>Index</title>
		<link rel="stylesheet" href="{{asset('inicioCliente/css.css')}}">

		
	</head>
		<body>

				<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

		      		<div class="android-header mdl-layout__header mdl-layout__header--waterfall">
		        		<div class="mdl-layout__header-row">

					        <span class="android-title mdl-layout-title col-md-3">
					            <a href="/inicio_cliente"><img class="android-logo-image" src="/productos/exodNegro.png"></a>
					        </span>
				          	<!--lupa de prueba-->
							<div class="col-md-6">
								<form action="{{ url('/filtrarProducto') }}" method="get"><br>
									{{csrf_field()}}							

									    <div class="input-group">
									      <input name="buscador" type="text" class="form-control caja_lupa" placeholder="Buscar productos, servicios...">
									      <span class="input-group-btn">
									        <button class="btn btn-search bmd-btn-fab" type="submit"><i class="material-icons">search</i></button>
									      </span>
									    </div>
							  	</form>
							</div>
							
					        <!-- Add spacer, to align navigation to the right in desktop -->
					        <div class="android-header-spacer mdl-layout-spacer"></div>

				          	<!-- Navigation -->
					    	<div class="android-navigation-container col-md-3">
					            <nav class="android-navigation mdl-navigation">
					              	<span>

					              		<a class="mdl-navigation__link mdl-typography--text-uppercase" href="#">
					              			<i class="material-icons">&#xE87E;</i> Lista de deseos 

					              		<a class="mdl-navigation__link mdl-typography--text-uppercase" href="{{ url('carro/miCarro') }}">
					              			<i class="material-icons">&#xE87E;</i> Carro

					              			<span class="mdl-badge mdl-badge--no-background" data-badge="2"></span>
					              		</a>
					              	</span>
					            </nav>
					        </div>

					        <button class="android-more-button mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect" id="more-button">
					        	<i class="material-icons">&#xE853;</i>
					        </button>

					        <!--autentificacion cliente-->
					        <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right mdl-js-ripple-effect" for="more-button">
					          	@if (Auth::guest())
		                            <li class="mdl-menu__item" ><a href="{{ url('sesion_cliente')}}">Iniciar Sesion</a></li>
					            	<li class="mdl-menu__item"><a href="{{ url('registro_cliente')}}">Registrate</a></li>
		                        @else
			                        <li class="mdl-menu__item" ><a href="">{{ Auth::user()->nombres }}</a></li>
			                        <div class="android-drawer-separator"></div>
			                        <li class="mdl-menu__item" ><a href="{{ url('cliente/perfil_cliente') }}">Mi perfil</a></li>
						            <li class="mdl-menu__item" ><a href="{{ url('cliente/logoutCliente') }}">Logout</a></li>
					        </ul>
					         	@endif

						</div>
			        </div>
				   
					<!--barra lateral-->
				    <div class="android-drawer mdl-layout__drawer">
				      	<span class="mdl-layout-title">
				          <a href="/inicio_cliente"><img class="android-logo-image" src="/productos/exodNegro.png"></a>
				        </span>
				        <nav class="mdl-navigation">
				          <span class="mdl-navigation__link" href="#"><i class="material-icons">&#xE853;</i> Usuario</span>
		    		      @if (Auth::guest())
				          <a class="mdl-navigation__link" href="{{ url('sesion_cliente')}}">Iniciar Sesión</a>
				          <a class="mdl-navigation__link" href="{{ url('registro_cliente')}}">Registrate</a>
					      @else
	                      <a class="mdl-navigation__link" href="">{{ Auth::user()->nombres }}</a>

	                      <a class="mdl-navigation__link" href="{{ url('cliente/perfil_cliente')}}">Mi perfil</a>
				          <a class="mdl-navigation__link" href="{{ url('cliente/logoutCliente')}}">Logout <i class="material-icons">exit_to_app</i></a>
					      @endif
				          <div class="android-drawer-separator"></div>
				          <span>
			          	  <a class="mdl-navigation__link" href="#">


			          	  <i class="material-icons">&#xE87E;</i>Lista de deseos 

			          	  <i class="material-icons">&#xE87E;</i>Carro

			          	  <i class="mdl-badge" data-badge="3"></i>
			          	  </a>
				          </span>
				          <div class="android-drawer-separator"></div>
				          <span class="mdl-navigation__link" href="#"><i class="material-icons">&#xE867;</i> Categorias</span>
				          <a class="mdl-navigation__link" href="#">Gastronomia</a>
				          <a class="mdl-navigation__link" href="#">Artesania</a>
				          <a class="mdl-navigation__link" href="#">Estampado</a>
				          <div class="android-drawer-separator"></div>
				          <span class="mdl-navigation__link" href="#"><i class="material-icons">&#xE8CB;</i> Tiendas</span>
				          <a class="mdl-navigation__link" href="#">Unpade</a>
				          <div class="android-drawer-separator"></div>
				        </nav>  
				    </div>

					<!--cuerpo-->
					<div class="android-content mdl-layout__content margen"  id="cliente">
						@yield('content')		
						
						<!--<footer><p>&copy; 2017 Exod.cl<p></footer>-->
					</div>
				</div>



								
		


			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
			</script>
			<script src="https://unpkg.com/popper.js@1.12.5/dist/umd/popper.js" integrity="sha384-KlVcf2tswD0JOTQnzU4uwqXcbAy57PvV48YUiLjqpk/MJ2wExQhg9tuozn5A1iVw" crossorigin="anonymous">
			</script>
			<script src="{{asset('../bdm/js/bootstrap-material-design.js')}}"></script>
			<script src="{{asset('mdl/material.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-1.7.1.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('js/jquery.flexisel.js')}}"></script>
			<script src="{{asset('js/slider_productos.js')}}"></script>
			<script src="/js/vue/vue.js" ></script>
        	<script src="/js/vue/vue-resource.js"></script>
			<script src="/js/vue/vue_cliente_carro.js"></script>
			@yield('js')


		</body>

</html>





