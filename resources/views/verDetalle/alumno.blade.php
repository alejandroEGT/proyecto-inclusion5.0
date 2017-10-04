@if (empty($alumno[0]))
	<center><p style="font-size: 19px" >Nada para mostrar</p></center>
@endif
@if (!empty($alumno[0]))

<div class="row">
	<div class="col-md-12">
		<center><img src="{{ '/'.$alumno[0]->foto }}" class="deta_alumno img-circle">
			<p><a href="">Actualizar foto <i class="fa fa-camera" aria-hidden="true"></i></a></p>
		</center>
	</div>
	
</div>
<hr>
<div class="row">
	<div class="col-md-offset-2 col-md-3">
		<p>Nombres: {{ $alumno[0]->nombre }} <a data-toggle="collapse" data-target="#nom" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a></p>

		<div id="nom" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_producto_descripcion') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Nombres</strong> </p>
							  		<input type="hidden" name="idP" value="{{$alumno[0]->idUser}}">
							  		<p><input class="" type="text" maxlength="250" name="descripcion">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
		</div>
	</div>
	<div class="col-md-3">
		<p>Apellidos: {{ $alumno[0]->apellidos }} <a data-toggle="collapse" data-target="#ape"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></p>

		<div id="ape" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_producto_descripcion') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Apellidos</strong> </p>
							  		<input type="hidden" name="idP" value="{{$alumno[0]->idUser}}">
							  		<p><input class="" type="text" maxlength="250" name="descripcion">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
		</div>
	</div>
	<div class="col-md-3">
		<p>Correo: {{ $alumno[0]->correo }} <a data-toggle="collapse" data-target="#cor"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></p>

		<div id="cor" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_producto_descripcion') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Correo</strong> </p>
							  		<input type="hidden" name="idP" value="{{$alumno[0]->idUser}}">
							  		<p><input class="" type="text" maxlength="250" name="descripcion">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-offset-2 col-md-3">
		<p>Estado: 
			<select>
				<option>Seleccione..</option>
			</select>
			 <a data-toggle="collapse" data-target="#estado"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
		</p>

		<div id="estado" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_producto_descripcion') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Estado</strong> </p>
							  		<input type="hidden" name="idP" value="{{$alumno[0]->idUser}}">
							  		<p><input class="" type="text" maxlength="250" name="descripcion">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
		</div>
	</div>
	@if ($user == 1)
	<div class="col-md-3">
		<p>Área:
			<select>
				<option>Seleccione...</option>
			</select>
			<a data-toggle="collapse" data-target="#area"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
		</p>

		<div id="area" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_producto_descripcion') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar área</strong> </p>
							  		<input type="hidden" name="idP" value="{{$alumno[0]->idUser}}">
							  		<p><input class="" type="text" maxlength="250" name="descripcion">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
		</div>
		
	</div>
	@endif
	<div class="col-md-3">
		<p>Telefono celular: {{ $alumno[0]->telefono }} <a data-toggle="collapse" data-target="#tel"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></p>

		<div id="tel" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_producto_descripcion') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Telefono celular</strong> </p>
							  		<input type="hidden" name="idP" value="{{$alumno[0]->idUser}}">
							  		<p><input class="" type="text" maxlength="250" name="descripcion">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
		</div>
	</div>
</div>

@endif