@extends('encargadoArea.master_encargadoArea')

@section('content')

<div class=""><!--probandi-->
@if ($estado_password == 1)

<div class="row" >
		<div class="col-md-offset-3 col-md-5" >
			<div class="papelImagen">
					<div class="cabeza">					
						<div class="ico-pass"></div>
					</div>
				
			 	<div class="subir">
					<form action="{{ url('encargadoArea/actualiza_clave') }}" method="post" enctype='multipart/form-data' >
							    		{{ csrf_field() }}
							    		<br>
							    		<p><label>Para proteger tu seguridad cambia la contraseña que has recibido por una nueva.</label></p>
										
										@if (count($errors))
								<div class="row">
									<div class="col-md-offset-3 col-md-6">
										<div class="alert alert-danger">
										    <a href="" class="close" data-dismiss="alert">&times;</a>
										    @foreach ($errors->all() as $e)
												<ul>
													<li>{{ $e }}</li>
												</ul>
											@endforeach
										</div>
									</div>
								</div>	
							@endif


					    		<br>
						    	<p><label>Ingresa una nueva contraseña</label></p>
								<p><input class="mi-input" type="password" name="nuevaclave"></p>
								<p><label>Repita una nueva contraseña</label></p>
								<p><input class="mi-input" type="password" name="rnuevaclave"></p>
						   		 <br/><br/>
						   		 <input type="submit" name="" value="Cambiar clave" class="btn btn-primary" >
					
					</form>
			    </div>
			    <center><label><a href="{{ url('encargadoArea/logout') }}">Salir</a></label></center>
			</div>
		</div>
</div>		
@endif
@if ($estado_password == 2)
			
	<div class="container">
	@if (Session::has('cambioClave'))
					<div class="alert alert-info">{{ Session::get('cambioClave') }}</div>
			@endif
		<div class="row">
			@if ($logo != null)
				<div class="col-md-2">
					<center><img src="{{ '/'.$logo }}" height="80" width="120"></center>
						<hr>
				</div>
			@endif
			
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-2 col-sm-1 ">
						<a href="{{ url('encargadoArea/equipo') }}"><div class="ico-small-group"></div></a>
						<center><label>Nuestro equipo</label></center>
					</div>
					<div class="col-md-2 col-sm-1">
						<a href="{{ url('encargadoArea/datosAreas') }}"><div class="ico-small-security"></div></a>
						<center><label>Información del área</label></center>
					</div>
					<div class="col-md-2 col-sm-1">
						<a href="{{ url('encargadoArea/publicarProducto') }}"><div class="ico-small-speaker"></div></a>
						<center><label>Publicar productos</label></center>
					</div>
					<div class="col-md-2 col-sm-1">
						<a href="{{ url('encargadoArea/publicarServicio') }}"><div class="ico-small-service"></div></a>
						<center><label>Publicar servicio</label></center>
					</div>
					<div class="col-md-2 col-sm-1">
						<a href="{{ url('encargadoArea/clave') }}"><div class="ico-small-pass"></div></a>
						<center><label>Cambiar contraseña</label></center>
					</div>
				</div>
			</div>

		</div>
	<hr>
		<div class="row">
			<div class="col-md-3 linea-gris fondo-blanco">
				@if(count($noticias_generales)>0)
					<center><label>Noticias Generales</label></center>
					
					@foreach ($noticias_generales as $ng)
						<hr>
						<img class="img-notix"  src="{{ '/'.$ng->foto }}" height="70" width="90">
						<p class="img-titu" ><label>{{ $ng->titulo}}</label></p>
						<p class="img-titu" ><a href="{{ url('detalleNoticia/'.base64_encode($ng->id)) }}" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
					@endforeach
					<hr>
					<p><label><small><a href="{{ url('encargadoArea/verNoticiasGenerales') }}">Ver todas las noticias...</a></small></label></p>

					<hr>
				@endif
				@if (!count($noticias_generales))
						<p>No existen noticias generales</p>
						<hr>
				@endif	
				
				@if(count($noticias_locales)>0)
					<center><label>Noticias Locales</label></center>
					@foreach ($noticias_locales as $nl)
						<hr>
						<img class="img-notix"  src="{{ '/'.$nl->foto }}" height="70" width="90">
						@if ($nl->id_estado == 1)
							<p class="img-titu" ><label>{{ $nl->titulo}}</label> <img src="/ico/world.png"></p>
						@endif
						@if ($nl->id_estado == 2)
							<p class="img-titu" ><label>{{ $nl->titulo}}</label> <img src="/ico/padlock.png"></p>
						@endif
						<p class="img-titu" ><a href="{{ url('detalleNoticia/'.base64_encode($nl->id)) }}" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
					@endforeach
					<hr>
					<p><label><small><a href="{{ url('encargadoArea/verNoticiasLocales') }}">Ver todas las noticias...</a></small></label></p>
					<hr>
				@endif	
				@if (!count($noticias_locales))
					<p>No existen noticias locales</p>
						<hr>
				@endif
				
			</div>
			<div class="col-md-8">
				@if (count($productos)>0)
					<div class="row">
						<div class="col-md-11 linea-gris fondo-blanco">
							<center><label>Productos del área o especialidad</label></center>
						<form action="{{ url('encargadoArea/filtrarProducto') }}" method="GET"> 
						  <div class="row">
						    <div class="col-md-12">
						      <div class="input-group">
						      	{{ csrf_field() }}
						   <input type="text" class="form-control" placeholder="Buscar productos" name="buscar"/>
						   <div class="input-group-btn">
						        <button class="btn btn-primary" type="submit">
						        <span class="glyphicon glyphicon-search"></span>
						        </button>
						   </div>
						   </div>
						    </div>
						  </div>
						</form>	
							<hr>
							
							@foreach ($productos as $producto)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$producto->foto }}" class="img-thumbnail img-prod ">
									<p>{{ str_limit($producto->nombre, 10) }}</p>
									<p><a href="{{ url('encargadoArea/detalleProducto/'.base64_encode($producto->idProducto)) }}" class="btn btn-primary btn-xs">Ver</a></p>
								</center>

							</div>	
							@endforeach
							<!--<center>{{--$productos->links() --}}</center>-->
							<center class="center-top" ><label><small><a href="#">Ver mas..</a></small></label></center>
						</div>

					</div>
					<hr>
				@endif
				@if (!count($productos))
					<center><label for="">No Existen productos para mostrar</label></center>
				@endif

				@if (count($servicios)>0)
					<div class="row">
						<div class="col-md-11 linea-gris fondo-blanco">
							<center><label>Servicios del área o especialidad</label></center>
							<form action="{{ url('encargadoArea/filtrarServicio') }}" method="GET"> 
								  <div class="row">
								    <div class="col-md-12">
								      <div class="input-group">
								      	{{ csrf_field() }}
								   <input type="text" class="form-control" placeholder="Buscar servicios" name="buscar"/>
								   <div class="input-group-btn">
								        <button class="btn btn-primary" type="submit">
								        <span class="glyphicon glyphicon-search"></span>
								        </button>
								   </div>
								   </div>
								    </div>
								  </div>
							</form>	
							<hr>
							
							@foreach ($servicios as $servicio)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$servicio->foto }}" class="img-thumbnail img-prod ">
									<p>{{ str_limit($servicio->nombre, 10) }}</p>
									<p><a href="{{ url("encargadoArea/detalleServicio/".base64_encode($servicio->id)) }}" class="btn btn-primary btn-xs">Ver</a></p>
								</center>

							</div>	
							@endforeach
							<!--<center>{{--$productos->links() --}}</center>-->
							<center class="center-top" ><label><small><a href="#">Ver mas..</a></small></label></center>
						</div>

					</div>
					<hr>
				@endif
				@if (!count($servicios))
					<center><label for="">No Existen servicios para mostrar</label></center>
				@endif
			</div>
			
		</div>
	</div>
				
@endif	
	
</div>

@endsection

