
@extends('inicioCliente.clienteMaster')

@section('content')

	@if ($errors->all())
			    <div class="alert alert-danger">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li class="validacionRequest"><label>{{ $error }}</label></li>
				            @endforeach
				        </ul>
			    </div>
			@endif
	<div class="container-fluid">
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
					      <img class="d-block w-100" src="https://ipcft.santotomas.cl/wp-content/uploads/sites/7/2016/01/gastronomia.jpg" alt="First slide">
					    </div>
					    <div class="carousel-item">
					      <img class="d-block w-100" src="https://assets.diarioconcepcion.cl/2017/06/Ley-de-Inclusio%CC%81n-Laboral-Concepcio%CC%81n-e1497240718298.jpg" alt="Second slide">
					    </div>

					    <div class="carousel-item">
					      <img class="d-block w-100" src="https://www.teleton.cl/wp-content/uploads/2017/04/inclusion975-790x495.jpg" alt="thirst slide">
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

	<!--productos-->
	<br><div class="android-more-section linea-gris fondo-blanco ">
		<div class="android-section-title mdl-typography--display-1-color-contrast"><i class="material-icons">&#xE8D0;</i> Productos</div>
	  		<div class="android-card-container mdl-grid">		
				@foreach($ver_producto as $producto)	
					
						<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
							<div class="imagen-producto">

							<a class="mdl-card__media porteimg" href="{{ url("/verDetalleProducto/".base64_encode($producto->idProducto)) }}"><img src="{{ '/'.$producto->fotoProducto }}"></a>

							</div>	
							<div class="mdl-card__title">
								<span class="mdl-typography--font-light mdl-typography--subhead lbl-precio ">
									$ {{ $producto->precioProducto }}
								</span>
							</div>						
							<div class="mdl-card__title"><h4 class="mdl-card__title-text">{{ $producto->nombreProducto }}</h4>
							</div>
						
							{{--<div class="mdl-card__supporting-text">
							<span class="mdl-typography--font-light mdl-typography--subhead">{{ $producto->descripcionProducto }}</span>
							</div>--}}

						</div>

				@endforeach
			
			</div>
			<hr>	
			<center><a href="/inicio_cliente_mas">Ver Mas</a></center><hr>
	</div>

	<!--servicios-->
	<br><div class="android-more-section linea-gris fondo-blanco">
		<div class="android-section-title mdl-typography--display-1-color-contrast"><i class="material-icons">&#xE8D0;</i> Servicios</div>
	  		<div class="android-card-container mdl-grid">		
			@foreach($ver_servicio as $servicio)	
				
					<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
						<div class="imagen-producto">



						<a class="mdl-card__media porteimg" href="{{ url('/detalleServicio/'.base64_encode($servicio->idServicio).'/'.base64_encode($servicio->idInstitucion)) }}"><img src="{{ '/'.$servicio->fotoServicio }}"></a>

						</div>							
						<div class="mdl-card__title"><h4 class="mdl-card__title-text">{{ $servicio->nombreServicio }}</h4></div>
						{{--<div class="mdl-card__supporting-text">
						<span class="mdl-typography--font-light mdl-typography--subhead">{{ $servicio->descripcionServicio }}</span>
						</div>--}}
					</div>

			@endforeach
			
			</div>
			<hr>	
			<center><a href="/inicio_cliente_mas">Ver Mas</a></center><hr>
	</div>




	<!--tienda-->
	<br><div class="android-more-section linea-gris fondo-blanco">

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
		         <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="{{ url("/perfil_institucion/".base64_encode($tienda->id))}}">Ver Tienda<i class="material-icons">chevron_right</i></a>
		      </div>
		    </div>
	   		@endforeach
	   	</div>
	</div> 	
		<!--<div class="android-section-title mdl-typography--display-1-color-contrast"><i class="material-icons">&#xE867;</i> Vendedores</div>
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
	  	</div>-->	 

		<!--noticias-->
		<br><div class="android-more-section linea-gris fondo-blanco">
				@if(count($noticias)>0)
		<div class="android-section-title mdl-typography--display-1-color-contrast"><i class="material-icons">&#xE867;</i> Noticias</div>
		<div class="android-card-container mdl-grid">
					@foreach ($noticias as $ng)
						<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
						<div class="mdl-card__media porteimg"><img class="img-notix"  src="{{ '/'.$ng->foto }}" alt="foto de noticia"></div>
						<div class="mdl-card__title"><h4 class="mdl-card__title-text">{{ $ng->titulo}}</h4></div>
						<div class="mdl-card__supporting-text">
		      				<span class="mdl-typography--font-light mdl-typography--subhead">por definir</span>
		      			</div>
						 <div class="mdl-card__actions">
		         			<a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="{{ url('institucion/detalleNoticia_general/'.base64_encode($ng->id)) }}">Ver Noticia<i class="material-icons">chevron_right</i></a>
		      			</div>
		      		</div>
					@endforeach
					</div>
					<hr><center><a href="{{ url('institucion/verNoticiasGenerales') }}">Ver todas las noticias...</a></center><hr>
			</div><br>
				@endif
				@if (!count($noticias))
						<p><label>No existen noticias</label></p>
						<hr>
				@endif	
			
	<!--calidad-->
	<div class="container-fluid">
		<div class="row piePagina">
			<div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
				<div class="piePagina text-center">
			      	<img src="productos/dinero-icono.png">
				      <div class="caption"><hr>
				        <h5>Calidad y precio</h5><hr>
		       
				      </div>
			    </div>
			</div>

			<div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
				<div class="piePagina text-center">
			      	<img src="productos/kiphu.png">
				      <div class="caption"><hr>
				        <h5>Pagos por khipu</h5><hr>
				        
				      </div>
			    </div>
			</div>


			<div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
				<div class="piePagina text-center">
			      	<img src="productos/confianza.png">
				      <div class="caption"><hr>
				        <h5>Compra con confianza</h5><hr>
				      </div>
			    </div>
			</div>

		</div>
	</div>	
	 		

@endsection
