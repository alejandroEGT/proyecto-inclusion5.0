@extends('vendedorIndependiente.master_vendedorIndependiente')

@section('content')

@if (is_null($servicios))
	<center><p style="font-size: 19px" >Nada para mostrar</p></center>
@endif
@if (!is_null($servicios))
	{{-- expr --}}

<br>
	<center><label>Detalle del servivio</label></center>
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
			
	<div class="col-md-offset-1 col-md-3">
		<img src="{{ '/'.$servicios->foto }}" class="img-thumbnail img-responsive"><br>
		<center><a data-toggle="collapse" data-target="#campo1" > Actualizar foto del servicio <i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a></center>
		
		<div id="campo1" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('userIndependiente/actualizar_servicio_foto') }}" enctype="multipart/form-data" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Foto</strong> </p>
							  	
							  		<p><input class="" type="file" name="foto">
							  			<input type="hidden" name="idProducto" value="{{$servicios->idServicio}}">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
		</div>
	</div>
	<div class="col-md-6">
		
			<p><label><strong>Nombre:</strong></label> {{ $servicios->nombreServicio }} <a data-toggle="collapse" data-target="#nombre" ><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
			<div id="nombre" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('userIndependiente/actualizar_servicio_nombre') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Nombre</strong> </p>
							  		<input type="hidden" name="idProducto" value="{{$servicios->idServicio}}">
							  		<p><input class="" type="text" maxlength="50" name="nombre">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
			</div>
			

			<p><label><strong>Descripción:</strong></label> {{ $servicios->descripcion }} <a data-toggle="collapse" data-target="#des" ><i class="fa fa-pencil" aria-hidden="true"></i></a></p>
			<div id="des" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('userIndependiente/actualizar_servicio_descripcion') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Descripción</strong> </p>
							  		<input type="hidden" name="idProducto" value="{{$servicios->idServicio}}">
							  		<p><input class="" type="text" maxlength="250" name="descripcion">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
			</div>

		
			<p><label><strong>Visibilidad:</strong></label> {{ $servicios->estadoServicio }} <a data-toggle="collapse" data-target="#vis" ><i class="fa fa-pencil" aria-hidden="true"></i></a>. (Apto para la visualización en la tienda)</p>
			<div id="vis" class="collapse">
										<div class="alert alert-info" role="alert">
											<form action="{{ url('userIndependiente/actualizar_servicio_visibilidad') }}" method="post">
											{{csrf_field()}}
										  		<p><strong>Actualizar Estado</strong> </p>
										  		<input type="hidden" name="idProducto" value="{{$servicios->idServicio}}">
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
		
			<p><label><strong>Categoría:</strong></label> {{ $servicios->nombreCategoria }} <a data-toggle="collapse" data-target="#cat" ><i class="fa fa-pencil" aria-hidden="true"></i></a> </p>
			<div id="cat" class="collapse">
										<div class="alert alert-info" role="alert">
											<form action="{{ url('userIndependiente/actualizar_servicio_categoria') }}" method="post">
											{{csrf_field()}}
										  		<p><strong>Actualizar Categoría</strong> </p>
										  		<input type="hidden" name="idProducto" value="{{$servicios->idServicio}}">
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

			
			<hr>
			<p><label><strong>Creado:</strong></label> {{ date('h:i:s - d/m/Y',strtotime($servicios->creado)) }}</p>
			
			
		</div>
	</div>
	
</div>	

@endif
@endsection
