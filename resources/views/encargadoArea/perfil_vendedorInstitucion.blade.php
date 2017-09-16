@extends('encargadoArea.master_encargadoArea')

@section('content')

<div class=" well">
<div class="row">
	<div class="col-md-offset-1 col-md-3">
		<img src="{{ url($foto) }}" class="img img-thumbnail img-responsive img-circle tamanio" >
	</div>
	<div class="col-md-4">
		<p><strong class="nombreblue" ><i class="fa fa-user" aria-hidden="true"></i> {{$usuario->nombres.' '.$usuario->apellidos}}</strong></p>
		<p><strong class="correo" ><i class="fa fa-envelope" aria-hidden="true"></i> {{$usuario->email}}</strong></p>
		<p><strong class="numero" ><label><i class="fa fa-phone" aria-hidden="true"></i> {{$vendedor}}</label></strong></p>
		<p><label>Institución perteneciente: </label> <a href="{{ url("encargadoArea/perfil_institucion/".base64_encode($institucion->id)."") }}">{{ $institucion->nombre }}
		<img src="{{ '/'.$institucion->logo}}" height="40"></a></p>
		<hr>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

	</div>
</div>
	
</div>

@endsection