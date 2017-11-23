@extends('inicioCliente.clienteMaster')

@section('content')
@if (count($errors))			
				<div class="alert alert-danger">
				    <a href="" class="close" data-dismiss="alert">&times;</a>
				    @foreach ($errors->all() as $e)
						<ul>
							<li>{{ $e }}</li>
						</ul>
					@endforeach
				</div>
			@endif

			@if (Session::has('correcto'))
					<div class="alert alert-info">
				    	<a href="" class="close" data-dismiss="alert">&times;</a>
					    	{{ Session::get('correcto') }}
				    </div>
			@endif
	
@if (is_null($servicios[0]))
	<center><p style="font-size: 19px" >Nada para mostrar</p></center>
@endif
@if (!is_null($servicios[0]))
	{{-- expr --}}
<br>
	<center><label><h1>Detalle del servicio</h1></label></center>
	<hr>
<div class="row panel">

			
	<div class="col-md-offset-1 col-md-6 porteimgDetalle">
		<img src="{{ '/'.$servicios[0]->foto }}" class="img-thumbnail img-responsive"><br>
	</div>
	<div class="col-md-6">	
		<center><label class="estiloDetalleProducto"><h4> {{ $servicios[0]->nombre }} </h4></label></center>
		<dl>			
			<dt><label class="estiloDetalleTitulos"><strong>Descripción del servicio</strong></label></dt>
			<dd><label class="estiloDetalleDescripcion">{{ $servicios[0]->descripcion }}</label></dd>

			<dt><label class="estiloDetalleTitulos"><strong>Categoría del producto</strong></label></dt> 
			<dd><label class="estiloDetalleDescripcion">{{ $servicios[0]->nombreCategoria }}</label></dd>	
			
			<dt><label class="estiloDetalleTitulos"><strong>Área o especialidad del servicio</strong></label></dt>
			<dd><label class="estiloDetalleDescripcion">{{ $servicios[0]->nombreArea }}</label></dd>

			
	
			{{--<form action="{{ url('carro/agregarProd')}}"  method="post">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ base64_encode($servicios[0]->idProducto) }}">

				<dt><label class="estiloDetalleTitulos"><strong>Cantidad</strong></label></dt> 
				
				<dd>
				<input id ="cantidadProducto" onkeyup ="validar_stock()" type="number" class="col-xs-12 col-sm-12 col-md-2" name="cantidad" max="{{ $productos[0]->cantidad }}" min="1">
				<label class="bmd-label-floating"> unidades ({{ $productos[0]->cantidad }} unidades disponibles)</label>
				<label id="mensaje" class="estiloDetalleCantidad" ></label>
				</dd>
				<hr>
				<button type="submit" class="btn btn-primary btn-outline-danger">Añadir a la cesta</button>
			</form>--}}
		</dl>				
	</div>	
</div>	


@endif


@endsection
