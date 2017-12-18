@extends('institucion.master_institucion')

@section('content')
	<center><label>Detalle de la venta</label></center>
<br>
<hr>
	<div class="container">
		<div class="row">
		<div class="col-md-3">
			<p><label>Comprador: </label> {{ $cliente->nombres.' '.$cliente->apellidos }} </p>
			<p><label>Email: </label> {{ $cliente->email }}</p>
		</div>
		<div class="col-md-3">
			<p><label>Teléfono: </label> {{ $cliente->telefono }}</p>
			<p><label>Fecha de venta: </label> {{ date('h:i:s - d-m-Y', strtotime($cliente->fecha)) }}</p>
		</div>
		<div class="col-md-3">
			<a href="{{ url('institucion/descargarpdf_detalle_venta/'.$id_venta) }}" class="btn btn-success btn-sm" >Exportar a PDF esta venta</a>
		</div>
	</div>
	<table class="table table-hover" >
		<tr>
			<td>Foto</td>
			<td>Nombre</td>
			<td>Precio unitario</td>
			<td>Cantidad</td>
			<td>Precio total</td>

		</tr>
		@foreach ($productos as $p)
			<tr>
				<td><img class="sizeLogo" src="{{ '/'.$p->foto }}"></td>
				<td>{{ $p->nombre }}</td>
				<td>{{ $p->precio_unitario }}</td>
				<td>{{ $p->cantidad }}</td>
				<td style="color: #16A085">{{ $p->precio_unitario*$p->cantidad }}</td>
			</tr>
		@endforeach
	</table>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-10">
			<span class="pull-right"><strong class="lbl-tv" >Total de esta venta:</strong> <label class="lbl-val" >$ {{ $total }}</label></span>
		</div>
	</div>
@endsection