<div class=" ">
		<div class="row">
			<div class="col-md-3 fondo-blanco lineas-border">
				<br>
				<center><img src="{{ '/'.$institucion->logo }}" class="img img-thumbnail tamanio-inst" >
					<hr>
					<p><strong class="nombreblue" ><i class="fa fa-user" aria-hidden="true"></i> {{$institucion->nombre}}</strong></p>
					<p><strong class="correo" ><i class="fa fa-envelope" aria-hidden="true"></i> {{$institucion->email}}</strong></p>
					<p><strong class="numero" ><label><i class="fa fa-phone" aria-hidden="true"></i> {{ $institucion->telefono1 }}</label></strong></p>
					<p><strong class="numero" ><label><i class="fa fa-phone" aria-hidden="true"></i> {{ $institucion->telefono2 }}</label></strong></p>

					@if (!empty($institucion->sitioWeb))
						<p><strong class="numero" ><label><i class="fa fa-globe" aria-hidden="true"></i> <a href="{{ url($institucion->sitioWeb) }}">{{ $institucion->sitioWeb }}</a></label></strong></p>
					@endif

				</center>

				<center>
					<img src="/ico/map.png" height="40" width="40">
					<p>{{ $institucion->direccion }}</p>
				</center>
				<hr>
				@if (count($areas)>0)
					<div class="linea panel-info">
					  <div class="panel-heading">Áreas o Especialidades</div>
						  <div class="panel-body">
						  	@foreach ($areas as $area)
								
									@if ($area->logo == null)
										<p><a href="{{ url($ruta.'/areaExtern/'.$idInstitucion.'/'.base64_encode($area->id)) }}"><label style="margin-left: 20px">{{ $area->nombre }}</label></a></p>
										<hr>
									@endif
									@if (!$area->logo == null)
										<p><a href="{{ url($ruta.'/areaExtern/'.$idInstitucion.'/'.base64_encode($area->id)) }}"><img src="{{'/'.$area->logo }}" class="sizeLogo">  
										<label style="margin-left: 20px">{{ $area->nombre }}</label></a></p><hr>
									@endif
							@endforeach
						  </div>
					</div>
				
				@endif
				@if (!count($areas)>0)
					<label>no hay áreas</label>
				@endif

			</div>
			<div class="col-md-8 fondo-blanco lineas-border">
				<br>
				<div class="row">
					@if (!empty($institucion->mision))
					<div class="col-md-offset-1 col-md-4 linea-arriba">
						
							<p><strong><label>Misión</label></strong></p>
							<p class="txt-gris">{{ $institucion->mision }}</p>

					</div>
					@endif
					@if (!empty($institucion->vision))
					<div class="col-md-offset-1 col-md-4 linea-arriba">
							<p><strong><label>Visión</label></strong></p>
							<p class="txt-gris" >{{ $institucion->vision }}</p>
					</div>
					@endif
				</div>
				<hr>
				@if (count($productos)>0)
					<div class="row">
						<div class="col-md-12">
							<center><label>Productos</label> <i class="fa fa-star-o" aria-hidden="true"></i></center>
							<hr>
							
							@foreach ($productos as $producto)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$producto->foto }}" class="img-thumbnail img-prod ">
									<p>{{ str_limit($producto->nombre, 10) }}</p>
									<p><a href="{{ url($ruta.'/detalleProducto/'.base64_encode($producto->idProducto).'/'.$idInstitucion) }}" class="btn btn-primary btn-xs">Ver</a></p>
								</center>

							</div>	
							@endforeach

							<center class="center-top" ><label><small><a href="#">Ver mas..</a></small></label></center>
						</div>

					</div>

				@endif
				@if (!count($productos))
					<center>
						<label for="">No Existen  para mostrar</label>
						<br>
						<img src="/ico/sad.png">
					</center>
				@endif

				<hr>

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
									<p><a href="{{ url($ruta.'/detalleServicio/'.base64_encode($servicio->id).'/'.$idInstitucion) }}" class="btn btn-primary btn-xs">Ver</a></p>
								</center>

							</div>	
							@endforeach

							<center class="center-top" ><label><small><a href="#">Ver mas..</a></small></label></center>
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


