@extends('inicioCliente.clienteMaster')

@section('content')

	
@if (is_null($productos[0]))
	<center><p style="font-size: 19px" >Nada para mostrar</p></center>
@endif
@if (!is_null($productos[0]))
	{{-- expr --}}
	<hr>
	<center><label><h1>Detalle del producto</h1></label></center>
	<hr>
	<div class="row panel fondoTienda">
		<div class="col-md-offset-1 col-md-12">
			<label>Tienda:</label>
			@foreach($tiendas as $tiendas)
			<a href="{{ url("/perfil_institucion/".base64_encode($tiendas->id)) }}"> {{ $tiendas->nombre }}</a>	
			@endforeach
		</div>
	</div>
<div class="row panel fondoDescripcion">

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

			
	<div class="col-md-offset-1 col-md-6 porteimgDetalle">
		<img src="{{ '/'.$productos[0]->foto }}" class="img-thumbnail img-responsive"><br>
	</div>
	<div class="col-md-6">	
		<center><label class="estiloDetalleProducto"><h4> {{ $productos[0]->nombre }} </h4></label></center>
		<dl>			
			<dt><label class="estiloDetalleTitulos"><strong>Descripción del producto</strong></label></dt>
			<dd><label class="estiloDetalleDescripcion">{{ $productos[0]->descripcion }}</label></dd>

			<dt><label class="estiloDetalleTitulos"><strong>Categoría del producto</strong></label></dt> 
			<dd><label class="estiloDetalleDescripcion">{{ $productos[0]->nombreCategoria }}</label></dd>	
			
			<dt><label class="estiloDetalleTitulos"><strong>Área o especialidad del producto</strong></label></dt>
			<dd><label class="estiloDetalleDescripcion">{{ $productos[0]->nombreArea }}</label></dd>

			<dt><label class="estiloDetalleTitulos"><strong>Precio</strong></label></dt>
			<dd><label class="estiloDetalleDescripcion">$ {{ $productos[0]->precio }}</label></dd>
	
			<form action="{{ url('carro/agregarProd')}}"  method="post">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ base64_encode($productos[0]->idProducto) }}">

				<dt><label class="estiloDetalleTitulos"><strong>Cantidad</strong></label></dt> 
				
				<dd>
				<input id ="cantidadProducto" onkeyup ="validar_stock()" type="number" class="col-xs-12 col-sm-12 col-md-2" name="cantidad" max="{{ $productos[0]->cantidad }}" min="1">
				<label class="bmd-label-floating"> unidades ({{ $productos[0]->cantidad }} unidades disponibles)</label>
				<label id="mensaje" class="estiloDetalleCantidad" ></label>
				</dd>
				<hr>
				<button type="submit" class="btn btn-primary btn-outline-danger">Añadir a la cesta</button>
			</form>
		</dl>				
	</div>	
</div>
<br><br>	


<hr><center><div class="android-section-title mdl-typography--display-1-color-contrast"><h1>Ver mas productos</h1></div></center><hr>
	  		<div class="android-card-container mdl-grid">		
			@foreach($ver_producto as $producto)	
				
					<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
						<dl>
						<div class="imagen-producto">
						<a class="mdl-card__media porteimg" href="{{ url("/verDetalleProducto/".base64_encode($producto->idProducto)) }}"><img src="{{ '/'.$producto->fotoProducto }}"></a>
						</div>							
						<div class="mdl-card__title estiloDetalleTitulos"><h4 class="mdl-card__title-text">{{ $producto->nombreProducto }}</h4></div>
						<div class="mdl-card__supporting-text">
						<span class="mdl-typography--font-light mdl-typography--subhead">{{ $producto->descripcionProducto }}</span>
						<hr><dt><label class="estiloDetalleTitulos"><strong>Valor: $ {{ $producto->precioProducto }}</strong></label></dt>
						</div>
						</dl>
					</div>

			@endforeach
			
			</div>

@endif

<script type="text/javascript">
	
	function validar_stock() {
			document.getElementById("mensaje").innerHTML = "";
		if (document.getElementById("cantidadProducto").value > {{ $productos[0]->cantidad }})
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
@endsection
