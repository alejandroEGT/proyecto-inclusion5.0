@extends('institucion.master_institucion')

@section('content')
<div class="">
	
<div class="container">

	<hr>
	 <div class="row">
	 	<div class="col-md-5">
	 		<table class="table table-bordered">
				<tr class="tr-estilo">
	 				<td>Ubicación</td>
	 				<td>Cantidad de vistas</td>
	 			</tr>
	 			@foreach ($detalle as $d)
	 				@foreach ($d as $dd)
	 					<tr class="info">
	 						<td>{{ $dd->ubicación }}</td>
	 						<td>{{ $dd->suma }}</td>
	 					</tr>
	 				@endforeach
	 			@endforeach
	 		</table>
	 	</div>
	 	<div class="col-md-6">
	 		{!! Charts::assets() !!}

	 		{!! $chart_vistas->render() !!}
	 	</div>
	 </div>
	
	<hr>

	<label><strong>Vistas en total: {{ $vistastotal }}</strong></label>
</div>


</div>
@endsection
