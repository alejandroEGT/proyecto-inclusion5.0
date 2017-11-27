@extends('inicioCliente.clienteMaster')
@section('content')

<!--Carousel-->
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
					      <img class="d-block w-100" src="https://destinonegocio.com/wp-content/uploads/2015/04/artesanias.jpg" alt="Second slide">
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
		<div class="android-section-title mdl-typography--display-1-color-contrast"><i class="material-icons">&#xE8D0;</i> Productos de Instituciones</div>
			<p>hay {{ $productos->total() }} productos</p>
	  		<div class="android-card-container mdl-grid">		
			@foreach($productos as $producto)	
				
					<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
						<div class="imagen-producto">

						<a class="mdl-card__media porteimg" href="{{ url("/verDetalleProducto/".base64_encode($producto->idProducto)) }}"><img src="{{ '/'.$producto->fotoProducto }}"></a>

						</div>							
						<div class="mdl-card__title"><h4 class="mdl-card__title-text">{{ $producto->nombreProducto }}</h4></div>
						<div class="mdl-card__supporting-text">
						<span class="mdl-typography--font-light mdl-typography--subhead">{{ $producto->descripcionProducto }}</span>
						</div>
					</div>
				
			@endforeach

			</div>
			<hr>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="{{$productos->previousPageUrl()}}">Anterior</a>
    </li>
@foreach($productos as $producto)
    <li class="page-item"><a class="page-link" href=""></a></li>
    @endforeach

    <li class="page-item">
      <a class="page-link" href="{{$productos->nextPageUrl()}}">Siguiente</a>
    </li>
  </ul>
</nav>

	</div>


@endsection