@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
	<div class="margen"><!--probandi-->
		@if ($estado_password == 1)
				<div class="row">
					<div class="col-md-offset-3 col-md-6">
						<center><label>Bienvenido {{ Auth::user()->nombres.' '.Auth::user()->apellidos }}</label></center>
				<div class="papelImagen">
				<div class="cabeza">
					
					<div class="ico-pass"></div>

				</div>
		
				
			    <div class="subir">
			    	<form action="{{ url('userDependiente/actualiza_clave') }}" method="post" enctype='multipart/form-data' >
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
						<input class="mi-input" type="password" name="nuevaclave">
						<p><label>Repita una nueva contraseña</label></p>
						<input class="mi-input" type="password" name="rnuevaclave">
				   		 <input style="display: none;" name="fotoP" id="file-input" type="file"/>
				   		 <br/><br/>
				   		 <input type="submit" name="" value="Cambiar clave" class="btn btn-primary" >
			
					</form>
			    </div>
			</div>
					</div>
				</div>
				<center><a href="{{ url('userDependiente/logout') }}"><label>Salir</label></a></center>
		@endif
		@if ($estado_password == 2)
			
			<div class="container"><!-- PRIMERA VISTA PARA EL ALUMNO  -->
				<br>
					<div class="row">
						<div class="col-md-12 ">
							<center><p><label>Publicar productos o servicios para que sean visualizados en tu intitución</label></p></center>
							<div class="row">
								<div class="col-md-offset-2 col-md-4 well lineas">
									<center>
										<div class="ico-producto"></div>
										<a href="#"><label>Publicar Producto</label></a>
									</center>

								</div>
								<div class="col-md-4 well lineas">
									<center>
										<div class="ico-speaker"></div>
										<a href="#"><label>Publicar Servicio</label></a>
									</center>
								</div>
							</div>
						</div>
					</div>
				<hr>
					<div class="row">
			
						<div class="col-md-3">
							@if(count($noticias_generales)>0)
					<center><label>Noticias Generales</label></center>
					
					@foreach ($noticias_generales as $ng)
						<hr>
						<img class="img-notix"  src="{{ '/'.$ng->foto }}" height="70" width="90">
						<p class="img-titu" ><label>{{ $ng->titulo}}</label></p>
						<p class="img-titu" ><a href="{{ url('detalleNoticia/'.base64_encode($ng->id)) }}" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
					@endforeach
					<hr>
					<p><label><small><a href="#">Ver todas las noticias...</a></small></label></p>

					<hr>
				@endif
				@if (!count($noticias_generales))
						<p>No existen noticias</p>
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
					<p><label><small><a href="#">Ver todas las noticias...</a></small></label></p>
					<hr>
				@endif	
				@if (!count($noticias_locales))
					<p>No existen noticias</p>
						<hr>
				@endif
							
						</div>
						<div class="col-md-8">
							

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
											</center>

										</div>	
										@endforeach

										<center class="center-top" ><label><small><a href="#">Ver mas..</a></small></label></center>
									</div>

								</div>

							@endif
							@if (!count($productos))
								<center>
									<label for="">No Existen Productos para mostrar</label>
									<br>
									<img src="/ico/sad.png">
								</center>
							@endif

							<hr>

							@if (count($servicios)>0)
								<div class="row">
									<div class="col-md-12">
										<center><label>Productos</label> <i class="fa fa-star-o" aria-hidden="true"></i></center>
										<hr>
										
										@foreach ($servicios as $servicio)
										<div class="box-producto">
											<center>
												<img src="{{ '/'.$servicio->foto }}" class="img-thumbnail img-prod ">
												<p>{{ str_limit($servicio->nombre, 10) }}</p>
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
			</div><!-- PRIMERA VISTA PARA EL ALUMNO  -->
				
		@endif	
		

	</div>

@endsection

@section('esperando')
	
	<div class="container">
		<div class="top-top papel">
			<div class="row">
				<div class="col-md-offset-1 col-md-2 top-reloj">
					<div class="ico-clock" ></div>
				</div>
				<div class="col-md-6 top ">
				<p class="lead ">Hola <strong>{{ Auth::user()->nombres.' '.Auth::user()->apellidos }}</strong>, Gracias por registrarte en nuestro sitio web, debes esperar a que la institucion a la que te registrarte acepte y acredite de que eres parte de su equipo, te notificaremos a tu correo, porfavor estar pendiente, atentamente el equipo "El Arte Escondido.".</p>
				</div>
			</div>
		</div>
		<div class="centro-link">
			<a href="logout">Salir</a>
		</div>
	</div>
	

@endsection