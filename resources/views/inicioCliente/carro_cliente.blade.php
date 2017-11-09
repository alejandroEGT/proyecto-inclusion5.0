@extends('inicioCliente.clienteMaster')

<title>Carro</title>
@section('content')


<h1 class="text-center">carro compras</h1>
<div class="android-drawer-separator"></div>

	<div class="container ">
		<div class="row caja-sesion">
			<div class="col-xs-12 col-sm-12 col-md-10 mdl-shadow--6dp">
				



	@foreach($carro as $carros)

					<p class="contenido-sesion">Tienda: {{ $carros->nombreTienda  }}</p>
					<p class="contenido-sesion">Categoria:</p>
					<div class="android-drawer-separator"></div>


						<div class="container-fluid">
							<div class="row caja-sesion">
								

								<div class="col-xs-12 col-sm-12 col-md-3">

									<div class="imagen-producto">
										<img class="mdl-card__media porteimg" src="{{ '/'.$carros->fotoProducto }}">
									</div>
		
								</div>

								<div class="col-xs-12 col-sm-12 col-md-3">
									<a href="{{ url('/verDetalleProducto').'/'.base64_encode($carros->idProducto)}}"><p>{{ $carros->nombreProducto }}</p></a>
									<div class="android-drawer-separator"></div>

								</div>



								<div class="col-xs-12 col-sm-12 col-md-3">

									<form method="post" action="{{ url('carro/actualizarProd') }}">
										{{csrf_field()}}
										<input type="hidden" name="id" value="{{ base64_encode($carros->idProducto) }}">
									<p>Cantidad</p>
									<p>
										<input type="text" class="col-xs-12 col-sm-12 col-md-4" name="cantidad" value="{{ $carros->cantidadProducto }}">
										<label class="bmd-label-floating"> unidades</label>
									</p>
									<div class="android-drawer-separator"></div>
									<input type="submit" value="actualizar">

									</form>
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
									<br><p align="right"><a href="{{ url('carro/eliminarProd').'/'.base64_encode($carros->idProducto) }}" class="registro-sesion bmd-label-floating">Eliminar</a></p>
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
							
											<form action="/testo" method="post">
					{{csrf_field()}}
							<div class="boton-sesion">	
							  	<p align="right"><input type="submit" class="btn btn-primary btn-outline-success" value='Comprar'></p>

							</div>
							
						</div>
				</form>
			</div>
		</div>
	</div>

<div class="android-drawer-separator"></div>

@endsection