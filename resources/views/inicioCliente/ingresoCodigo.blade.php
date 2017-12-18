<title>Codigo Recuperacion</title>
@extends('inicioCliente.clienteMaster')

@section('content')

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
				        {{ Session::get('ingresado') }} <a href="{{ url('/sesion_cliente') }}">Ingresar a mi cuenta</a>
			    </div>
			@endif
			@if (Session::has('ingreso'))
				<div class="alert alert-info">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <center><label>{{ Session::get('ingreso') }}</label> </center>
			    </div>
			@endif



		<div class="container">
			<hr><h1 class="text-center">Recupera tu Contraseña</h1><hr>
			<div class="row caja-sesion">
				<div class="col-xs-12 col-sm-12 col-md-6 mdl-shadow--6dp">

			<form action="{{ url('/ingresoCodigo') }}" method="POST">
				{{ csrf_field() }}

				<br><div class="form-group row">
								<label for="ema" class="col-sm-5 col-form-label">Ingrese nuevamente su correo: </label>
								<div class="col-sm-6">
							    	<input type="email" class="form-control" id="ema" name="correo" value="{{ old('correo') }}">
								</div>
						    </div><br>

				<br><div class="form-group row">
								<label for="cod" class="col-sm-5 col-form-label">Ingrese su codigo: </label>
								<div class="col-sm-6">
							    	<input type="text" class="form-control" id="cod" name="codigo">
								</div>
						    </div><br>

				<br><div class="form-group row">
								<label for="pass" class="col-sm-5 col-form-label">Ingrese su nueva contraseña: </label>
								<div class="col-sm-6">
							    	<input type="password" class="form-control" id="pass" name="clave">
								</div>
						    </div><br>

				<br><div class="form-group row">
								<label for="rpass" class="col-sm-5 col-form-label">Repita su nueva contraseña: </label>
								<div class="col-sm-6">
							    	<input type="password" class="form-control" id="rpass" name="rclave">
								</div>
						    </div><br>

				

				 <div class="form-group">
							<div class="boton-sesion text-center">	
							  	<p>
							  	<button type="submit" class="btn btn-raised btn-success">Restablecer contraseña</button>
								<a href="recuperarContrasena" class="btn btn-raised btn-primary">Atras</a>	
								</p>
							</div>
						</div>
			</form>	


		</div>
		</div>
		</div>

		
	</div>
</div>
@endsection