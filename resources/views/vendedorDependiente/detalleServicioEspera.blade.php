@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
 	@if (count($servicio))
	<br>
	<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
	<center><label>Detalle del Servcicio</label></center>
	<hr>
	<div class="row panel">
		@if (count($errors))
				
						<div class="alert alert-danger">
						    <a href="" class="close" data-dismiss="alert">&times;</a>
						    @foreach ($errors->all() as $e)
								<ul>
									<li>{{ $e }}</li>
								</ul>
							@endforeach
						</div>
				
			@endif
		@if (Session::has('correcto'))
				<div class="alert alert-info">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        {{ Session::get('correcto') }}
			    </div>
		@endif
		<div class="col-md-offset-1 col-md-3 ">
			<img src="{{ '/'.$servicio[0]->foto }}" class="img-thumbnail img-responsive">
			<br>
			<center><a data-toggle="collapse" data-target="#campo1" > Actualizar foto del servicio <i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a></center>
			
				<div id="campo1" class="collapse">
								<div class="alert alert-info" role="alert">
									<form action="{{ url('encargadoArea/actualizar_servicio_foto') }}" enctype="multipart/form-data" method="post">
									{{csrf_field()}}
								  		<p><strong>Actualizar Foto</strong> </p>
								  	
								  		<p>
								  		<label for="file-input" class="label-foto-link">
				 							<img src="/ico/image.png" for="file-input" class="label-foto-link">
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
			<p><label><strong>Nombre:</strong></label> {{ $servicio[0]->nombre }} <a data-toggle="collapse" data-target="#nombre" ><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
			<div id="nombre" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('encargadoArea/actualizar_servicio_nombre') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Nombre</strong> </p>
							  		<input type="hidden" name="idServicio" value="{{$servicio[0]->id}}">
							  		<p><input class="" type="text" maxlength="50" name="nombre">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
			</div>

			<p><label><strong>Descripción:</strong></label> {{ $servicio[0]->descripcion }} <a data-toggle="collapse" data-target="#des" ><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
			<div id="des" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('encargadoArea/actualizar_servicio_descripcion') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Descripción</strong> </p>
							  		<input type="hidden" name="idServicio" value="{{$servicio[0]->id}}">
							  		<p><input class="" type="text" maxlength="250" name="descripcion">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
			</div>
			<p><label><strong>Categoría:</strong></label> {{ $servicio[0]->nombreCategoria }} <a data-toggle="collapse" data-target="#can" ><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
			<div id="can" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('encargadoArea/actualizar_servicio_categoria') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Categoría</strong> </p>
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

			
			{{-- expr --}}
			<p><label><strong>Visibilidad:</strong></label> {{ $servicio[0]->nombreEstado }} </p>
			
			
				<p><label><strong>Área o especialidad:</strong></label> {{ $servicio[0]->nombreArea }}</p>
				
			
			<hr>
			<p><label><strong>Creado:</strong></label> {{ date('h:i:s - d/m/Y', strtotime($servicio[0]->creado)) }}</p>
		</div>
	</div>
	
@endif

@if (!count($servicio))
	<center><p style="font-size: 19px" >Nada para mostrar</p></center>
@endif
@endsection