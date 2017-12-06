@extends('institucion.master_institucion')

@section('content')

	<p><center><label>Reportes de ventas</label></center></p>

 {{-- Charts::assets() --}}

 {{-- $chart->render() --}}
	<div class="row">
		<div class="col-md-2">
			@if ($fechas)
			<p><label>Fecha de reporte</label></p>
				<form id="form_fecha" action="{{ url('institucion/traerVentas_fecha') }}" method="get">
					{{ csrf_field() }}
					<select id="fecha" name="fecha" class="form-control" >
						<option value="" >Seleccione fecha</option>
					@foreach ($fechas as $f)
						<option value="{{ $f->fecha }}" >{{ date('d/m/Y', strtotime($f->fecha)) }}</option>
					@endforeach
				</select>
					<br>
					<a class="btn btn-info btn-xs" href="{{ url('institucion/verVentas') }}">Ver todas las ventas</a>
				</form>

			@endif
		</div>
		<div class="col-md-2">
			<p>Total de todas las ventas:</p> <strong class="lbl-strong" > ${{ $total }}</strong>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-hover">
				<tr>
					<td>Fecha</td>
					<td>Id venta</td>
					<td>Estado</td>
					{{--<td>Total</td>--}}
					<td>Opción</td>
				</tr>
			
				@foreach ($ventas as $v)
					<tr>
						<td>{{ date('d/m/Y', strtotime($v->fecha)) }}</td>
						<td>{{ $v->id_venta }}</td>
						<td>{{ $v->nombre_estado}}</td>
						{{--<td>{{ $v->total}}</td>--}}
						
						<td><a href="{{ url('institucion/detalleVenta/'.$v->id_venta) }}" class="btn btn-xs btn-success">Ver detalle</a></td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function($) {
		$("#fecha").change(function(event) {
			$("#form_fecha").submit();
		});
	});
	</script>

@endsection