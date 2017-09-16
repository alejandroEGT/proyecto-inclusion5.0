@extends('institucion.master_institucion')

@section('content')
<div class="margen">
	
<div class="row">
	<div class="col-md-10 col-xs-12">
	<p>Cantidad de alumnos por area</p>
	{{ $areas }}
			<!--<canvas id="myChart" width="100" height="60"></canvas>-->
			<div id="top_x_div" style="width: 500px; height: 200px;"></div>
	</div>
</div>

</div>
@endsection

@section('js')
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable(
        {!! $areas !!}
        );

        var options = {
          title: 'Chess opening moves',
          width: 700,
          legend: { position: 'none' },
          chart: { title: 'Chess opening moves',
                   subtitle: 'popularity by percentage' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Cantidad'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
@endsection