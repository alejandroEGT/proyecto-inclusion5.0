@extends('institucion.master_institucion')

@section('content')

	<p><center><label>Reportes de ventas</label></center></p>

 {{-- Charts::assets() --}}

 {{-- $chart->render() --}}
<div id="grafico"></div>
<div id="sliders">
    <table>
        <tr>
        	<td>Alpha Angle</td>
        	<td><input id="alpha" type="range" min="0" max="45" value="15"/> <span id="alpha-value" class="value"></span></td>
        </tr>
        <tr>
        	<td>Beta Angle</td>
        	<td><input id="beta" type="range" min="-45" max="45" value="15"/> <span id="beta-value" class="value"></span></td>
        </tr>
        <tr>
        	<td>Depth</td>
        	<td><input id="depth" type="range" min="20" max="100" value="50"/> <span id="depth-value" class="value"></span></td>
        </tr>
    </table>
</div>
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
	{{--<div class="container">
		<p class="text-right"><a href="{{ url('institucion/lista_clientes') }}"><i class="fa fa-flag-checkered" aria-hidden="true"></i> Seguimiento de comprador</a></p>
	</div>--}}
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
@section('js')
	<script src="/code/highcharts.js"></script>
<script src="/code/highcharts-3d.js"></script>
<script src="/code/modules/exporting.js"></script>


		<script type="text/javascript">

// Set up the chart
var chart = new Highcharts.Chart({
    chart: {
        renderTo: 'grafico',
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        }
    },
    title: {
        text: 'Cantidad de ventas en el tiempo'
    },
    subtitle: {
        text: 'Gráfico tipo 3D'
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
     xAxis: {
    	value: 'jano',
        categories: {!! json_encode($array_fecha)  !!}
    },

    series: [{
    	name: 'Cantidad de ventas',
        data: {!! json_encode($array_cantidad) !!},
    }]
});

function showValues() {
    $('#alpha-value').html(chart.options.chart.options3d.alpha);
    $('#beta-value').html(chart.options.chart.options3d.beta);
    $('#depth-value').html(chart.options.chart.options3d.depth);
}

// Activate the sliders
$('#sliders input').on('input change', function () {
    chart.options.chart.options3d[this.id] = parseFloat(this.value);
    showValues();
    chart.redraw(false);
});

showValues();
		</script>
@endsection