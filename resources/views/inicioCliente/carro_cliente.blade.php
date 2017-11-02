@extends('inicioCliente.clienteMaster')

<title>Carro</title>
@section('content')


<h1 class="text-center">carro compras</h1>
<div class="android-drawer-separator"></div>

	<div class="container ">
		<div class="row caja-sesion">
			<div class="col-xs-12 col-sm-12 col-md-10 mdl-shadow--6dp">
				
				<form action="" method="post">
					{{csrf_field()}}


	@foreach($carro as $carros)

				@if(count($carros->nombreTienda))

				@endif
					<p class="contenido-sesion">Tienda: {{ $carros->nombreTienda  }}</p>
					<p class="contenido-sesion">Categoria:</p>
					<div class="android-drawer-separator"></div>


						<div class="container-fluid">
							<div class="row caja-sesion">

								<div class="col-xs-12 col-sm-12 col-md-3">
									<a href="{{ url('/vista_productos').'/'.$carros->idProducto}}"><p>{{ $carros->nombreProducto }}</p></a>
									<div class="android-drawer-separator"></div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-3">
									<p>Cantidad</p>
									<p>
										<input type="text" class="col-xs-12 col-sm-12 col-md-4" name="cantidad" value="{{ $carros->cantidadProducto }}">
										<label class="bmd-label-floating"> unidades</label>
									</p>
									<div class="android-drawer-separator"></div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-3">
									<p>Precio</p>
									
									<p>
										<label for="">{{ '$'.$carros->precioProducto }} CLP </label>
										<label class="bmd-label-floating">/ unidades</label>
									</p>
									<div class="android-drawer-separator"></div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-3">
									<br><p align="right"><a href="#" class="registro-sesion bmd-label-floating">Eliminar</a></p>
									<br><p align="right">
											<label for="" class="registro-sesion bmd-label-floating">Subtotal: </label>
											<label for="">{{ '$'.$carros->cantidadProducto*$carros->precioProducto	}} CLP </label>
										</p>	
								</div>

							</div>

							@endforeach

							<div class="android-drawer-separator"></div>
							<p align="right">
								<label for="" class="registro-sesion bmd-label-floating">Total: </label>
								<label for="">$19.980</label>
							</p>
							
							<form action="" method="">
							<div class="boton-sesion">	
							  	<p align="right"><a href="#" class="btn btn-primary btn-outline-success">Comprar</a></p>
							</div>
							</form>
						</div>
				</form>
			</div>
		</div>
	</div>

<div class="android-drawer-separator"></div>

@endsection