@extends('inicioCliente.clienteMaster')
@section('content')
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

	

	<!--recomedados-->
	<br><div class="android-more-section linea-gris fondo-blanco">
		@if(count($productos)>0)
		<div class="android-section-title mdl-typography--display-1-color-contrast"><i class="material-icons">&#xE8D0;</i> Productos de Instituciones</div>
	  		<div class="android-card-container mdl-grid">		
			@foreach($productos as $producto)	
				
					<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
						<div class="imagen-producto">

						<a class="mdl-card__media porteimg" href="{{ url("/verDetalleProducto/".base64_encode($producto->idProducto)) }}"><img src="{{ '/'.$producto->fotoProducto }}"></a>
						</div>
						<div class="mdl-card__title"><h4 class="lbl-precio"> $ {{ number_format($producto->precioProducto, 0, ',', '.') }} CLP</h4></div> 
						<div class="mdl-card__title"><h4 class="mdl-card__title-text">{{ str_limit($producto->nombreProducto,20) }}</h4></div>
						<div class="mdl-card__supporting-text">
						<span class="mdl-typography--font-light mdl-typography--subhead">{{ str_limit($producto->descripcionProducto,20) }}</span>
						</div>
						<div class="mdl-card__actions">
		         			<a class="btn btn-raised btn-success" href="{{ url("/verDetalleProducto/".base64_encode($producto->idProducto)) }}">Ver</a>
		      				</div>
					</div>

				
			@endforeach

			</div>
			<br><div class="separacion-compras"><img src="/ico/separar.png"></div>
			<center><p>{{$productos->links()}}</p></center>
			</div>


@endif
				@if (!count($productos))
						<center><h1>No existen productos</h1></center>
						<hr>
				@endif	

	


@endsection