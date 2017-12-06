@extends('institucion.master_institucion')

@section('content')
<div class="">
	
<div class="container">

	<form id="tipo_form" action="{{ url('institucion/ver_vistas_tienda') }}" method="get" >
		
	</form>
	<hr>
	<form id="form_fecha" action="{{ url('institucion/ver_vistas_tienda') }}" method="get" >

		<select id="tipo" name="tipo"   class="form-control">
			@if (old('tipo')!="")
				<option value="{{ old('tipo') }}">{{ old('tipo') }}</option>
			@endif
			@if (old('tipo')=="")
				<option value="">Seleccione gráfico..</option>
			@endif

			<option  value="Bar">Bar</option>
			<option value="Line">Line</option>
		</select>
		<div class="row">
			<div class="col-md-2">
				<label>Mes</label>
					
						<select id="tipo" name="mes" class="form-control" >
							@if (old('mes')!="")
								<option value="{{ old('mes') }}">{{ old('mes') }}</option>
							@endif
							@if (old('mes')=="")
								<option value="">Seleccione mes..</option>
							@endif
							<option  value="01">01</option>
							<option value="02">02</option>
							<option  value="03">03</option>
							<option value="04">04</option>
							<option  value="05">05</option>
							<option value="06">06</option>
							<option  value="07">07</option>
							<option value="08">08</option>
							<option  value="09">09</option>
							<option value="10">10</option>
							<option  value="11">11</option>
							<option value="12">12</option>
						</select>
				
			</div>
			<div class="col-md-2">
				<label>Año</label>
				
						<select id="tipo" name="anio"  class="form-control">
							@if (old('anio')!="")
								<option value="{{ old('anio') }}">{{ old('anio') }}</option>
							@endif
							@if (old('anio')=="")
								<option value="">Seleccione año..</option>
							@endif
							<option  value="2017">2017</option>
							<option  value="2018">2018</option>
							<option  value="2019">2019</option>
						</select>
				
			</div>

		</div>
		<br>
		<input class="btn btn-success" type="submit" value="Aplicar fecha" name="">
	</form>
	<hr>
	 {!! Charts::assets() !!}

	 {!! $chart_vistas->render() !!}
	
	<hr>

	<label><strong>Vistas en total: {{ $vistastotal }}</strong></label>
</div>


</div>
@endsection
