
<title>Iniciar Sesión</title>

@extends('inicioCliente.clienteMaster')

@section('content')

@if ($errors->all())
			    <div class="alert alert-danger">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li class="validacionRequest"><label>{{ $error }}</label></li>
				            @endforeach
				        </ul>
			    </div>
			@endif
	


	<div class="container">
		<hr><h1 class="text-center">Iniciar Sesion</h1><hr>
		<div class="row caja-sesion">
			<div class="col-xs-12 col-sm-12 col-md-6 panel">

				<form action="/sesion_cliente" method="post">

					{{csrf_field()}}
					<div class="contenido-sesion">
										
					  <div class="form-group row">
					    <label for="ema" class="col-sm-4 col-form-label">Correo electronico:</label>
					    <div class="col-sm-8">
					    	<input type="email" class="form-control" id="ema" name="correo">
					    </div>
					  </div>
					
					  <div class="form-group row">
					    <label for="pa" class="col-sm-4 col-form-label">Contraseña:</label>
					    <div class="col-sm-8">
					    	<input type="password" class="form-control" id="pa" name="pass">
						</div>
					  </div>		
					</div>


					<br><div class="boton-sesion text-center">	
					  	<center><button type="submit" class="btn btn-raised btn-success">Iniciar sesión</button></center>
					</div><br>
					<center><a href="{{ url('/recuperarContrasena') }}">¿Olvido su contraseña?</a></center><br>
					  	<p align="right">
					  		<a href="registro_cliente" class="registro-sesion">¡Regístrate gratis!</a>
					  	</p>
				</form>

				{{--<form class="form-horizontal" action="/login/facebook" method="post">
					{{csrf_field()}}
					<div class="form-group text-center">	
					   <button type="submit" class="btn btn-raised btn-info"> Ingresar con <i class="ion-social-facebook"></i>
					  </button>
					</div>  
				</form>

				<form class="form-horizontal" action="/login/google" method="post">
                 	{{ csrf_field() }}
                 	<div class="form-group text-center">	
					  <button type="submit" class="btn btn-raised btn-danger"> Ingresar con <i class="ion-social-googleplus"></i>
					  </button>
					</div>
				</form>--}}


			</div>
		</div>
	</div>
	<div class="android-drawer-separator"></div><br>

@endsection