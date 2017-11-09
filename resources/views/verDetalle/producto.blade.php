<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
@if (is_null($productos[0]))
	<center><p style="font-size: 19px" >Nada para mostrar</p></center>
@endif
@if (!is_null($productos[0]))
	{{-- expr --}}

<br>
	<center><label>Detalle del producto</label></center>
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
			
	<div class="col-md-offset-1 col-md-3">
		<img src="{{ '/'.$productos[0]->foto }}" alt="foto de {{ $productos[0]->nombre }}" class="img-thumbnail img-responsive"><br>
		<center><a data-toggle="collapse" data-target="#campo1" > Actualizar foto del producto <i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a></center>
		
		<div id="campo1" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_producto_foto') }}" enctype="multipart/form-data" method="post">
								{{csrf_field()}}
							  		<p><strong><label>Actualizar Foto</label></strong> </p>
							  	
							  		<p><label for="file-input" class="label-foto-link">
				 							<img src="/ico/image.png" alt="" for="file-input" class="label-foto-link">
										 	Agregar foto..
										</label>
										<input style="display: none;" name="foto" id="file-input" type="file"/>	
								  			<input type="hidden" name="idProducto" value="{{$productos[0]->idProducto}}">
										<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
		</div>
	</div>
	<div class="col-md-6">
		
			<p><label><strong>Nombre:</strong></label> <label>{{ $productos[0]->nombre }}</label> <a data-toggle="collapse" data-target="#nombre" ><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
			<div id="nombre" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_producto_nombre') }}" method="post">
								{{csrf_field()}}
							  		<p><strong><label>Actualizar Nombre</label></strong> </p>
							  		<input type="hidden" name="idProducto" value="{{$productos[0]->idProducto}}">
							  		<p><input class="" type="text" maxlength="50" name="nombre" placeholder="Nombre">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
			</div>
			

			<p><label><strong>Descripción:</strong></label> <label>{{ $productos[0]->descripcion }}</label> <a data-toggle="collapse" data-target="#des" ><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
			<div id="des" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_producto_descripcion') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Descripción</strong></label> </p>
							  		<input type="hidden" name="idProducto" value="{{$productos[0]->idProducto}}">
							  		<p><input class="" type="text" maxlength="250" name="descripcion" placeholder="Descripción">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
			</div>
		@if ($user == 1 or $user == 2)	
			<p><label><strong>Precio CLP: $ </strong></label> <label>{{ number_format($productos[0]->precio, 0, ',', '.') }}</label> <a data-toggle="collapse" data-target="#pre" ><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
			<div id="pre" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_producto_precio') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Precio CLP</strong></label> </p>
							  		<input type="hidden" name="idProducto" value="{{$productos[0]->idProducto}}">
							  		<p><input class="" type="numeric" maxlength="7"  name="precio" placeholder="Precio">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
			</div>

			<p><label><strong>Cantidad:</strong></label> <label>{{ $productos[0]->cantidad }}</label> <a data-toggle="collapse" data-target="#can" ><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
			<div id="can" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url($ruta.'/actualizar_producto_cantidad') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Cantidad</strong></label></p>
							  		<input type="hidden" name="idProducto" value="{{$productos[0]->idProducto}}">
							  		<p><input class="" type="numeric" maxlength="4"  name="cantidad" placeholder="Cantidad">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
			</div>
		
			<p><label><strong>Visibilidad:</strong></label> <label>{{ $productos[0]->estadoProducto }} <a data-toggle="collapse" data-target="#vis" ><i class="fa fa-pencil" aria-hidden="true"></i></a>. (Apto para la visualización en la tienda)</label></p>
			<div id="vis" class="collapse">
										<div class="alert alert-info" role="alert">
											<form action="{{ url($ruta.'/actualizar_producto_visibilidad') }}" method="post">
											{{csrf_field()}}
										  		<p><label><strong>Actualizar Estado</strong></label> </p>
										  		<input type="hidden" name="idProducto" value="{{$productos[0]->idProducto}}">
										  		<p>
										  			<select name="estadoV" >
										  				<option value="">Seleccione..</option>
										  				@foreach ($estadoP as $e)
										  					<option value="{{ $e->id }}">{{ $e->estado }}</option>
										  				@endforeach
										  			</select>
										  		</p>
												<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
											</form>	
										</div>
			</div>
		@endif
			<p><label><strong>Categoría:</strong></label> <label>{{ $productos[0]->nombreCategoria }}</label> <a data-toggle="collapse" data-target="#cat" ><i class="fa fa-pencil" aria-hidden="true"></i></a> </p>
			<div id="cat" class="collapse">
										<div class="alert alert-info" role="alert">
											<form action="{{ url($ruta.'/actualizar_producto_categoria') }}" method="post">
											{{csrf_field()}}
										  		<p><label><strong>Actualizar Categoría</strong></label> </p>
										  		<input type="hidden" name="idProducto" value="{{$productos[0]->idProducto}}">
										  		<p>
										  			<select name="categoria" >
										  				<option value="">Seleccione..</option>
										  				@foreach ($categoria as $c)
										  					
										  					<option value="{{$c->id}}">{{$c->nombre}}</option>
										  				@endforeach
										  			</select>
										  		</p>
												<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
											</form>	
										</div>
			</div>

			@if ($user == 1)
				<p><label><strong>Área o especialidad:</strong></label> <label>{{ $productos[0]->nombreArea }}</label> <a data-toggle="collapse" data-target="#area" ><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
				<div id="area" class="collapse">
										<div class="alert alert-info" role="alert">
											<form action="{{ url($ruta.'/actualizar_producto_area') }}" method="post">
											{{csrf_field()}}
										  		<p><label><strong>Actualizar Categoría</strong></label> </p>
										  		<input type="hidden" name="idProducto" value="{{$productos[0]->idProducto}}">
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
			<p><label><strong>Creado:</strong></label> <label>{{ date('h:i:s - d-m-Y',strtotime($productos[0]->creado)) }}</label></p>
			
			
		</div>
	</div>
	
</div>	

@endif
