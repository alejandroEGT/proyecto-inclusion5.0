<title>Recuperar Contraseña</title>
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

		@if (Session::has('Advertencia'))
			<div class="alert alert-info">
		    <a href="" class="close" data-dismiss="alert">&times;</a>
			        {{ Session::get('Advertencia') }}
		    </div>
		@endif


		<div class="container">
				<hr><h1 class="text-center">Recupera tu Contraseña</h1><hr>
			<div class="row caja-sesion">
				<div class="col-xs-12 col-sm-12 col-md-6 mdl-shadow--6dp">

			<form action="{{ url('/recuperarContrasena') }}" method="POST">
				{{ csrf_field() }}

							<br><div class="form-group row">
								<label for="ema" class="col-sm-5 col-form-label">Ingrese su correo electronico: </label>
								<div class="col-sm-6">
							    	<input type="email" class="form-control" id="ema" name="correo">
								</div>
						    </div><br>

						    <div class="form-group">
							<div class="boton-sesion text-center">	
							  	<p>
							  	<button type="submit" class="btn btn-raised btn-success">Enviar codigo</button>
								<a href="sesion_cliente" class="btn btn-raised btn-primary">Atras</a>	
								</p>
							</div>
						</div>

						    
			</form>	
		<br>
		<center><a href="{{ url('/ingresoCodigo') }}">Tengo pendiente un codigo de verificación</a></center>

<br>
				</div>

				<div class="android-drawer-separator"></div>
			
			</div>
		</div>

			
@endsection