@extends('inicioCliente.clienteMaster')

@section('content')
	<div id="sfc1tpp2wnu56rs8py9h757hq8haz6jncpx"></div><script type="text/javascript" src="https://counter8.freecounter.ovh/private/counter.js?c=1tpp2wnu56rs8py9h757hq8haz6jncpx&down=async" async></script><noscript><a href="https://www.contadorvisitasgratis.com" title="contador de entradas"><img src="https://counter8.freecounter.ovh/private/contadorvisitasgratis.php?c=1tpp2wnu56rs8py9h757hq8haz6jncpx" border="0" title="contador de entradas" alt="contador de entradas"></a></noscript><a href="https://www.contadorvisitasgratis.com" title="contador de entradas"><img src="https://counter8.freecounter.ovh/private/contadorvisitasgratis.php?c=1tpp2wnu56rs8py9h757hq8haz6jncpx" border="0" title="contador de entradas" alt="contador de entradas"></a>
	<div class="container-fluid">
	<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
		<div class="row">

			<div class="col-md-3 fondo-blanco lineas-border">
				<br>
				<center><img src="{{ '/'.$institucion->logo }}" class="img img-thumbnail tamanio-inst" >
					<hr>
					<p><strong class="nombreblue" ><i class="fa fa-user" aria-hidden="true"></i> {{$institucion->nombre}}</strong></p>
					<p><strong class="correo" ><i class="fa fa-envelope" aria-hidden="true"></i> {{$institucion->email}}</strong></p>
					<p><strong class="numero" ><label><i class="fa fa-phone" aria-hidden="true"></i> {{ $institucion->telefono1 }}</label></strong></p>
					<p><strong class="numero" ><label><i class="fa fa-phone" aria-hidden="true"></i> {{ $institucion->telefono2 }}</label></strong></p>

					@if (!empty($institucion->sitioWeb))
						<p><strong class="numero" ><label><i class="fa fa-globe" aria-hidden="true"></i> <a href="{{ url($institucion->sitioWeb) }}">{{ $institucion->sitioWeb }}</a></label></strong></p>
					@endif

				</center>

				<center>
					<img src="/ico/map.png" height="40" width="40">
					<p>{{ $institucion->direccion }}</p>
				</center>
				<hr>
				@if (count($areas)>0)
					<div class="linea panel-info">
					  <div class="panel-heading">Áreas o Especialidades</div>
						  <div class="panel-body">
						  	@foreach ($areas as $area)
								
									@if ($area->logo == null)
										<p><a href="{{ url('/areaExtern/'.$idInstitucion.'/'.base64_encode($area->id)) }}"><label style="margin-left: 20px">{{ $area->nombre }}</label></a></p>
										<hr>
									@endif
									@if (!$area->logo == null)
										<p><a href="{{ url('/areaExtern/'.$idInstitucion.'/'.base64_encode($area->id)) }}"><img src="{{'/'.$area->logo }}" class="img-thumbnail img-prod ">  
										<label style="margin-left: 20px">{{ $area->nombre }}</label></a></p><hr>
									@endif
							@endforeach
						  </div>
					</div>
				
				@endif
				@if (!count($areas)>0)
					<label>no hay áreas</label>
				@endif

			</div>
			<div class="col-md-8 fondo-blanco lineas-border">
				<br>
				<div class="row">
					
					@if (!empty($institucion->mision))
					<div class="col-md-offset-1 col-md-4 linea-arriba">
						
							<p><strong><label>Misión</label></strong></p>
							<p class="txt-gris">{{ $institucion->mision }}</p>

					</div>
					@endif
					@if (!empty($institucion->vision))
					<div class="col-md-offset-1 col-md-4 linea-arriba">
							<p><strong><label>Visión</label></strong></p>
							<p class="txt-gris" >{{ $institucion->vision }}</p>
					</div>
					@endif
				</div>
				<hr>
				@if (count($productos)>0)
					<div class="row">
						<div class="col-md-12">

							<center><div class="android-section-title mdl-typography--display-1-color-contrast"><i class="material-icons">&#xE867;</i> Productos</div></center>
							</div>
							<hr>
							
							@foreach ($productos as $producto)
							
								<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
							
									<div class="mdl-card__media porteImgTienda"><img src="{{ '/'.$producto->foto }}" class="img-thumbnail img-prod "></div>
									<div class="mdl-card__title"><h4 class="mdl-card__title-text">{{ str_limit($producto->nombre, 10) }}</h4>

									</div>
									<p><a href="{{ url("/verDetalleProducto/".base64_encode($producto->idProducto)) }}" class="btn btn-primary btn-xs">Ver mas detalles</a></p>
							
								</div>
							
							@endforeach						

					</div>

				@endif
				@if (!count($productos))
					<center>
						<label for="">No Existen  para mostrar</label>
						<br>
						<img src="/ico/sad.png">
					</center>
				@endif

				<hr>

				@if (count($servicios)>0)
					<div class="row">
						<div class="col-md-12">
							<center><div class="android-section-title mdl-typography--display-1-color-contrast"><i class="material-icons">&#xE867;</i> Servicios</div></center>
							</div>
							<hr>
							
							@foreach ($servicios as $servicio)
							<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
								
									<div class="mdl-card__media porteImgTienda"><img src="{{ '/'.$servicio->foto }}" class="img-thumbnail img-prod "></div>
									<div class="mdl-card__title"><h4 class="mdl-card__title-text">{{ str_limit($servicio->nombre, 10) }}</h4></div>
									<p><a href="{{ url('/detalleServicio/'.base64_encode($servicio->id).'/'.$idInstitucion) }}" class="btn btn-primary btn-xs">Ver</a></p>
								

							</div>	
							@endforeach

						</div>

					</div>

				@endif
				@if (!count($servicios))
					<center>
						<label for="">No Existen Servicios para mostrar</label>
						<br>
						<img src="/ico/sad.png">
					</center>
				@endif
			</div>
			
		</div>
	
	</div>


@endsection




