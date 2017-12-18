@extends('inicioCliente.clienteMaster')

@section('content')

	
@if (is_null($productos))
	<center><p style="font-size: 19px" >Nada para mostrar</p></center>
@endif
@if (!is_null($productos))
	{{-- expr --}}

	@if (count($errors))			
				<div class="alert alert-success">
				    <a href="" class="close" data-dismiss="alert">&times;</a>
				    @foreach ($errors->all() as $e)
							<i class="fa fa-info-circle" aria-hidden="true"></i> {{ $e }}
					@endforeach
				</div>
			@endif

			@if (Session::has('correcto'))
					<div class="alert alert-info">
				    	<a href="" class="close" data-dismiss="alert">&times;</a>
					    	<i class="fa fa-info-circle" aria-hidden="true"></i> {{ Session::get('correcto') }}
				    </div>
			@endif

	
	<div class="container">

	<hr>
	<center><label><h1>Detalle del producto</h1></label></center>
	<hr>
<div class="row panel fondoDescripcion">
		<div class="col-md-offset-1 col-md-12">
			<a onclick="window.history.back();"><img src="/ico/boton_volver2.png" class="botonImagenVolver"></a>
			<label>Tienda:</label>

			<a href="{{ url("/perfil_institucion/".base64_encode($productos->idTienda)) }}">{{ $productos->nombreTienda }}</a>	

		<hr></div>
		<br>

	<div class="col-md-offset-1 col-md-4 porteimgDetalle">
		<img src="{{ '/'.$productos->foto }}" class="img-thumbnail img-responsive"><br>
	</div>
	<div class="col-md-8">	
		<br><center><label class="lbl-nom"><h3> {{ $productos->nombre }} </h3></label></center><hr>
		<dl>			
			<dt><label class="mdl-typography--font-light mdl-typography--subhead"><b>Descripción del producto:</b></label></dt>
			<dd><label class="mdl-typography--font-light mdl-typography--subhead">{{ $productos->descripcion }}</label></dd>

			<dt><label class="mdl-typography--font-light mdl-typography--subhead"><b >Categoría del producto:</b ></label></dt> 
			<dd><label class="mdl-typography--font-light mdl-typography--subhead">{{ $productos->nombreCategoria }}</label></dd>	
			
			<dt><label class="mdl-typography--font-light mdl-typography--subhead"><b >Área o especialidad del producto:</b ></label></dt>
			<dd><label class="mdl-typography--font-light mdl-typography--subhead">{{ $productos->nombreArea }}</label></dd>

			<dt><label class="mdl-typography--font-light mdl-typography--subhead"><b >Precio:</b ></label></dt>
			<dd><label class="lbl-precio">$ {{ number_format($productos->precio, 0, ',', '.')  }} CLP</label></dd>
	
			<form action="{{ url('carro/agregarProd')}}"  method="post">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ base64_encode($productos->idProducto) }}">

				<dt><label class="mdl-typography--font-light mdl-typography--subhead"><b >Cantidad:</b ></label></dt> 
				
				<dd>
				<input id ="cantidadProducto" onkeyup ="validar_stock()" type="number" class="col-xs-12 col-sm-12 col-md-2" name="cantidad" max="{{ $productos->cantidad }}" min="1">
				<label class="bmd-label-floating"> unidades ({{ $productos->cantidad }} unidades disponibles)</label>
				<label id="mensaje" class="estiloDetalleCantidad" ></label>
				</dd>
				<hr>
				<button type="submit" class="btn btn-raised btn-danger">Añadir a la cesta</button>
				<button type="submit" class="btn btn-raised btn-success">
				<a  style="color: white;" href="{{ url('cliente/guardar_en_lista_deseo/'.base64_encode($productos->idProducto))}}">Favoritos</a>
			</button>
			</form>
		</dl>				
	</div>	
</div>	
<hr><center><div class="android-section-title"><h1>Ver mas productos de la institucion</h1></div></center><hr>

		<div class="row panel">
	  		<div class="android-card-container mdl-grid">		
			@foreach($ver_producto as $producto)	
				
					<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
						<dl>
						<div class="imagen-producto">
						<a class="mdl-card__media porteimg" href="{{ url("/verDetalleProducto/".base64_encode($producto->idProducto)) }}"><img src="{{ '/'.$producto->fotoProducto }}"></a>
						</div>
						<div class="mdl-card__title"><h4 class="lbl-precio"> $ {{ number_format($producto->precioProducto, 0, ',', '.')  }} CLP</h4></div> 							
						<div class="mdl-card__title estiloDetalleTitulos"><h4 class="mdl-card__title-text">{{ str_limit($producto->nombreProducto,20) }}</h4></div>
						<div class="mdl-card__supporting-text">
						<span class="mdl-typography--font-light mdl-typography--subhead">{{ str_limit($producto->descripcionProducto,20) }}</span>
						</div>
						</dl>
						<div class="mdl-card__actions">
		         			<a class="btn btn-raised btn-success" href="{{ url("/verDetalleProducto/".base64_encode($producto->idProducto)) }}">Ver</a>
		      				</div>
					</div>

			@endforeach


			
			</div>
		</div><br>
					<center>{{ $ver_producto->links() }}</center>

		</div>

@endif

<script type="text/javascript">
	
	function validar_stock() {
			document.getElementById("mensaje").innerHTML = "";
		if (document.getElementById("cantidadProducto").value > {{ $productos->cantidad }})
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
