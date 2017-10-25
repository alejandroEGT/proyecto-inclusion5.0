@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')

<div class="">
	<br>
		<div class="row">
			<div class="col-md-12">
			<a href="{{ url('userDependiente/inicio') }} "><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
				<center><label>Datos del Alumno</label>
				<div class="ico-security" ></div></center>
			</div>
			
		</div>
		<hr>
		
		<div class="row">
		@if (count($errors))
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-danger">
						    <a href="" class="close" data-dismiss="alert">&times;</a>
						    @foreach ($errors->all() as $e)
								<ul>
									<center><li>{{ $e }}</li></center>
								</ul>
							@endforeach
						</div>
					</div>
				</div>	
			@endif
			@if (Session::has('ingresado'))
				<div class="alert alert-info">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <center>{{ Session::get('ingresado') }}</center>
			    </div>
			@endif
			<div class="col-md-offset-2 col-md-7">
				<img src="{{'/'.$alumno[0]->foto}}" height="100" width="110" ><br>
				<a data-toggle="collapse" data-target="#foto" href="#"><label>Actualizar foto de perfil</label></a>
				
				<div id="foto" class="collapse">
					<div class="alert alert-info" role="alert">
						<form action="{{ url('userDependiente/actualizar_foto') }}" method="post" enctype="multipart/form-data">
						 {{csrf_field()}}
					  		<p>
								<label for="file-input" class="label-foto-link">
				 				<img src="/ico/image.png" for="file-input" class="label-foto-link">
										 	Agregar foto..
								</label>
								<input style="display: none;" name="foto" id="file-input" type="file"/>	
								  	<input type="hidden" name="idUser" value="{{Auth::user()->id}}">
								<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
						</form>	
					</div>
												
				</div>
				<hr>
			
				<label><strong>Nombres </strong></label><small> {{Auth::user()->nombres}}</small>
				<button data-toggle="collapse" data-target="#nombre" class="btn btn-xs btn-success" >Editar</button>

				<div id="nombre" class="collapse">
					<div class="alert alert-info" role="alert">
						<form action="{{ url('userDependiente/actualizar_nombre') }}" method="post">
						 {{csrf_field()}}
					  		<p><strong>Actualizar Nombres</strong> </p>
					  		<p><input class="" type="" name="nombre">
							<input type="submit" value="Guardar" name=""></p>	
						</form>	
					</div>
												
				</div>
				<hr>
				<label><strong>Apellidos </strong></label><small> {{Auth::user()->apellidos}}</small>
				<button data-toggle="collapse" data-target="#rs" class="btn btn-xs btn-success" >Editar</button>

				<div id="rs" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('userDependiente/actualizar_apellido') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Apellidos</strong> </p>
							  		<p><input class="" type="" name="apellido">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>					
								
				</div>
				<hr>
				<label><strong>Nª Teléfono </strong></label><small> {{ $alumno[0]->telefono}}</small>
				<button data-toggle="collapse" data-target="#tel1" class="btn btn-xs btn-success" >Editar</button>

				<div id="tel1" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('userDependiente/actualizar_tel') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Teléfono</strong> </p>
							  		<p><input class="" type="" name="teléfono">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
				</div>
				<hr>
				
				<label><strong>Dirección </strong></label><small> (Aún no identificada)</small>
				<button data-toggle="collapse" data-target="#dir" class="btn btn-xs btn-success" >Editar</button>

				<div id="dir" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('userDependiente/actualizar_direccion') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Dirección</strong> </p>
							  		<p><input class="" type="" name="dirección">
									<input type="submit" value="Guardar" name="direccion"></p>	
								</form>	
							</div>

				</div>
				<hr>
				<label><strong>Correo </strong></label><small> {{Auth::user()->email}}</small>
				<button data-toggle="collapse" data-target="#correo" class="btn btn-xs btn-success" >Editar</button>

				<div id="correo" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('userDependiente/actualizar_correo') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Correo</strong> </p>
							  		<p><input class="" type="" name="correo">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>

				</div>
				
				<hr>
				<label><strong>Contraseña </strong></label><small> (No visible) </small>
				<button data-toggle="collapse" data-target="#clave" class="btn btn-xs btn-success" >Editar</button>

				<div id="clave" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('userDependiente/actualizar_clave') }}" method="post">
								{{ csrf_field() }}
							  		<p><strong>Actualizar Contraseña</strong> </p>
							  		<p><small>Contraseña actual </small><input class="" type="password" name="clave_actual">
							  		<p><small>Contraseña Nueva </small><input class="" type="password" name="clave_nueva">
							  		<p><small>Repetir Contraseña Nueva </small><input class="" type="password" name="confirm_clave_nueva">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>

				</div>
				<hr>
				<label><strong>Área </strong></label><small> {{ $alumno[0]->nombreArea }} </small><br>
				<label><strong>Institución </strong></label><small> {{ $alumno[0]->nombreInstitucion }} </small>
		
			</div>

		</div>
	</div>

@endsection