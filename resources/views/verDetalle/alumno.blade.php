@if (empty($alumno[0]))
	<center><p style="font-size: 19px" >Nada para mostrar</p></center>
@endif
@if (!empty($alumno[0]))
<center>
<div class="row">
	<div class="col-md-12">
		<center><img src="{{ '/'.$alumno[0]->foto }}" class="foto-update deta_alumno img-circle" data-toggle="collapse" data-target="#foto" >
			<div id="foto" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_foto_alumno') }}" enctype='multipart/form-data' method="POST">
									{{ csrf_field() }}
									<p><label for="file-input" class="label-foto-link">
									<input type="hidden" name="idUser" value="{{$alumno[0]->idUser}}">
									 	<img src="/ico/image.png" height="50" for="file-input" class="label-foto-link">
									 	Actualizar foto..
									</label></p>
									<input style="display: none;" name="foto" id="file-input" type="file"/>
									<br>
									<input type="submit" value="Guardar foto">
								</form>
							</div>
			</div>
		</center>
	</div>	
</div>
@if ($errors->all())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif
@if (Session::has('correcto'))
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-info">
										    <a href="" class="close" data-dismiss="alert">&times;</a>
										     {{ Session::get('correcto') }}
										</div>
									</div>
								</div>	
								
							@endif
<hr>
<div class="row">
	<div class="col-md-12 ">
		<p><label>Nombres:</label> <label>{{ $alumno[0]->nombre }}</label> <a data-toggle="collapse" data-target="#nom" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a></p>

		<div id="nom" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_nombre_alumno') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Nombres</strong> </p>
							  		<input type="hidden" name="idUser" value="{{$alumno[0]->idUser}}">
							  		<p><input class="" type="text" maxlength="250" name="nombres">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar"></p>	
								</form>	
							</div>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-12 ">
		<p><label>Apellidos:</label> <label>{{ $alumno[0]->apellidos }}</label> <a data-toggle="collapse" data-target="#ape"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></p>

		<div id="ape" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_apellido_alumno') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Apellidos</strong> </p>
							  		<input type="hidden" name="idUser" value="{{$alumno[0]->idUser}}">
							  		<p><input class="" type="text" maxlength="250" name="apellidos">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar"></p>	
								</form>	
							</div>
		</div>
	</div>
</div>	
<div class="row">	
	<div class="col-md-12 ">
		{{App::setLocale('es_ES')}}
		<p><label>Fecha de nacimiento:</label> <label>{{ date('d/m/Y', strtotime($alumno[0]->fecha)) }}</label> <a data-toggle="collapse" data-target="#fech"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></p>

		<div id="fech" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_fecha_alumno') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Fecha de nacimiento</strong> </p>
							  		<input type="hidden" name="idUser" value="{{$alumno[0]->idUser}}">
							  		<p><input class="" type="date" maxlength="250" name="fecha">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar"></p>	
								</form>	
							</div>
		</div>
	</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<p><label>Correo:</label> <label>{{ $alumno[0]->correo }}</label> <a data-toggle="collapse" data-target="#cor"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></p>

		<div id="cor" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_correo_alumno') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Correo</strong> </p>
							  		<input type="hidden" name="idUser" value="{{$alumno[0]->idUser}}">
							  		<p><input class="" type="text" maxlength="250" name="correo">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar"></p>	
								</form>	
							</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<p><label>Telefono celular:</label> <label>{{ $alumno[0]->telefono }}</label> <a data-toggle="collapse" data-target="#tel"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></p>

		<div id="tel" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_numero_alumno') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Telefono celular</strong> </p>
							  		<input type="hidden" name="idUser" value="{{$alumno[0]->idUser}}">
							  		<p><input class="" type="text" maxlength="9" name="numero">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar"></p>	
								</form>	
							</div>
		</div>
	</div>
</div>	
	@if ($user == 1)
		<div class="row" >	
			<div class="col-md-12">
				<p><label>Área:</label>
					<label>{{ $alumno[0]->nombreArea }}</label>
					<a data-toggle="collapse" data-target="#area"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
				</p>

				<div id="area" class="collapse">
									<div class="alert alert-info" role="alert">
										<form action="{{ url($ruta.'/actualizar_area_alumno') }}" method="post">
										{{csrf_field()}}
									  		<p><strong>Actualizar área</strong> </p>
									  		<input type="hidden" name="idUser" value="{{$alumno[0]->idUser}}">
									  		<p><select name="area">
												<option value="">Seleccione..</option>
												@foreach ($area as $a)
													<option value="{{ $a->id }}">{{ $a->nombre }}</option>
												@endforeach
											</select>
											<input class="btn btn-primary btn-xs" type="submit" value="Guardar" ></p>	
										</form>	
									</div>
				</div>
				
			</div>
		</div>
	@endif
	</center>


@endif