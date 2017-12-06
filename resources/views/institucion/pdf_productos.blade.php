
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" href="{{asset('css/css.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilo_institucion.css')}}">
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nuevocss.css') }}">
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
		<center>Productos de {{ $nombreArea }}</center>
	<hr>

	<table>
		<tr>
			<td>
				<p><strong>Fecha de creación:</strong> {{ date('d-m-Y') }}</p>
				<p><strong>Encargado de área: </strong> {{ $encargado->nombre }}</p>
				<p><strong>Email: </strong> {{ $encargado->email }}</p>
			</td>
		</tr>
	</table>
	<table class="table table-hover" >
		<tr class="tr-color" >
			<td><strong>Foto</strong></td>
			<td><strong>Nombre</strong></td>
			<td><strong>Descripción</strong></td>
			<td><strong>Cantidad</strong></td>
		</tr>
		
		@foreach ($productos as $p)
			<tr>
				<td>
					<img src="{{public_path() .'/'.$p->foto }}" class="img-logo" >
				</td>
				<td>
					{{ $p->nombre}}
				</td>
				<td>
					{{ $p->descripcion }}
				</td>
				<td>
					{{ $p->cantidad }}
				</td>
			</tr>
		@endforeach
	</table>
	</div>

</body>

</body>
</html>