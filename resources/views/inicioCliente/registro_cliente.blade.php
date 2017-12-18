<title>Registro</title>
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
				<hr><h1 class="text-center">Formulario de registro</h1><hr>
			<div class="row caja-sesion">
				<div class="col-xs-12 col-sm-12 col-md-5 panel">

					<form action="/registro_cliente" method="post">
						{{csrf_field()}}
						<div class="contenido-sesion">				
						  		<div class="form-group row">
								    <label for="nombre" class="col-sm-3 col-form-label">Nombres: </label>
								    <div class="col-sm-8">  
								       <input type="text" class="form-control" id="nombre" name="nombres">
								    </div>
								 </div><br>

								 <div class="form-group row">
								    <label  for="ape" class="col-sm-3 col-form-label">Apellidos: </label>
								    <div class="col-sm-8">  
								       <input type="text" class="form-control" id="ape" name="apellidos">
								    </div>
								 </div><br>

								 <div class="form-group row">
								    <label for="sex" class="col-sm-3 col-form-label">Sexo: </label>
								    <div class="col-sm-8">  
								           <select class="form-control" id="sex" name="sexo">

										     @foreach ($sexo as $sex)

												<option value="{{$sex->id}}">{{ $sex->nombre }}</option>

											 @endforeach

							    			</select>
								    </div>
								 </div><br>
							  
							
						    <div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Telefono: </label>
								<div class="col-sm-8">
							    	<input type="number" class="form-control" id="" name="telefono">
								</div>
						    </div><br>

						    <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">Correo electronico: </label>
							    <div class="col-sm-8">
							    	<input type="email" class="form-control" id="" name="correo">
							    </div>	
						    </div><br>

						    <div class="form-group row">
							    <label for="pa" class="col-sm-3 col-form-label">Contraseña: </label>
							    <div class="col-sm-8">
							    	<input type="password" class="form-control" id="pa" name="pass">
							    </div>
						    </div><br>

						    <div class="form-group row">
							    <label for="repa" class="col-sm-3 col-form-label">Repita Contraseña: </label>
							    <div class="col-sm-8">
							    	<input type="password" class="form-control" id="repa" name="repPass">
							    </div>
						    </div><br>
						</div>


						<div class="form-group">
							<div class="boton-sesion text-center">	
							  	<p>
							  	<button type="submit" class="btn btn-raised btn-success">Registrarse</button>
								<a href="inicio_cliente" class="btn btn-raised btn-primary">Atras</a>	
								</p>
							</div>
						</div>
					</form>
				</div>

				<div class="android-drawer-separator"></div>
			
			</div>
		</div>

	<div class="android-drawer-separator"></div>
			
@endsection