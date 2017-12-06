@if (count($servicio))
	<br>
	<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
	<center><label>Detalle del Servicio</label></center>
	<hr>
	<div class="row panel">
		@if (count($errors))
				
						<div class="alert alert-danger">
						    <a href="" class="close" data-dismiss="alert">&times;</a>
						    @foreach ($errors->all() as $e)
								<ul>
									<li><label>{{ $e }}</label></li>
								</ul>
							@endforeach
						</div>
				
			@endif
		@if (Session::has('correcto'))
				<div class="alert alert-info">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <label>{{ Session::get('correcto') }}</label>
			    </div>
		@endif
		<div class="col-md-offset-1 col-md-3 ">
			<img src="{{ '/'.$servicio[0]->foto }}" alt="foto de {{ $servicio[0]->nombre }}" class="img-thumbnail img-responsive">
			<br>
			<center><a data-toggle="collapse" data-target="#campo1" > Actualizar foto del servicio <i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a></center>
			
				<div id="campo1" class="collapse">
								<div class="alert alert-info" role="alert">
									<form action="{{ url($ruta.'/actualizar_servicio_foto') }}" enctype="multipart/form-data" method="post">
									{{csrf_field()}}
								  		<p><label><strong>Actualizar Foto</strong></label> </p>
								  	
								  		<p>
								  		<label for="file-input" class="label-foto-link">
				 							<img src="/ico/image.png" alt="" for="file-input" class="label-foto-link">
										 	Agregar foto..
										</label>
										<input style="display: none;" name="foto" id="file-input" type="file"/>	
								  			<input type="hidden" name="idServicio" value="{{$servicio[0]->id}}">
										<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
									</form>	
								</div>
				</div>
				<br><br>
		</div>
		<div class="col-md-6 ">
			<p><label><strong>Nombre:</strong></label> <label>{{ $servicio[0]->nombre }}</label> <a data-toggle="collapse" data-target="#nombre" ><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
			<div id="nombre" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_servicio_nombre') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Nombre</strong></label> </p>
							  		<input type="hidden" name="idServicio" value="{{$servicio[0]->id}}">
							  		<p><input class="" type="text" maxlength="50" name="nombre" placeholder="Nombre">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
			</div>

			<p><label><strong>Descripción:</strong></label> <label>{{ $servicio[0]->descripcion }}</label> <a data-toggle="collapse" data-target="#des" ><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
			<div id="des" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_servicio_descripcion') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Descripción</strong></label> </p>
							  		<input type="hidden" name="idServicio" value="{{$servicio[0]->id}}">
							  		<p><input class="" type="text" maxlength="250" name="descripcion" placeholder="Descripción">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
			</div>
			<p><label><strong>Categoría:</strong></label> <label>{{ $servicio[0]->nombreCategoria }}</label> <a data-toggle="collapse" data-target="#can" ><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
			<div id="can" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_servicio_categoria') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Categoría</strong></label> </p>
							  		<input type="hidden" name="idServicio" value="{{$servicio[0]->id}}">
							  		<p><select name="categoria">
							  			<option value="" >Seleccione..</option>
							  			@foreach ($categoria as $c)
							  				<option value="{{$c->id}}" >{{ $c->nombre }}</option>
							  			@endforeach
							  		</select>
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
			</div>

			@if ($user == 1 || $user == 2)
			{{-- expr --}}
			<p><label><strong>Visibilidad:</strong></label> <label>{{ $servicio[0]->nombreEstado }}</label> <a data-toggle="collapse" data-target="#vis" ><i class="fa fa-pencil" aria-hidden="true"></i></a>. (Apto para la visualización en la tienda)</p>
			<div id="vis" class="collapse">
										<div class="alert alert-info" role="alert">
											<form action="{{ url($ruta.'/actualizar_servicio_visibilidad') }}" method="post">
											{{csrf_field()}}
										  		<p><label><strong>Actualizar Estado</strong></label> </p>
										  		<input type="hidden" name="idServicio" value="{{$servicio[0]->id}}">
										  		<p>
										  			<select name="estado" >
										  				<option value="">Seleccione..</option>
										  				@foreach ($estadoS as $e)
										  					<option value="{{ $e->id }}">{{ $e->estado }}</option>
										  				@endforeach
										  			</select>
										  		</p>
												<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
											</form>	
										</div>
			</div>
			@endif	
			@if ($user == 1)
				<p><label><strong>Área o especialidad:</strong></label> <label>{{ $servicio[0]->nombreArea }}</label> <a data-toggle="collapse" data-target="#area" ><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
				<div id="area" class="collapse">
										<div class="alert alert-info" role="alert">
											<form action="{{ url($ruta.'/actualizar_servicio_area') }}" method="post">
											{{csrf_field()}}
										  		<p><label><strong>Actualizar área o especialidad</strong></label> </p>
										  		<input type="hidden" name="idServicio" value="{{$servicio[0]->id}}">
										  		<p>
										  			<select name="area">
										  				<option value="">Seleccione..</option>
										  				@foreach ($area as $a)
										  					
										  					<option value="{{$a->id}}">{{$a->nombre}}</option>
										  				@endforeach
										  			</select>
										  		</p>
												<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
											</form>	
										</div>
			</div>
			@endif
			<hr>
			<p><label><strong>Creado:</strong></label> <label>{{ date('h:i:s - d/m/Y', strtotime($servicio[0]->creado)) }}</label></p>
		</div>
	</div>
	
@endif

@if (!count($servicio))
	<center><p style="font-size: 19px" >Nada para mostrar</p></center>
@endif