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
			
						<div class="col-md-3 papel-noticia">
							<center><label>Noticias</label></center>
							<hr>
							<img class="img-notix"  src="http://www.uaa.mx/rectoria/dcrp/wp-content/uploads/2015/05/184-Reuni%C3%B3n-SICOM.jpg" height="70" width="90">
							<p class="img-titu" ><label>reunión en los angeles con canciller y ministors del interior y de educación</label></p>
							<p class="img-titu" ><a href="#" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
							



							<hr>
							<img class="img-notix"  src="https://jazminoddy.files.wordpress.com/2016/04/12002982_1648419215376199_7949008010979303282_n-770x400.jpg?w=662" height="70" width="90">
							<p class="img-titu"><label>Jovenes crean nuevos productos de innovación</label></p>
							<p class="img-titu" ><a href="#" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
							
						</div>
						<div class="col-md-8 papel-noticia lineas">
							<center><label>Productos</label> <i class="fa fa-tags" aria-hidden="true"></i></center>
							<hr>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
							<center><label><a href="">Ver mas..</a></label></center>
							<hr>

							<center><label>Servicios</label> <i class="fa fa-star-o" aria-hidden="true"></i></center>
							<hr>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
							<center><label><a href="">Ver mas..</a></label></center>
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