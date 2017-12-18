@extends('encargadoArea.master_encargadoArea')

@section('content')

	<p><center><label>Productos vendidos</label></center></p>

 {{-- Charts::assets() --}}

  {{-- $chart->render() --}}
	<div class="row">
		<div class="col-md-2">
			@if ($fechas)
			<p><label>Fecha de venta</label></p>
				<form id="form_fecha" action="{{ url('encargadoArea/traerVentas_fecha') }}" method="get">
					{{ csrf_field() }}
				<select id="fecha" name="fecha" class="form-control" >
						<option value="" >Seleccione fecha</option>
					@foreach ($fechas as $f)
						<option value="{{ $f->fecha }}" >{{ date('d/m/Y', strtotime($f->fecha)) }}</option>
					@endforeach
				</select>
					<br>
					<a class="btn btn-info btn-xs" href="{{ url('encargadoArea/verVentas') }}">Ver todas las ventas</a>
				</form>

			@endif
		</div>
		{{--<div class="col-md-2">
			<p>Total de todas las ventas:</p> <strong class="lbl-strong" > ${{ $total }}</strong>
		</div>--}}
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-hover">
				<tr>
					<td>Fecha</td>
					<td>Foto</td>
					<td>Nombre</td>
					<td>Precio de venta</td>
					<td>Cantidad</td>
					{{--<td>Total</td>--}}
					<td>total</td>
				</tr>
			
				@foreach ($ventas as $v)
					<tr>
						<td>{{ date('d/m/Y', strtotime($v->fecha)) }}</td>
						<td>
							<img src="{{'/'.$v->foto}}" class="sizeFP">
						</td>
						<td>{{ $v->nombre}}</td>
						<td>{{ $v->precio }}</td>
						<td>{{ $v->cantidad }}</td>
						{{--<td>{{ $v->total}}</td>--}}
						
						<td style="color: #16A085" >{{ $v->precio*$v->cantidad }}</td>
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