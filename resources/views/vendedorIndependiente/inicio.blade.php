@extends('vendedorIndependiente.master_vendedorIndependiente')

@section('content')
			
			@if ($foto == "ico/default-avatar.png")
					<div class="papel">
						<div class="row">
							<div class="col-md-offset-1 col-md-2 ">
								<div class="ico-house" ></div>
							</div>
							<div class="col-md-6">
							<p onmouseover="fun_p(this)" class=" ">Bienvenido <strong>{{ Auth::user()->nombres.' '.Auth::user()->apellidos }}</strong>, en esta plataforma podrás publicar tus productos y/o servicios que tú sepas hacer, también tenemos algunas herramientas que te podrán ayudar en el acceso y navegabilidad en el sitio", para más detalles pulsa <a href="#">aquí</a></p>

							<blockquote >
							  	<p onmouseover="fun_p(this)"><strong>Primer paso</strong></p>
								<p class="pequenio"><i class="fa fa-camera" ></i> <a onmouseover="fun_p(this)" href="{{ url('userIndependiente/cambiarFoto') }}">Identíficate con tu foto de perfil</a></p>
							</blockquote>
							</div>
						</div>
				</div>
				<div class="centro-link">
					<a  onmouseover="fun_a(this)" href="logout">Salir</a>
				</div>
				
			@endif
			@if ($foto != "ico/default-avatar.png")

				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1 class="text-center">Bienvenido {{Auth::user()->nombres.' '.Auth::user()->apellidos }}</h1>
							<hr>

								<div class="row">
									<div class="col-md-offset-1 col-md-9 papel-inicio">
										<div class="papel-titulo">
											<p>Publicar tus novedades <div class="ico-push" ></div></p>
										</div>
										<div class="papel-body" >
											<p>Puedes publicar tus novedades cuando gustes, también lo podras ver todas tus actividades que realizas</p>
												<div class="botones-grupo">
													<a href="{{url('/userIndependiente/ingresar_productos')}}" class="btn btn-verde" >Publicar Producto</a>
													<a href="#" class="btn btn-naranja" >Publicar Servicio</a>
												</div>
										</div>
									</div>
									
								</div>
						</div>						
					</div>
				
				@endif


							<hr>
		<div class="row">
			<div class="col-md-offset-1 col-md-3 linea-gris fondo-blanco">
				<center><label>Noticias Generales</label></center>
				<hr>
				<img class="img-notix"  src="http://www.uaa.mx/rectoria/dcrp/wp-content/uploads/2015/05/184-Reuni%C3%B3n-SICOM.jpg" height="70" width="90">
				<p class="img-titu" ><label>reunión en los angeles con canciller y ministors del interior y de educación</label></p>
				<p class="img-titu" ><a href="#" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
			
				<hr>
				<img class="img-notix"  src="https://jazminoddy.files.wordpress.com/2016/04/12002982_1648419215376199_7949008010979303282_n-770x400.jpg?w=662" height="70" width="90">
				<p class="img-titu"><label>Jovenes crean nuevos productos de innovación</label></p>
				<p class="img-titu" ><a href="#" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
				<hr>
				<p><label><small><a href="#">Ver todas las noticias...</a></small></label></p>

				<hr>
				
				<center><label>Noticias Locales</label></center>
				<hr>
				<img class="img-notix"  src="http://www.uaa.mx/rectoria/dcrp/wp-content/uploads/2015/05/184-Reuni%C3%B3n-SICOM.jpg" height="70" width="90">
				<p class="img-titu" ><label>reunión en los angeles con canciller y ministors del interior y de educación</label></p>
				<p class="img-titu" ><a href="#" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
			
				<hr>
				<img class="img-notix"  src="https://jazminoddy.files.wordpress.com/2016/04/12002982_1648419215376199_7949008010979303282_n-770x400.jpg?w=662" height="70" width="90">
				<p class="img-titu"><label>Jovenes crean nuevos productos de innovación</label></p>
				<p class="img-titu" ><a href="#" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
				<hr>
				<p><label><small><a href="#">Ver todas las noticias...</a></small></label></p>
				<hr>
				
			</div>
			<div class="col-md-7  fondo-blanco">

					<div class="row">
						<div class="col-md-12">
							<center><label>Productos</label>  <i class="fa fa-tags" aria-hidden="true"></i></center>
							<hr>
							

							<div class="box-producto">
								<center>
									<img class="img-thumbnail img-prod ">
									<p></p>
									<p><a href="" class="btn btn-primary btn-xs">Ver</a></p>
								</center>

							</div>	


							<center class="center-top" ><label><small><a href="#">Ver mas..</a></small></label></center>
						</div>

					</div>


					<center><label for="">No Existen productos para mostrar</label></center>

				<hr>


					<div class="row">
						<div class="col-md-12">
							<center><label>Servicios</label> <i class="fa fa-star-o" aria-hidden="true"></i></center>
							<hr>
							
	
							<div class="box-producto">
								<center>
									<img class="img-thumbnail img-prod ">
									<p></p>
									<p><a href="" class="btn btn-primary btn-xs">Ver</a></p>
								</center>

							</div>	


							<center class="center-top" ><label><small><a href="#">Ver mas..</a></small></label></center>
						</div>

					</div>


					<center><label for="">No Existen Servicios para mostrar</label></center>

			</div>
		</div>
	</div>

@endsection
