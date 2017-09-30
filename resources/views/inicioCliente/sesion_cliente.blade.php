
<title>Iniciar Sesión</title>

@extends('inicioCliente.clienteMaster')

@section('content')

	<h1 class="text-center">Iniciar Sesion</h1>
	<div class="android-drawer-separator"></div>

	<div class="container ">
		<div class="row caja-sesion">
			<div class="col-xs-12 col-sm-12 col-md-6 mdl-shadow--6dp">
<<<<<<< HEAD
				<form action="/sesion_cliente" method="post">
=======
				<form action="" method="post">
>>>>>>> 9ac3340fc5a565e32ef1115b55b844863d3b6a9c
					{{csrf_field()}}
					<div class="contenido-sesion">
										
					  <div class="form-group">
					    <label for="exampleInputEmail1" class="bmd-label-floating">Correo electronico</label>
					    <input type="email" class="form-control" id="exampleInputEmail1" name="correo">
					    <span class="bmd-help">Nunca compartiremos tu correo electrónico con nadie más.</span>
					  </div>
					
					  <div class="form-group">
					    <label for="exampleInputPassword1" class="bmd-label-floating">Contraseña</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
					    <br><a href="">¿Olvido su contraseña?</a>
					  </div>		

					</div>

					<div class="boton-sesion">	
					  	<button type="submit" class="btn btn-primary btn-raised">Iniciar sesión</button>
					</div>
					  	<br><p align="right"><a href="registro_cliente" class="registro-sesion">¡Regístrate gratis!</a></p>
				</form>


					  <div class="android-drawer-separator"></div>
					  <p class="contenido-sesion">Entra con:</p>
					<form action="" method="post">
						{{csrf_field()}}
					  <div class="form-group text-center">
						  <button type="button" class="btn btn-info bmd-btn-fab">
						  <i class="ion-social-facebook"></i>
						  </button>

						  <button type="button" class="btn btn-danger bmd-btn-fab">
						  <i class="ion-social-googleplus"></i>
						  </button>
					  </div>
					</form>
				</div>

			
		
		</div>
	</div>



@endsection