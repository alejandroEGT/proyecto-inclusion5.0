<title>Productos</title>
@extends('inicioCliente.clienteMaster')

@section('content')
<div class="android-drawer-separator"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-4 mdl-shadow--6dp">
				<div class="imagen-producto">
				<img class="mdl-card__media porteimg" src="{{ '/'.$producto->fotoProducto }}">
				</div>
			</div>
			<div class="col-md-8 mdl-shadow--6dp">
				<h3>{{$producto->nombreProducto}}</h3>
				<dl>
					<dt>
						Descripción del producto
					</dt>
					<dd>
						{{$producto->descripcionProducto}}
					</dd>

					<dt>
						Precio
					</dt>
					<dd>
						<label class="bmd-label-floating">$ {{$producto->precioProducto}} </label> 
					</dd>

					<dt>
						Cantidad
					</dt>
					<dd>
						<input type="number" value="1" class="col-xs-12 col-sm-12 col-md-2" name="cantidad" max="{{$producto->cantidadProducto}}" min="1">
						<label class="bmd-label-floating">{{$producto->cantidadProducto}} unidades disponibles</label>
						
					</dd>
					<form action="" method="">
					<button type="submit" class="btn btn-primary btn-outline-success">Comprar ahora</button>
					</form>
					
					<form action="{{ url('carro/ingCarro') }}" method="post">
						{{ csrf_field() }}
					<button type="submit" class="btn btn-primary btn-outline-danger">Añadir a la cesta</button>
					</form>

				</dl>
			</div>
		</div>
	</div>


</div>
<div class="android-drawer-separator"></div>
@endsection
