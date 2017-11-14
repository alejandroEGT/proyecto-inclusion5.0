@extends('inicioCliente.clienteMaster')

<title>Carro</title>
@section('content')


		@if (Session::has('Advertencia'))
			<div class="alert alert-info">
		    <a href="" class="close" data-dismiss="alert">&times;</a>
			        {{ Session::get('Advertencia') }}
		    </div>
		@endif

<h1 class="text-center">carro compras</h1>
<div class="android-drawer-separator"></div>

	<div class="container ">
		<div class="row caja-sesion">
			<div class="col-xs-12 col-sm-12 col-md-12 mdl-shadow--6dp">
				

	@foreach($carro as $carros)

					<div class="android-drawer-separator"></div>
					<p class="contenido-sesion letra-carro">Tienda: {{ $carros->nombreTienda  }}</p>
					<p class="contenido-sesion letra-carro">Categoria:</p>
					<div class="android-drawer-separator"></div>


						<div class="container-fluid">
							<div class="row caja-sesion">
								

								<div class="col-xs-12 col-sm-12 col-md-3">

									<div class="imagen-producto" align="center">
										<img class="mdl-card__media porteimg" src="{{ '/'.$carros->fotoProducto }}">
									</div>
		
								</div>

								<div class="col-xs-12 col-sm-12 col-md-5">
									<a href="{{ url('/verDetalleProducto').'/'.base64_encode($carros->idProducto)}}"><p class="letra-carro">{{ $carros->nombreProducto }}</p></a>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis dolore, esse ipsam neque nulla animi quidem? Non modi aliquid ex accusamus, sit sint deleniti neque nostrum alias repudiandae vero commodi?</p>
	

								</div>



								<div class="col-xs-12 col-sm-12 col-md-4" align="right">

									<form method="post" action="{{ url('carro/actualizarProd') }}">
										{{csrf_field()}}
										<input type="hidden" name="id" value="{{ base64_encode($carros->idProducto) }}">
									<p class="letra-carro">Cantidad
								  
									<input type="text" name="cantidad" class=" mdl-shadow--2dp margen-cantidad" value=" {{ $carros->cantidadProducto }}">
									<label class="bmd-label-floating">unidades</label>
									<input type="submit" value="actualizar" class="btn btn-raised btn-info btn-xs">
									</p>
									<div class="android-drawer-separator"></div>
									

									</form>
							
									<p class="letra-carro">Precio: 
										<label class="lbl-precio-cliente">{{ '$'.$carros->precioProducto }} CLP </label>
										<label class="bmd-label-floating">/ unidades</label>
									</p>
									<div class="android-drawer-separator"></div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 letra-carro" align="right"><br>

											<input type="button" @click="eliminarProducto({!! $carros->idProducto !!})" class="btn btn-warning btn-raised btn-xs" value="Eliminar"/>

											<br><p align="right">
													<label  class="registro-sesion bmd-label-floating">Subtotal: </label>
													<label class="lbl-precio-cliente">{{ '$'.$carros->cantidadProducto*$carros->precioProducto	}} CLP </label>
												</p>	
								</div>

							</div>

							

							@endforeach

							<div class="android-drawer-separator"></div>
							<p align="right">
								<label for="" class="registro-sesion bmd-label-floating">Total: </label>
								<label for=""></label>
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