@extends('institucion.master_institucion')

@section('content')
<div class="">
	
<div class="container">
<form id="tipo_form" action="{{ url('institucion/my-chart') }}" method="get" >
	<select id="tipo" name="tipo"  @change="cambiarGrafico" class="form-control" name="tipo" >
	<option value="">Seleccione tipo de grafico..</option>
	<option value="pie">Circular</option>
	<option value="bar">Barra..</option>
	<option value="line">Lineal..</option>
</select>
</form>

    {!! Charts::assets() !!}
    {!! $chart->render() !!}

  </div>

</div>
@endsection
