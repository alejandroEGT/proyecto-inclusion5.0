@extends('encargadoArea.master_encargadoArea')

@section('content')
	
	<div class=" well color-sky">
<div class="row">
	<div class="col-md-offset-1 col-md-3">
		<center><img src="{{ '/'.$institucion->logo }}" class="img img-thumbnail tamanio-inst" ></center>
	</div>
	<div class="col-md-4">
		<p><strong class="nombreblue" ><i class="fa fa-user" aria-hidden="true"></i> {{$institucion->nombre}}</strong></p>
		<p><strong class="correo" ><i class="fa fa-envelope" aria-hidden="true"></i> {{$institucion->email}}</strong></p>
		<p><strong class="numero" ><label><i class="fa fa-phone" aria-hidden="true"></i> {{ $institucion->telefono1 }}</label></strong></p>
		<p><strong class="numero" ><label><i class="fa fa-phone" aria-hidden="true"></i> {{ $institucion->telefono2 }}</label></strong></p>
		<hr>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>
</div>
	
</div>
@endsection