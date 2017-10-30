@extends('invitado.master_invitado')

@section('content')
<div class="padding color-verde">
			<div class="row">
					<div class="col-md-offset-3 col-md-6">
					<h3>Login de Institución</h3>
					<h4>Bienvenido a nuestro proyecto</h4>
					<div class="ico-pass"></div>
					</div>
			</div>
		</div>

<div class="row top">
	<div class="col-md-offset-3 col-md-6 panel">
		<center>
			<form action="{{ url('/resetPass') }}" method="POST">
				{{ csrf_field() }}
				<label>Ingrese su correo</label>
				<div class="row">
					 <div class="col-md-offset-1 col-md-8">
					 	<p><input type="email" name="correo" placeholder="Correo" class="form-control input"> </p>
					 </div>
					 <div class="col-md-2">
					 	<input type="submit" class="btn btn-success" value="Enviar Codigo" name="">
					 </div>
				</div>
			</form>	
		</center>
		<br>
		<center><a href="{{ url('/codigo_reset') }}">Tengo pendiente un codigo de verificación</a></center>

		@if ($errors->any())
			    <div class="alert alert-danger">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li class="validacionRequest"><label>{{ $error }}</label></li>
				            @endforeach
				        </ul>
			    </div>
			@endif
			@if (Session::has('ingresado'))
				<div class="alert alert-info">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        {{ Session::get('ingresado') }}
			    </div>
			@endif
	</div>
</div>
@endsection