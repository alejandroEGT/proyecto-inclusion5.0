@extends('invitado.master_invitado')

@section('content')
		<div class="padding color-verde">
			<div class="row">
					<div class="col-md-offset-3 col-md-6">
					<h3>Login de Institución</h3>
					<h4>Bienvenido a nuestro proyecto</h4>
					<div class="ico-institution"></div>
					</div>
			</div>
		</div>
		@if (count($errors))
				<div class="row">
					<div class="col-md-offset-3 col-md-6">
						<div class="alert alert-danger">
						    <a href="" class="close" data-dismiss="alert">&times;</a>
						    @foreach ($errors->all() as $e)
								<ul>
									<li>{{ $e }}</li>
								</ul>
							@endforeach
						</div>
					</div>
				</div>	
			@endif
		<div class="container">
			<form action="/login_institucion" method="post">
				<div class="padding container animated fadeInUp">
						<div class="row">
							<div class="col-md-offset-4 col-md-4">
								{{ csrf_field() }}
								<label for="">Correo</label>
								<input class="form-control input " placeholder="correo" type="text" name="correo" autofocus value="{{ old('correo') }}">
								<label for="">Clave</label>
								<input class="form-control input" placeholder="clave" type="password" name="clave">
							</div>
						</div><br>
						<div class="row">
							<div class="col-md-offset-4 col-md-4">
								<input class="btn btn-primary btn-block" type="submit" value="Iniciar">

							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-offset-4 col-md-4">
								<center>
									<label><a href="{{ url('/formInstitucion') }}">Crear una cuenta de institución</a></label>
									<label><a href="{{ url('/recuperarPassword') }}">¿ Olvidaste tu contraseña ?</a></label>
								</center>
								
							</div>
						</div>
				</div>		
			</form>
		</div>			
		
			
@endsection











	






