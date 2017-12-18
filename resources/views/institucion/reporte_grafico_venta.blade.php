<!DOCTYPE html>
<html>
<head>
	<title></title>
		<link rel="stylesheet" href="{{asset('css/css.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilo_institucion.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/nuevocss.css') }}">

</head>
<body>

<center>Grafico de esta venta</center>
	<div class="container">
		{!! Charts::assets() !!}

 		{!! $chart->render() !!}
	</div>

</body>
</html>
	
