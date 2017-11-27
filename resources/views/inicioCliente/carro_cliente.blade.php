@extends('inicioCliente.clienteMaster')

<title>Carro</title>

@section('tiendas')
						@foreach($tiendas as $tienda)
				          <a class="mdl-navigation__link" href="{{ url("/perfil_institucion/".base64_encode($tienda->id))}}">{{ $tienda->nombre }}</a>
				        @endforeach
@endsection

@section('content')


		@if (Session::has('Advertencia'))
			<div class="alert alert-info">
		    <a href="" class="close" data-dismiss="alert">&times;</a>
			        {{ Session::get('Advertencia') }}
		    </div>
		@endif

<div class="container">
		<hr><center><h1>Carro de compras</h1></center><hr>
</div>




@if (Session::has('Prueba'))
		<div class="container">
				<div class="panel">
				<center><h2>Agregue productos a su carro.</h2></center>
				<center><a href="{{url('/productos_clientes')}}"><img src="/ico/carro_vacio.png" class="diseñoCarroVacio"></a></center>
		</div>
		</div>
		@else


<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			@foreach($carro as $carros)
				<div class="panel">

					<p class="contenido-sesion letra-carro">Tienda:&nbsp;&nbsp;<label class="bmd-label-floating"> {{ $carros->nombreTienda  }}</label></p>
					<p class="contenido-sesion letra-carro">Categoria:&nbsp;&nbsp;<label class="bmd-label-floating"> {{$carros->categoriaProducto}}</label></p><hr>
					
						<div class="container-fluid">
							<div class="row caja-sesion">
							
								<div class="col-xs-12 col-sm-12 col-md-3">
									<div class="imagen-producto" align="center">
										<img class="mdl-card__media porteimg" src="{{ '/'.$carros->fotoProducto }}">
									</div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-5">
									<a href="{{ url('/verDetalleProducto').'/'.base64_encode($carros->idProducto)}}">
									<p class="letra-carro">{{ $carros->nombreProducto }}</p></a>
									<p>{{$carros->descripcionProducto}}</p>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-4" align="right">
									<form method="post" action="{{ url('carro/actualizarProd') }}">
										{{csrf_field()}}
										<input type="hidden" name="id" value="{{ base64_encode($carros->idProducto) }}">
										<p class="letra-carro">Cantidad
											<input id ="cantidadProducto" onkeyup ="validar_stock()" type="text" name="cantidad" class=" mdl-shadow--2dp margen-cantidad" max="{{ $carros->stockProducto }}" value=" {{ $carros->cantidadProducto }}">
									
											<label id="mensaje" class="estiloDetalleCantidad" ></label>
											<input type="submit" value="actualizar" class="btn btn-raised btn-info btn-xs">
											<label class="bmd-label-floating"> unidades ({{ $carros->stockProducto }} unidades disponibles)</label>
										</p><hr>
									</form>
									<p class="letra-carro">Precio: 
										<label class="lbl-precio-cliente">{{ '$'.$carros->precioProducto }} CLP </label>
										<label class="bmd-label-floating"> c/u</label>
									</p><hr>	
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 letra-carro" align="right"><br>
									<input type="button" @click="eliminarProducto({!! $carros->idProducto !!})" class="btn btn-warning btn-raised btn-xs" value="Eliminar"/><br><br>

									<p align="right">
										<label  class="registro-sesion letra-carro">Subtotal: </label>
										<label class="lbl-precio-cliente">{{ '$'.$carros->cantidadProducto*$carros->precioProducto	}} CLP </label>
									</p>	
								</div>

							</div>
						</div>

				</div><br>		
			@endforeach
	
		</div>
	</div>
</div>

	<div class="container ">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="panel"><hr>
							<p align="right">
								<label for="" class="registro-sesion letra-carro">Total: <label class="lbl-precio-cliente">{{'$'.$total}} CLP </label></label>
								<label for=""></label>
							</p>

							<div class="boton-sesion">
							  	<p align="right">
							  		<a href="{{ url("/carro/detalleCompra/") }}">
							  			<input type="submit"  class="btn btn-primary btn-outline-success" value="Comprar"></input>
							  		</a>
							  	</p>
						 	</div><hr>	
				</div>
			</div>
		</div>
	</div><br>



<script type="text/javascript">
	
	function validar_stock() {
			document.getElementById("mensaje").innerHTML = "";
		if (document.getElementById("cantidadProducto").value > {{ $carros->stockProducto }})
		{
			document.getElementById("mensaje").innerHTML = "La cantidad ingresada supera el limite de stock";
			document.getElementById("cantidadProducto").value = ""; 
		}

		 else if 
		 	(document.getElementById("cantidadProducto").value < 0 || document.getElementById("cantidadProducto").value == 0)
		{
			document.getElementById("mensaje").innerHTML= "La cantidad ingresada no puede ser inferior a 0";
			document.getElementById("cantidadProducto").value = ""; 
		} 
	}

</script>

@endif


@endsection