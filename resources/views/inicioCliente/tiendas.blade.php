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



	<!--tienda-->
	<br><div class="android-more-section linea-gris fondo-blanco">
		@if(count($tiendasAll)>0)
		<div class="android-section-title mdl-typography--display-1-color-contrast"><i class="material-icons">&#xE867;</i> Tiendas</div>
		<div class="android-card-container mdl-grid">
		  	@foreach($tiendasAll as $tienda) 
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
	   		<hr>	
	</div>
			<center><p>{{$tiendasAll->links()}}</p></center>

			@endif
				@if (!count($tiendasAll))
						<center><h1>No existen tiendas</h1></center>
						<hr>
				@endif	

@endsection