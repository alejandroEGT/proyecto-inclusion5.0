
<!DOCTYPE html>
<html lang="en">
	<head>
	<!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Index</title>
		<link rel="stylesheet" href="InicioCliente/css.css">

	</head>
		<body>
			<!--padre-->
			<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
				<!--navegador-->
			    <div class="android-header mdl-layout__header mdl-layout__header--waterfall">
			        <div class="mdl-layout__header-row">
			          <span class="android-title mdl-layout-title">
			          	<a href="inicio_cliente"><img class="android-logo-image" src="productos/exodNegro.png"></a>
			          </span>
			          <!-- Add spacer, to align navigation to the right in desktop -->
			          <div class="android-header-spacer mdl-layout-spacer"></div>
			          <div class="android-search-box mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right mdl-textfield--full-width">
			            <label class="mdl-button mdl-js-button mdl-button--icon" for="search-field">
			              <i class="material-icons">search</i>
			            </label>
			            <div class="mdl-textfield__expandable-holder">
			              <input class="mdl-textfield__input" type="text" id="search-field">
			            </div>
			          </div>
			          <!-- Navigation -->
			          <div class="android-navigation-container">
			            <nav class="android-navigation mdl-navigation">
			              <span><a class="mdl-navigation__link mdl-typography--text-uppercase" href="#"><i class="material-icons">&#xE8CC;</i> Cesta <i class="mdl-badge mdl-badge--no-background" data-badge="3"></i></span></a>
			            </nav>
			          </div>
			          <span class="android-mobile-title mdl-layout-title">
			            <img class="android-logo-image" src="productos/exodNegro.png">
			          </span>

			          <button class="android-more-button mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect" id="more-button">
			          	<i class="material-icons">&#xE853;</i>
			          </button>
			          <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right mdl-js-ripple-effect" for="more-button">
			            <li class="mdl-menu__item" ><a href="/sesion_cliente">Iniciar Sesion</a></li>
			            <li class="mdl-menu__item"><a href="/registro_cliente">Registrate</a></li>
			          </ul>
			        </div>
			    </div>
				<!--barra lateral-->
			    <div class="android-drawer mdl-layout__drawer">
			      	<span class="mdl-layout-title">
			          <img class="android-logo-image" src="productos/exodNegro.png">
			        </span>
			        <nav class="mdl-navigation">

			          <span class="mdl-navigation__link" href="#"><i class="material-icons">&#xE853;</i> Usuario</span>
			          <a class="mdl-navigation__link" href="/sesion_cliente">Iniciar Sesión</a>
			          <a class="mdl-navigation__link" href="/registro_cliente">Registrate</a>
			          <div class="android-drawer-separator"></div>

			          <span><a class="mdl-navigation__link" href="#"><i class="material-icons">&#xE8CC;</i> Cesta <i class="mdl-badge mdl-badge--no-background" data-badge="3"></i></span></a>
			          <div class="android-drawer-separator"></div>

			          <span class="mdl-navigation__link" href="#"><i class="material-icons">&#xE867;</i> Categorias</span>
			          <a class="mdl-navigation__link" href="#">Gastronomia</a>
			          <a class="mdl-navigation__link" href="#">Artesania</a>
			          <a class="mdl-navigation__link" href="#">Estampado</a>
			          <div class="android-drawer-separator"></div>

			          <nav class="mdl-navigation">
			          <span class="mdl-navigation__link" href="#"><i class="material-icons">&#xE8CB;</i> Tiendas</span>
			          <a class="mdl-navigation__link" href="#">Unpade</a>
			          <div class="android-drawer-separator"></div>
			    </div>


				<!--cuerpo-->
				<div class="android-content mdl-layout__content">
					
					@yield('content')

					  <!--footer-->
					<footer class="mdl-mega-footer">
					  <div class="mdl-mega-footer__middle-section">

					    <div class="mdl-mega-footer__drop-down-section">
					      <input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
					      <h1 class="mdl-mega-footer__heading">Features</h1>
					      <ul class="mdl-mega-footer__link-list">
					        <li><a href="#">About</a></li>
					        <li><a href="#">Terms</a></li>
					        <li><a href="#">Partners</a></li>
					        <li><a href="#">Updates</a></li>
					      </ul>
					    </div>

					    <div class="mdl-mega-footer__drop-down-section">
					      <input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
					      <h1 class="mdl-mega-footer__heading">Details</h1>
					      <ul class="mdl-mega-footer__link-list">
					        <li><a href="#">Specs</a></li>
					        <li><a href="#">Tools</a></li>
					        <li><a href="#">Resources</a></li>
					      </ul>
					    </div>

					    <div class="mdl-mega-footer__drop-down-section">
					      <input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
					      <h1 class="mdl-mega-footer__heading">Technology</h1>
					      <ul class="mdl-mega-footer__link-list">
					        <li><a href="#">How it works</a></li>
					        <li><a href="#">Patterns</a></li>
					        <li><a href="#">Usage</a></li>
					        <li><a href="#">Products</a></li>
					        <li><a href="#">Contracts</a></li>
					      </ul>
					    </div>

					    <div class="mdl-mega-footer__drop-down-section">
					      <input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
					      <h1 class="mdl-mega-footer__heading">FAQ</h1>
					      <ul class="mdl-mega-footer__link-list">
					        <li><a href="#">Questions</a></li>
					        <li><a href="#">Answers</a></li>
					        <li><a href="#">Contact us</a></li>
					      </ul>
					    </div>

					  </div>
					</footer>
		
				</div>

			</div>
				
		</body>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://unpkg.com/popper.js@1.12.5/dist/umd/popper.js"></script>
	<script src="https://unpkg.com/bootstrap-material-design@4.0.0-beta.3/dist/js/bootstrap-material-design.js"></script>
	<script src="mdl/material.min.js"></script>
	@yield('js')
</html>





