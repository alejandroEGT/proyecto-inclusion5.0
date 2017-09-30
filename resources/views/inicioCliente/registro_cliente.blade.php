<title>Registro</title>
@extends('inicioCliente.clienteMaster')

@section('content')

<h1 class="text-center">Registrate</h1>
	<div class="android-drawer-separator"></div>
<br>
		<div class="container ">
			<div class="row caja-sesion">
				<div class="col-xs-12 col-sm-12 col-md-6 mdl-shadow--6dp">
					<form action="/registro_cliente" method="post">
						{{csrf_field()}}
						<div class="contenido-sesion">				
								<div class="form-row">
								  	<div class="col">
								    <label for="exampleInputEmail1" class="bmd-label-floating">Nombres</label>
								    <input type="text" class="form-control" id="formGroupExampleInput" name="nombres">
								  </div>

								  <div class="col">
									<label for="exampleInputEmail1" class="bmd-label-floating">Apellidos</label>
								    <input type="text" class="form-control" id="formGroupExampleInput" name="apellidos">
								  </div>
								</div><br>
							  
							  <div class="form-group">
							    <label for="exampleSelect1" class="bmd-label-floating">Sexo</label>
							    <select class="form-control" id="exampleSelect1" name="sexo">

							     @foreach ($sexo as $sex)

									<option value="{{$sex->id}}">{{ $sex->nombre }}</option>

								 @endforeach

							    </select>
							</div>

							  <div class="form-group">
								<label for="exampleInputEmail1" class="bmd-label-floating">Telefono</label>
							    <input type="number" class="form-control" id="formGroupExampleInput" name="telefono">
							  </div>

							   <div class="form-group">
							    <label for="exampleInputEmail1" class="bmd-label-floating">Correo electronico</label>
							    <input type="email" class="form-control" id="exampleInputEmail1" name="correo">
							  </div>

							  <div class="form-group">
							    <label for="exampleInputPassword1" class="bmd-label-floating">Contraseña</label>
							    <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
							  </div>

							  <div class="form-group">
							    <label for="exampleInputPassword1" class="bmd-label-floating">Repita Contraseña</label>
							    <input type="password" class="form-control" id="exampleInputPassword1" name="repPass">
							  </div>
						</div>

						<div class="form-group">
							<div class="boton-sesion text-center">	
							  	<p>
							  	<button type="submit" class="btn btn-primary btn-outline-success">Registrarse</button>
								<a href="inicio_cliente" class="btn btn-primary btn-outline-info">Atras</a>	
								</p>
							</div>
						</div>
					</form>

						  <div class="android-drawer-separator"></div>
						  <p class="contenido-sesion">Entra con:</p>
						<form action="" method="">
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
				<div class="android-drawer-separator"></div>
			</<div></div>>


@endsection