@extends('institucion.master_institucion')

@section('content')
<div class="">
	
<div class="container">

<form id="tipo_form" action="{{ url('institucion/grafico_productosAdmin') }}" method="get" >
	<select id="tipo" name="tipo"  @change="cambiarGrafico" class="form-control" name="tipo" >
	<option value="">Seleccione tipo de grafico..</option>
	<option value="pie">Circular</option>
	<option value="bar">Barra..</option>
	<option value="line">Lineal..</option>
</select>
</form>

 {!! Charts::assets() !!}

 {!! $chart_productos->render() !!}

</div>

<center>
	<p><label>Cantidad de productos en la institución:</label> <small>{{ $contarTodoProducto }}</small></p>
	<p><small>(No seran contados los productos eliminados o en estado de ocultos)</small></p>
</center>
</div>
@endsection
