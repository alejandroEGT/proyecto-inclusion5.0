@extends('inicioCliente.clienteMaster')

@section('content')

<h1 class="text-center">Registrate</h1>
	<div class="android-drawer-separator"></div>

		<div class="container ">
			<div class="row caja-sesion">
				<div class="col-xs-12 col-sm-12 col-md-6 mdl-shadow--6dp">
					<form>
						<div class="contenido-sesion">				
							  <div class="form-group">
							    <label for="exampleInputEmail1" class="bmd-label-floating">Nombre</label>
							    <input type="texr" class="form-control" id="formGroupExampleInput">
							    <span class="bmd-help">Nunca compartiremos tu correo electrónico con nadie más.</span>
							  </div>

							  <div class="form-group">
								<label for="exampleInputEmail1" class="bmd-label-floating">Apellido Paterno</label>
							    <input type="text" class="form-control" id="formGroupExampleInput">
							    <span class="bmd-help">Nunca compartiremos tu correo electrónico con nadie más.</span>
							  </div>

							  <div class="form-group">
								<label for="exampleInputEmail1" class="bmd-label-floating">Apellido Materno</label>
							    <input type="text" class="form-control" id="formGroupExampleInput">
							    <span class="bmd-help">Nunca compartiremos tu correo electrónico con nadie más.</span>
							  </div>

							  <div class="form-group">
								<label for="exampleInputEmail1" class="bmd-label-floating">Fecha Nacimiento</label>
							    <input type="date" class="form-control" id="formGroupExampleInput">
							    <span class="bmd-help">Nunca compartiremos tu correo electrónico con nadie más.</span>
							  </div>
							  
							  <div class="form-group">
							    <label for="exampleSelect1" class="bmd-label-floating">Sexo</label>
							    <select class="form-control" id="exampleSelect1">
							      <option>Seleccione</option>
							      <option>Hombre</option>
							      <option>Mujer</option>
							      <option>No especificar</option>
							    </select>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1" class="bmd-label-floating">Telefono</label>
							    <input type="number" class="form-control" id="formGroupExampleInput">
							    <span class="bmd-help">Nunca compartiremos tu correo electrónico con nadie más.</span>
							  </div>

							   <div class="form-group">
							    <label for="exampleInputEmail1" class="bmd-label-floating">Correo electronico</label>
							    <input type="email" class="form-control" id="exampleInputEmail1">
							    <span class="bmd-help">Nunca compartiremos tu correo electrónico con nadie más.</span>
							  </div>

							  <div class="form-group">
							    <label for="exampleInputPassword1" class="bmd-label-floating">Contraseña</label>
							    <input type="password" class="form-control" id="exampleInputPassword1">
							  </div>

							  <div class="form-group">
							    <label for="exampleInputPassword1" class="bmd-label-floating">Repita Contraseña</label>
							    <input type="password" class="form-control" id="exampleInputPassword1">
							  </div>
						</div>

						<div class="form-group text-center">
							<div class="boton-sesion">	
							  	<a href="#" class="btn btn-primary btn-outline-success">Registrate</a>
								<a href="inicio_cliente" class="btn btn-primary btn-outline-info">Atras</a>	
							</div>
						</div>

						  <div class="android-drawer-separator"></div>
						  <p class="contenido-sesion">Entra con:</p>

						  <div class="form-group text-center">
							  <button type="button" class="btn btn-info bmd-btn-fab">
							  <i class="ion-social-facebook"></i>
							  </button>

							  <button type="button" class="btn btn-danger bmd-btn-fab">
							  <i class="ion-social-googleplus"></i>
							  </button>
						  </div>
						</div>

					</form>
			
				</div>
				<div class="android-drawer-separator"></div>
			</div>


@endsection