
<div class=" well background-blue">
	<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
<div class="row">
	<div class="col-md-offset-1 col-md-3">
		<img src="{{ url($foto) }}" alt="foto de {{ $usuario->nombres.' '.$usuario->apellidos }}" class="img img-thumbnail img-responsive img-circle tamanio" >
	</div>
	<div class="col-md-4">
		<p><strong class="nombreblue" ><i class="fa fa-user" aria-hidden="true"></i><label> {{$usuario->nombres.' '.$usuario->apellidos}}</label></strong></p>
		<p><strong class="correo" ><i class="fa fa-envelope" aria-hidden="true"></i> <label>{{$usuario->email}}</label></strong></p>
		<p><strong class="numero" ><label><i class="fa fa-phone" aria-hidden="true"></i> {{$vendedor}}</label></strong></p>
		<p><strong class="numero" ><label>Alumno</label></strong></p>
		<p><label>Institución perteneciente: </label> <a href="{{ url($ruta."/perfil_institucion/".base64_encode($institucion->id)."") }}">{{ $institucion->nombre }}
		<img src="{{ '/'.$institucion->logo}}" height="40"></a></p>
	</div>
</div>
</div>
<hr>
<div class="row">
	<div class="col-md-offset-1 col-md-10 panel ">
		
		@if (count($productos))
		<center><label>Productos</label></center>
		<hr>
			@foreach ($productos as $producto)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$producto->foto }}" alt="foto de {{ $producto->nombre }}" class="img-thumbnail img-prod ">
									<p>{{ str_limit($producto->nombre,10) }}</p>
									<p><label class="lbl-precio" >$ {{ number_format($producto->precio,0,',','.') }}</label></p>
									<p><a href="{{ url($ruta.'/detalleProducto/'.base64_encode($producto->idProducto).'/'.$idInstitucion) }}" class="btn btn-primary btn-xs">Ver</a>
									</p>
								</center>

							</div>	
			@endforeach
			<center class="center-top" ><small><a href="{{ url($ruta.'/ver_todo_producto_alumno/'.base64_encode($vendedor_id)) }}">Ver más..</a></small></center>
		@endif
		@if (!count($productos))
			<label>No hay productos</label>
		@endif
		<hr>
		@if (count($servicios))
		<center><label>Servicios</label></center>
		<hr>
			@foreach ($servicios as $servicio)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$servicio->foto }}" class="img-thumbnail img-prod ">
									<p>{{ str_limit($servicio->nombre,10) }}</p>
									<p><a href="{{ url($ruta.'/detalleServicio/'.base64_encode($servicio->id).'/'.$idInstitucion) }}" class="btn btn-primary btn-xs">Ver</a>
									</p>
								</center>

							</div>	
							@endforeach
							<center class="center-top" ><small><a href="{{ url($ruta.'/ver_todo_servicio_alumno/'.base64_encode($vendedor_id)) }}">Ver más..</a></small></center>
		@endif
		@if (!count($servicios))
			<label>No hay servicios</label>
		@endif
		
	</div>
</div>