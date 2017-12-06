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
				        {{ Session::get('ingresado') }} <a href="{{ url('/login_institucion') }}">Ingresar a mi cuenta</a>
			    </div>
			@endif
			@if (Session::has('ingreso'))
				<div class="alert alert-info">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <center><label>{{ Session::get('ingreso') }}</label> </center>
			    </div>
			@endif

<div class="row top">
	<div class="col-md-offset-3 col-md-6 panel">
		<center>
			<form action="{{ url('/resetPassGo') }}" method="POST">
				{{ csrf_field() }}
				<label>Ingrese nuevamente su correo</label>
				<div class="row">
					 <div class="col-md-offset-2 col-md-8">
					 	<p><input type="email" name="correo" value="{{ old('correo') }}" placeholder="Correo" class="form-control input"> </p>
					 </div>
				</div>
				<br>
				<label>Ingrese su codigo</label>
				<div class="row">
					 <div class="col-md-offset-3 col-md-6">
					 	<p><input type="text" name="codigo" placeholder="##Codigo##" class="form-control input"> </p>
					 </div>
				</div>
				<hr>	
				<label>Ingrese su nueva contraseña</label>
				<div class="row">
					 <div class="col-md-offset-2 col-md-8">
					 	<p><input type="password" name="clave" placeholder="Nueva contraseña" class="form-control input"> </p>
					 </div>
				</div>
				<label>Repita su nueva contraseña</label>
				<div class="row">
					 <div class="col-md-offset-2 col-md-8">
					 	<p><input type="password" name="rclave" placeholder="Repita contraseña" class="form-control input"> </p>
					 </div>
				</div>

				<div class="row">
					 <div class="col-md-offset-3 col-md-6">
					 	<p><input type="submit" class="btn btn-success" value="Reestablecer contraseña" name=""> </p>
					 </div>
				</div>
			</form>	
		</center>

		
	</div>
</div>
@endsection