@extends('institucion.master_institucion')

@section('content')

<div class="margen well">
<div class="row">
	<div class="col-md-offset-1 col-md-3">
		<img src="{{ url($foto) }}" class="img img-thumbnail img-responsive tamanio" >
	</div>
	<div class="col-md-4">
		<p><strong class="nombreblue" ><i class="fa fa-user" aria-hidden="true"></i> {{$usuario->nombres.' '.$usuario->apellidos}}</strong></p>
		<p><strong class="correo" ><i class="fa fa-envelope" aria-hidden="true"></i> {{$usuario->email}}</strong></p>
		<p><strong class="numero" ><label><i class="fa fa-phone" aria-hidden="true"></i> {{$vendedor}}</label></strong></p>

	</div>
</div>
	
</div>

@endsection