
@extends('inicioCliente.clienteMaster')

@section('content')

	<!--Carousel-->
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
					    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					  </ol>
					  <div class="carousel-inner">
					    <div class="carousel-item active">
					      <img class="d-block w-100" src="http://ipcft.santotomas.cl/wp-content/uploads/sites/7/2016/01/gastronomia.jpg" alt="First slide">
					    </div>
					    <div class="carousel-item">
					      <img class="d-block w-100" src="http://destinonegocio.com/wp-content/uploads/2015/04/artesanias.jpg" alt="Second slide">
					    </div>
					    <div class="carousel-item">
					      <img class="d-block w-100" src="https://interiorismos.com/wp-content/2017/01/geometricos2.jpg" alt="Third slide">
					    </div>
					  </div>
					  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
				</div>
			</div>
		</div>
	</div>

	<!--recomedados-->
	<div class="android-more-section">
		<div class="android-section-title mdl-typography--display-1-color-contrast"><i class="material-icons">&#xE8D0;</i> Recomendados</div>
	  		<div class="android-card-container mdl-grid">		
			@foreach($ver_mas as $producto)	
				
					<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
						<div class="imagen-producto">
						<a class="mdl-card__media porteimg" href="/vista_productos/{{base64_encode($producto->idProducto)}}"><img src="{{ '/'.$producto->fotoProducto }}"></a>

						</div>							
						<div class="mdl-card__title"><h4 class="mdl-card__title-text">{{ $producto->nombreProducto }}</h4></div>
						<div class="mdl-card__supporting-text">
						<span class="mdl-typography--font-light mdl-typography--subhead">{{ $producto->descripcionProducto }}</span>
						</div>
					</div>
			
			@endforeach
			</div>
	</div>

	<!--tienda-->
	<div class="android-more-section">
		<div class="android-section-title mdl-typography--display-1-color-contrast"><i class="material-icons">&#xE867;</i> Tiendas</div>
		<div class="android-card-container mdl-grid">
		  	@foreach($tiendas as $tienda) 
		    <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
		      <div class="mdl-card__media porteimg"><img src="{{'/'.$tienda->logo}}"></div>
		      <div class="mdl-card__title"><h4 class="mdl-card__title-text">{{ $tienda->nombre }}</h4></div>
		      <div class="mdl-card__supporting-text">
		      <span class="mdl-typography--font-light mdl-typography--subhead">{{ $tienda->descripcion }}</span>
		      </div>
		      <div class="mdl-card__actions">
		         <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="{{ url("/perfil_institucion/".base64_encode($tienda->id)) }}">Ver Tienda<i class="material-icons">chevron_right</i></a>
		      </div>
		    </div>
	   		@endforeach
	  	</div>

	  	<div class="android-section-title mdl-typography--display-1-color-contrast"><i class="material-icons">&#xE867;</i> Vendedores</div>
		<div class="android-card-container mdl-grid">
	   		@foreach($tiendas_vendedor as $tienda) 
		    <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
		      <div class="mdl-card__media porteimg"><img src="{{'/'.$tienda->foto}}"></div>
		      <div class="mdl-card__title"><h4 class="mdl-card__title-text">{{ $tienda->nombre }}</h4></div>
		      <div class="mdl-card__supporting-text">
		      <span class="mdl-typography--font-light mdl-typography--subhead">{{ $tienda->descripcion }}</span>
		      </div>
		      <div class="mdl-card__actions">
		         <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="#">Ver Tienda<i class="material-icons">chevron_right</i></a>
		      </div>
		    </div>
	   		@endforeach
	  	</div>
	  		  
	</div>
	<img src="" alt="" style="">

	<!--calidad-->
	<div class="container-fluid">
		<div class="row piePagina">
			<div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
				<div class="piePagina text-center">
			      	<img src="productos/dinero-icono.png">
				      <div class="caption">
				        <h5>Calidad y precio</h5>
		       
				      </div>
			    </div>
			</div>

			<div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
				<div class="piePagina text-center">
			      	<img src="productos/kiphu.png">
				      <div class="caption">
				        <h5>Pagos mediante khipu</h5>
				        
				      </div>
			    </div>
			</div>


			<div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
				<div class="piePagina text-center">
			      	<img src="productos/confianza.png">
				      <div class="caption">
				        <h5>Compra con confianza</h5>
				      </div>
			    </div>
			</div>

		</div>
	</div>	
	 		

@endsection
