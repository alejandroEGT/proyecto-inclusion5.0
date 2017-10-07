@extends('inicioCliente.clienteMaster')

<title>Mi perfil</title>
@section('content')

<div class="container-fluid">
	<div class="row">

		<div class="col-md-2"><br>
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
			  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-expanded="true">Mis Datos</a>
			  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-expanded="true">Mis Compras</a>
			  <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-expanded="true">Por definir</a>
			</div>
		</div>

		<div class="col-md-3">
			<br><div class="card" style="width: 100%">
			 <img class="card-img-top" src="../foto_productos/1507269297.jpg" alt="Card image cap">
			  <div class="card-body">
			    <h5 class="card-text misDatos">Nombre:</h5>
			    <p class="card-text">{{Auth::user()->nombres}}</p>
			    <h5 class="card-text misDatos">Apellidos:</h5>
			    <p class="card-text">{{Auth::user()->apellidos}}</p>
			    <h5 class="card-text misDatos">Correo electronico:</h5>
			    <p class="card-text">{{Auth::user()->email}}</p>
			  </div>
			</div>
		</div>


		
		<div class="col-md-6">	

			<br><div class="tab-content" id="v-pills-tabContent">
				<!--Mis Datos-->
			  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"> 	
				<div id="accordion" role="tablist">

				  <div class="card">
				    <div class="card-header" role="tab" id="headingOne">
				      <h5 class="mb-0">
				        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          Cambiar correo electronico:
				        </a>
				      </h5>
				    </div>

				    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
				      <div class="card-body">
				  			<form action="" method="">
				  				{{csrf_field()}}

							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-3 col-form-label">Nuevo correo</label>
							    <div class="col-sm-5">  
							       <input type="email" class="form-control" id="exampleInputEmail1" name="correo" placeholder="email@ejemplo.cl">
							    </div>
							  </div>

							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-3 col-form-label">Repita correo</label>
							    <div class="col-sm-5">
							      <input type="email" class="form-control" id="exampleInputEmail1" name="rCorreo" placeholder="email@ejemplo.cl">
							    </div>
							  </div>

						      <div class="boton-sesion row">	
				  				<button type="submit" class="btn btn-primary btn-outline-success">Guardar</button>
							  </div>
						  
							</form>
				      </div>
				    </div>
				  </div>

				  <div class="card">
				    <div class="card-header" role="tab" id="headingTwo">
				      <h5 class="mb-0">
				        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				          Cambiar contraseña:
				        </a>
				      </h5>
				    </div>

				    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
				      <div class="card-body">
				    		<form action="" method="">
				  				{{csrf_field()}}

				  			  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-3 col-form-label">Contraseña antigua</label>
							    <div class="col-sm-5">  
							       <input type="password" class="form-control" id="exampleInputEmail1" name="passAntigua" placeholder="******">
							    </div>
							  </div>

							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-3 col-form-label">Nuevo contraseña</label>
							    <div class="col-sm-5">  
							       <input type="password" class="form-control" id="exampleInputEmail1" name="passNueva" placeholder="******">
							    </div>
							  </div>

							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-3 col-form-label">Repita contraseña</label>
							    <div class="col-sm-5">
							      <input type="password" class="form-control" id="exampleInputEmail1" name="repPassNueva" placeholder="******">
							    </div>
							  </div>

						      <div class="boton-sesion row">	
				  				<button type="submit" class="btn btn-primary btn-outline-success">Guardar</button>
							  </div>
						  
							</form>
				      </div>
				    </div>
				  </div>

				  <div class="card">
				    <div class="card-header" role="tab" id="headingThree">
				      <h5 class="mb-0">
				        <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				          Cambiar numero de telefono:
				        </a>
				      </h5>
				    </div>

				    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
				      <div class="card-body">
				       	<form action="" method="">
				  				{{csrf_field()}}

							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-3 col-form-label">Nuevo  N° Telefono</label>
							    <div class="col-sm-5">  
							       <input type="number" class="form-control" id="exampleInputEmail1" name="telefono" placeholder="+56998765432">
							    </div>
							  </div>

							  <div class="form-group row">
							    <label for="staticEmail" class="col-sm-3 col-form-label">Repita N° Telefono</label>
							    <div class="col-sm-5">
							      <input type="number" class="form-control" id="exampleInputEmail1" name="repTelefono" placeholder="+56998765432">
							    </div>
							  </div>

						      <div class="boton-sesion row">	
				  				<button type="submit" class="btn btn-primary btn-outline-success">Guardar</button>
							  </div>
						  
						</form>
				      </div>
				    </div>
				  </div>

				</div>  	
			  </div>
				<!--Mis Compras-->
			  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

			  	{{Auth::user()->email}}

			  </div>

				<!--Por Definir-->
			  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

			  hola

			</div>

			</div>
		</div>

	</div>
</div>

</div>

@endsection 