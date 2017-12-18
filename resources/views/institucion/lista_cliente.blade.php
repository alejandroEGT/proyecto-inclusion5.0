@extends('institucion.master_institucion')

@section('content')
	
	<div class="container">
		<table class="table table-hover" >
		<tr>
			<td>Cliente</td>
			<td>Nº de compras</td>
		</tr>
		@foreach ($clientes as $c)
			<tr>
				<td>{{ $c->nombre }}</td>
				<td>{{ $c->cantidad }}</td>
			</tr>
		@endforeach
	</table>
	</div>
@endsection