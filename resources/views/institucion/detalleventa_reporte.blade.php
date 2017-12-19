
<!DOCTYPE html>
<html>
<head>
	<head>
	<meta charset="UTF-8">
  	<link rel="stylesheet" href="{{asset('css/css.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilo_institucion.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/nuevocss.css') }}">
</head>
</head>
<body>
	<style type="text/css">
			
			
		.tr-color{
				margin: 15px;
				color:white;
				background: #5499C7;
		}

	</style>
	<div class="container margen">
		<center>Detalle de venta</center>
	<hr>
	<div class="row">
		<div class="col-md-3">
			<p><strong>Comprador: </strong> {{ $cliente->nombres.' '.$cliente->apellidos }}</p>
			<p><strong>Email: </strong> {{ $cliente->email }}</p>
		</div>
		<div class="col-md-3">
			<p><strong>Teléfono: </strong>{{ $cliente->telefono }}</p>
			<p><strong>Fecha de venta: </strong>{{ date(' h:i:s - d-m-Y', strtotime($cliente->fecha)) }}</p>
		</div>
		<div class="col-md-3">
			<p><strong>Institución: </strong> {{ \Auth::guard('institucion')->user()->nombre  }}</p>
		</div>
	</div>
	
	<table class="table table-hover" >
		<tr class="tr-color" >
			<td><strong>Foto</strong></td>
			<td><strong>Nombre</strong></td>
			<td><strong>Precio unitario</strong></td>
			<td><strong>Cantidad</strong></td>
			<td><strong>Precio total</strong></td>
		</tr>
		
		@foreach ($productos as $p)
			<tr>
				<td>
					<img src="{{public_path() .'/'.$p->foto }}" class="img-prod" >
				</td>
				<td>
					<label>{{ $p->nombre }}</label>
				</td>
				<td>
					<label>{{ '$ '.number_format( $p->precio_unitario, 0, ',', '.') }}</label>
				</td>
				<td>
					<label>{{ $p->cantidad }}</label>
				</td>
				<td>
					<label>{{'$ '.number_format( $p->precio_unitario*$p->cantidad, 0, ',', '.')}}</label>
				</td>
			</tr>
		@endforeach
	</table>
	<hr>
	<label><strong>Total de esta venta: </strong>{{ '$ '.number_format( $total, 0, ',', '.') }}</label>
	</div>
</body>
</html>
	


