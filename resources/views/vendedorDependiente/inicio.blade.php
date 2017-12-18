@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
	<div class=""><!--probandi-->
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
								<center><ul>
									<li>{{ $e }}</li>
								</ul></center>
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
							<center><p><label>Publicar productos para que sean visualizados en tu institución</label></p></center>
							<div class="row">
								<div class="col-md-offset- col-md-3 well ">
									<center>
										<div class="ico-producto"></div>
										<a href="{{ url('userDependiente/publicarProducto') }}"><label>Publicar Producto</label></a>
									</center>

								</div>
								<div class="col-md-9 lineas">
									<center><label>Herraminetas</label></center>
									<div class="row">
										<div class="col-md-4 ">
											<p><i class="fa fa-microphone" aria-hidden="true"> </i> <label>Microfono</label></p>
											<p><label>Herramienta para el redireccionamiento de pestañas dentro de tu perfil</label></p>
											
											{{--<center>
												<div class="ico-speaker"></div>
												<a href="{{ url('userDependiente/publicarServicio') }}"><label>Publicar Servicio</label></a>
											</center>--}}
										</div>
										<div class="col-md-4">
											<p><i class="fa fa-commenting-o" aria-hidden="true"></i> <label>Dictador de texto</label></p>
											<p><label>
												Herramienta para oir los elementos del sitio web según el posicionamiento del cursor
											</label></p>
											
										</div>
										<div class="col-md-4">
											<p><i class="fa fa-eye" aria-hidden="true"></i> <label>Daltonismo</label></p>
											<p><label>Herramienta para ampliar y contrastar el texto de tu perfil</label></p>

										</div>
									</div>
									<p><center><label><a href="{{ url('userDependiente/herramientas') }}">Ver más información</a></label></center></p>
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
						<p class="img-titu" ><a href="{{ url('userDependiente/detalleNoticia_general/'.base64_encode($ng->id)) }}" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
					@endforeach
					<hr>
					<p><small><a href="{{ url('userDependiente/verNoticiasGenerales') }}">Ver todas las noticias...</a></small></p>

					<hr>
				@endif
				@if (!count($noticias_generales))
						<p><label>No existen noticias</label></p>
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
						<p class="img-titu" ><a href="{{ url('userDependiente/detalleNoticia_local/'.base64_encode($nl->id)) }}" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
					@endforeach
					<hr>
					<p><small><a href="{{ url('userDependiente/verNoticiasLocales') }}">Ver todas las noticias...</a></small></p>
					<hr>
				@endif	
				@if (!count($noticias_locales))
					<p><label>No existen noticias</label></p>
						<hr>
				@endif
							
						</div>
						<div class="col-md-8">
							
							@if (count($productos)>0)
								<div class="row">
									<div class="col-md-12">
										<center><label>Productos en mi área</label> <i class="fa fa-star-o" aria-hidden="true"></i></center>

										<form action="{{ url('userDependiente/filtrarProducto') }}" method="GET"> 
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
												<a class="btn btn-primary btn-xs" href="{{ url("userDependiente/detalleProducto/".base64_encode($producto->idProducto)) }}">Ver..</a>
											</center>

										</div>	
										@endforeach

										<center class="center-top" ><small><a href="{{ url('userDependiente/ver_todo_producto') }}">Ver mas..</a></small></center>
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

							{{--@if (count($servicios)>0)
								<div class="row">
									<div class="col-md-12">
										<center><label>Servicios en mi área</label> <i class="fa fa-star-o" aria-hidden="true"></i></center>
										<form action="{{ url('userDependiente/filtrarServicio') }}" method="GET"> 
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
												<a class="btn btn-primary btn-xs" href="{{ url("userDependiente/detalleServicio/".base64_encode($servicio->id)) }}">Ver..</a>	
											</center>

										</div>	
										@endforeach

										<center class="center-top" ><small><a href="{{ url('userDependiente/ver_todo_servicio') }}">Ver mas..</a></small></center>
									</div>

								</div>

							@endif
							@if (!count($servicios))
								<center>
									<label for="">No Existen Servicios para mostrar</label>
									<br>
									<img src="/ico/sad.png">
								</center>
							@endif--}}
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