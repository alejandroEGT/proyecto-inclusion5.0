@extends('invitado.master_invitado')

@section('content')
		<div class="padding color-verde">
			<div class="row">
					<div class="col-md-offset-3 col-md-6">
					<h3>Login para encargado de área</h3>
					<h4>Bienvenido a nuestro proyecto</h4>
					<div class="ico-speaker"></div>
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
			<form action="/login_encargado" method="post">
				<div class="padding container animated fadeInUp">
						<div class="row">
							<div class="col-md-offset-4 col-md-4">
								{{ csrf_field() }}
								<label for="">Correo</label>
								<input class="form-control input " placeholder="correo" type="text" name="correo" value="{{ old('correo') }}" autofocus>
								<label for="">Clave</label>
								<input class="form-control input" placeholder="clave" type="password" name="clave">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-offset-4 col-md-4">
								<input class="btn btn-info input-btn" type="submit" value="Iniciar">
							</div>
						</div>
				</div>		
			</form>
		</div>			
		<hr>
		<div class="row">
			<div class="col-md-offset-3 col-md-6">
				<center>
					<label style="color: #117A65" ><i class="fa fa-info-circle fa-3x" aria-hidden="true"></i> En caso de que no tengas acceso a tu cuenta tienes que solicitarle a tu institución que te genere una nueva contraseña.</label>
				</center>
			</div>
		</div>
			
@endsection