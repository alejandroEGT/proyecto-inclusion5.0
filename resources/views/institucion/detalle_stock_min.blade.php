@extends('institucion.master_institucion')

@section('content')
	<center><label>Productos en cantidad menor a {{ $stok_min }} </label></center>

	<hr>
@if($productos != null)
<p><label><a href="{{ url('institucion/stock_minimo') }}"><i class="fa fa-cog" aria-hidden="true"></i> Configurar stock</a></label></p>
	<table class="table table-hover">
		<tr class="tr-estilo">
			<td>Foto</td>
			<td>Nombre</td>
			<td>Cantidad</td>
			<td>Opción</td>
		</tr>
		@foreach ($productos as $p)
			<tr>
				<td><img src="{{'/'.$p->foto}}" class="img-prod" ></td>
				<td><label>{{ $p->nombre }}</label></td>
				<td><label>{{ $p->cantidad }}</label></td>
				<td><a href="{{ url('institucion/detalleProducto/'.base64_encode($p->id)) }}" class="btn btn-success" >Ver detalle</a></td>
			</tr>
		@endforeach
	</table>
@endif
@if ($productos == null)
	<center><label>Nada para mostrar <a href="{{ url('institucion/inicio') }}">Volver a inicio</a></label></center>
@endif
@endsection