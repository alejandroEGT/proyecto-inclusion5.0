@extends('encargadoArea.master_encargadoArea')

@section('content')

<div class="row">
	<div class="col-md-12">
	<a href="{{ url('encargadoArea/inicio') }} "><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
		<center><label>Equipo</label>
		<img src="/ico/group.png" width="40" ></center>
		<hr>
		<label><a href="{{ url('encargadoArea/agregarAlumno') }}">+ Agregar alumno</a></label>
	</div>
			
</div>
<hr>
<div class="row">
	<div class="col-md-offset-2 col-md-9">
		<div class="row">
	@if (count($equipo)>0)
		@foreach ($equipo as $eq)
		<div class="col-md-3 box-perfil">
			<p><img class="img-circle foto-perfil-vendedor" src="{{ '/'.$eq->foto }}"></p>
			<p><label>{{ $eq->nombres.' '.$eq->apellidos }}</label></p>
			<a href="{{ url('encargadoArea/verDetalleAlumno/'.base64_encode($eq->id_user)) }}" class="btn btn-primary btn-xs btn-block" >ver.. | <i class="fa fa-eye" aria-hidden="true"></i></a>
		</div>
		
	@endforeach
	@endif
	

</div>
	</div>
</div>
@endsection