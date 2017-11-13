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
									<center><li><label>{{ $e }}</label></li></center>
								</ul>
							@endforeach
						</div>
					</div>
				</div>	
			@endif
			@if (Session::has('ingresado'))
				<div class="alert alert-info">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <center><label>{{ Session::get('ingresado') }}</label></center>
			    </div>
			@endif
			<div class="col-md-offset-2 col-md-7">
				<a data-toggle="collapse" data-target="#foto" href="#"><img src="{{'/'.$alumno[0]->foto}}" class="sizeLogo" alt="Actualizar mi foto" ></a><br>
				
				
				<div id="foto" class="collapse">
					<div class="alert alert-info" role="alert">
						<form action="{{ url('userDependiente/actualizar_foto') }}" method="post" enctype="multipart/form-data">
						 {{csrf_field()}}
					  		<p>
								<label for="file-input" class="label-foto-link">
				 				<img src="/ico/image.png" alt="" for="file-input" class="label-foto-link">
										 	Agregar foto..
								</label>
								<input style="display: none;" name="foto" id="file-input" type="file"/>	
								  	<input type="hidden" name="idUser" value="{{Auth::user()->id}}">
								<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
						</form>	
					</div>
												
				</div>
				<hr>
			
				<label><strong>Nombres </strong></label><small> <label>{{Auth::user()->nombres}}</label></small>
				<button data-toggle="collapse" data-target="#nombre" class="btn btn-xs btn-success" >Editar</button>

				<div id="nombre" class="collapse">
					<div class="alert alert-info" role="alert">
						<form action="{{ url('userDependiente/actualizar_nombre') }}" method="post">
						 {{csrf_field()}}
					  		<p><label><strong>Actualizar Nombres</strong></label> </p>
					  		<p><input class="" type="text" placeholder="Nombre" name="nombre">
							<input type="submit" value="Guardar" name=""></p>	
						</form>	
					</div>
												
				</div>
				<hr>
				<label><strong>Apellidos </strong></label><small> <label>{{Auth::user()->apellidos}}</label></small>
				<button data-toggle="collapse" data-target="#rs" class="btn btn-xs btn-success" >Editar</button>

				<div id="rs" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('userDependiente/actualizar_apellido') }}" method="post">
								{{csrf_field()}}
							  		<p><strong><label>Actualizar Apellidos</label></strong> </p>
							  		<p><input class="" type="text" placeholder="Apellidos" name="apellido">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>					
								
				</div>
				<hr>
				<label><strong>Nª Teléfono </strong></label><small> <label>{{ $alumno[0]->telefono}}</label></small>
				<button data-toggle="collapse" data-target="#tel1" class="btn btn-xs btn-success" >Editar</button>

				<div id="tel1" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('userDependiente/actualizar_tel') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Teléfono</strong></label> </p>
							  		<p><input class="" type="numeric" name="teléfono" placeholder="Teléfono">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
				</div>
				<hr>
				<label><strong>Fecha de Nacimiento </strong></label><small> <label>{{ date('d-m-Y', strtotime($alumno[0]->fecha))}}</label></small>
				<button data-toggle="collapse" data-target="#fecha" class="btn btn-xs btn-success" >Editar</button>

				<div id="fecha" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('userDependiente/actualizar_fecha') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Fecha de nacimiento</strong></label> </p>
							  		<p><input class="" type="date" name="fecha" placeholder="Fecha">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
				</div>
				<hr>
				
				<label><strong>Dirección </strong></label><small> <label>(Aún no identificada)</label></small>
				<button data-toggle="collapse" data-target="#dir" class="btn btn-xs btn-success" >Editar</button>

				<div id="dir" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('userDependiente/actualizar_direccion') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Dirección</strong></label> </p>
							  		<p><input class="" type="text" name="dirección" placeholder="Dirección">
									<input type="submit" value="Guardar" placeholder="Dirección" name="direccion"></p>	
								</form>	
							</div>

				</div>
				<hr>
				<label><strong>Correo </strong></label><small><label>{{Auth::user()->email}}</label></small>
				<button data-toggle="collapse" data-target="#correo" class="btn btn-xs btn-success" >Editar</button>

				<div id="correo" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('userDependiente/actualizar_correo') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Correo</strong></label> </p>
							  		<p><input class="" type="email" name="correo" placeholder="Correo">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>

				</div>
				
				<hr>
				<label><strong>Contraseña </strong></label><small> <label>(No visible)</label> </small>
				<button data-toggle="collapse" data-target="#clave" class="btn btn-xs btn-success" >Editar</button>

				<div id="clave" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('userDependiente/actualizar_clave') }}" method="post">
								{{ csrf_field() }}
							  		<p><label><strong>Actualizar Contraseña</strong></label> </p>
							  		<p><label><small>Contraseña actual </small></label><input class="" type="password" name="clave_actual" placeholder="Contraseña actual">
							  		<p><label><small>Contraseña Nueva </small></label><input class="" type="password" name="clave_nueva" placeholder="Contraseña nueva">
							  		<p><label><small>Repetir Contraseña Nueva </small></label><input class="" type="password" name="confirm_clave_nueva" placeholder="Confirmar contraseña">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>

				</div>
				<hr>
				<label><strong>Área </strong></label><small> <label>{{ $alumno[0]->nombreArea }}</label> </small><br>
				<label><strong>Institución </strong></label><small> <label>{{ $alumno[0]->nombreInstitucion }}</label> </small>
		
			</div>

		</div>
	</div>

@endsection