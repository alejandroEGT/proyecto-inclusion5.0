
<title>Iniciar Sesión</title>

@extends('inicioCliente.clienteMaster')

@section('content')

	<br><h1 class="text-center">Iniciar Sesion</h1>
	<div class="android-drawer-separator"></div>


	<div class="container">
		<div class="row caja-sesion">
			<div class="col-xs-12 col-sm-12 col-md-6 mdl-shadow--6dp">

				<form action="/sesion_cliente" method="post">

					{{csrf_field()}}
					<div class="contenido-sesion">
										
					  <div class="form-group">
					    <label for="exampleInputEmail1" class="bmd-label-floating">Correo electronico</label>
					    <input type="email" class="form-control" id="exampleInputEmail1" name="correo">
					  </div>
					
					  <div class="form-group">
					    <label for="exampleInputPassword1" class="bmd-label-floating">Contraseña</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
					    <br><a href="">¿Olvido su contraseña?</a>
					  </div>		
					</div>

					<div class="boton-sesion">	
					  	<button type="submit" class="btn btn-primary btn-outline-success">Iniciar sesión</button>
					</div><br>
					  	<p align="right">
					  		<a href="registro_cliente" class="registro-sesion">¡Regístrate gratis!</a>
					  	</p>
				</form>

			    <div class="android-drawer-separator"></div>
				<form class="form-horizontal" action="/login/facebook" method="post">
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
				</form>


			</div>
		</div>
	</div>
	<div class="android-drawer-separator"></div><br>

@endsection