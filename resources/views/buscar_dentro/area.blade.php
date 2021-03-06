<br>
<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
<center><label class="titulodearea" >Área o especialidad de la institución {{ $institucion->nombre }}</label></center>

<div class="row">
	<div class="col-md-offset-1 col-md-3">
			<div class="row">
				<div class="col-md-12 well blanco">
					@if ($area->logo != null)
					<center>
						<img src="{{'/'.$area->logo}}" class="img-logo">
						<br><br>
						<p><label>{{ $area->nombre }}</label></p>
					</center>			
				
					@endif
					@if ($area->logo == null)
						<center><label>(No existe logo)</label>
						<br><br>
						<p><label>{{ $area->nombre }}</label></p>
						</center>
					@endif
					<hr>
				</div>
			</div>
			@if (!empty($encargado))
			<div class="row">
				<div class="col-md-12 well blanco">
					<label>Encargado(a):</label><hr>
					<div class="row">
						<div class="col-md-4">
							<img src="{{'/'.$encargado->foto}}" class="sizeLogo img-circle"> 
						</div>
						<div class="col-md-8">
							<label class="letra-pequenia">{{$encargado->nombres.' '.$encargado->apellidos}}</label>
						</div>
					</div>
				</div>
			</div>
			@endif
			@if (empty($encargado))
				<div class="row">
					<div class="col-md-12 well blanco">
						<label>No existe encargado(a)..</label>
					</div>
				</div>
			@endif
			@if (count($alumnos)>0)

				<div class="row">
					<div class="col-md-12 well blanco">
						<label>Alumnos:</label>
						<hr>
						@foreach ($alumnos as $a)
							<a href="{{ url($ruta.'/perfil_venInst/'.base64_encode($a->id_user)) }}" ><img src="{{'/'.$a->foto}}" class="sizeFP " alt="{{ $a->nombres.' '.$a->apellidos }}" > </a>
						@endforeach
					</div>
				</div>
			@endif

	</div>
	<div class="col-md-7">
		<div class="row">
			<div class="col-md-12  well blanco">
					<label class="lbl-desc"><p>{{ $area->descripcion }}</p></label>
					<p><img src="{{ '/'.$institucion->logo }}" class="sizeLogoMin" ></p>
					<p><label><strong>Institución: </strong> {{$institucion->nombre}} </label></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12  well blanco">
					@if (count($productos)>0)
					<div class="row">
						<div class="col-md-11 linea-gris fondo-blanco">
							<center><label>Productos del área o especialidad</label></center>
							<hr>	
							@foreach ($productos as $producto)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$producto->foto }}" class="img-thumbnail img-prod " alt="foto de {{ $producto->nombre }}">
									<p>{{ str_limit($producto->nombre, 10) }}</p>
									<p><label class="lbl-precio" > $ {{ number_format($producto->precio, 0, ',','.') }}</label></p>
										<a class="btn btn-primary btn-xs" href="{{ url($ruta."/detalleProducto/".base64_encode($producto->idProducto).'/'.base64_encode($institucion->id)) }}">Ver..</a>
										
								</center>

							</div>	
							@endforeach
							<!--<center>{{--$productos->links() --}}</center>-->
							<center class="center-top" ><label><small><a href="{{ url($ruta.'/ver_todo_producto_area/'.base64_encode($area->id)) }}">Ver mas..</a></small></label></center>
						</div>

					</div>
					<hr>
				@endif
				@if (!count($productos))
					<center>
						<label>No Existen productos para mostrar</label>
						<img src="/ico/sad.png">
					</center>
					<hr>
				@endif
				@if (count($servicios)>0)
					<div class="row">
						<div class="col-md-12">
							<center><label>Servicios</label> <i class="fa fa-star-o" aria-hidden="true"></i></center>
							<hr>
							
							@foreach ($servicios as $servicio)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$servicio->foto }}" class="img-thumbnail img-prod ">
									<p>{{ str_limit($servicio->nombre, 10) }}</p>
									<p><a href="{{ url($ruta.'/detalleServicio/'.base64_encode($servicio->id).'/'.base64_encode($institucion->id)) }}" class="btn btn-primary btn-xs">Ver</a></p>
								</center>

							</div>	
							@endforeach

							<center class="center-top" ><label><small><a href="{{ url($ruta.'/ver_todo_servicio_area/'.base64_encode($area->id)) }}">Ver mas..</a></small></label></center>
						</div>

					</div>

				@endif
				@if (!count($servicios))
					<center>
						<label for="">No Existen Servicios para mostrar</label>
						<br>
						<img src="/ico/sad.png">
					</center>
				@endif
			</div>
		</div>
	</div>
</div>