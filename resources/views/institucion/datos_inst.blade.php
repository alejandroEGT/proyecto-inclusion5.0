@extends('institucion.master_institucion')


@section('content')
	<div class="margen">
	<br>
		<div class="row">
			<div class="col-md-12">
				<center><label>Datos de la Institución</label>
				<div class="ico-security" ></div></center>
			</div>
			
		</div>
		<hr>

		<div class="row">
			<div class="col-md-offset-2 col-md-7">
			
				<label><strong>Nombre </strong></label><small> {{Auth::guard('institucion')->user()->nombre}}</small>
				<button data-toggle="collapse" data-target="#nombre" class="btn btn-xs btn-success" >Editar</button>

				<div id="nombre" class="collapse">
					<div class="alert alert-info" role="alert">
					  <p><strong>Actualizar Nombre</strong> </p>
					  <p><input class="" type="" name="">
							<button>Guardar</button></p>	
					</div>
												
				</div>
				<hr>
				<label><strong>Razón Social </strong></label><small> {{Auth::guard('institucion')->user()->razonSocial}}</small>
				<button data-toggle="collapse" data-target="#rs" class="btn btn-xs btn-success" >Editar</button>

				<div id="rs" class="collapse">
							<div class="alert alert-info" role="alert">
							  <p><strong>Actualizar Razón Social</strong> </p>
							  <p><input class="" type="" name="">
									<button>Guardar</button></p>	
							</div>					
								
				</div>
				<hr>
				<label><strong>Nª Teléfono 1 </strong></label><small> {{Auth::guard('institucion')->user()->telefono1}}</small>
				<button data-toggle="collapse" data-target="#tel1" class="btn btn-xs btn-success" >Editar</button>

				<div id="tel1" class="collapse">
							<div class="alert alert-info" role="alert">
							  <p><strong>Actualizar Teléfono 1</strong> </p>
							  <p><input class="" type="" name="">
									<button>Guardar</button></p>	
							</div>
				</div>
				<hr>
				<label><strong>Nª Teléfono 2 </strong></label><small> {{Auth::guard('institucion')->user()->telefono2}}</small>
				<button data-toggle="collapse" data-target="#tel2" class="btn btn-xs btn-success" >Editar</button>

				<div id="tel2" class="collapse">
						<div class="alert alert-info" role="alert">
						  <p><strong>Actualizar Teléfono 2</strong> </p>
						  <p><input class="" type="" name="">
								<button>Guardar</button></p>	
						</div>

				</div>
				<hr>
				<label><strong>Dirección </strong></label><small> {{Auth::guard('institucion')->user()->direccion}}</small>
				<button data-toggle="collapse" data-target="#dir" class="btn btn-xs btn-success" >Editar</button>

				<div id="dir" class="collapse">
							<div class="alert alert-info" role="alert">
							  <p><strong>Actualizar Dirección</strong> </p>
							  <p><input class="" type="" name="">
									<button>Guardar</button></p>	
							</div>

				</div>
				<hr>
				<label><strong>Correo </strong></label><small> {{Auth::guard('institucion')->user()->email}}</small>
				<button data-toggle="collapse" data-target="#correo" class="btn btn-xs btn-success" >Editar</button>

				<div id="correo" class="collapse">
							<div class="alert alert-info" role="alert">
							  <p><strong>Actualizar Correo</strong> </p>
							  <p><input class="" type="" name="">
									<button>Guardar</button></p>	
							</div>

				</div>
				<hr>
				<label><strong>Contraseña </strong></label><small> (No visible) </small>
				<button data-toggle="collapse" data-target="#clave" class="btn btn-xs btn-success" >Editar</button>

				<div id="clave" class="collapse">
							<div class="alert alert-info" role="alert">
							  <p><strong>Actualizar Contraseña</strong> </p>
							  <p><small>Contraseña actual </small><input class="" type="" name="">
							  <p><small>Contraseña Nueva </small><input class="" type="" name="">
							  <p><small>Repetir Contraseña Nueva </small><input class="" type="" name="">
									<button>Guardar</button></p>	
							</div>

				</div>
				<hr>
		
			</div>

		</div>
	</div>
@endsection