@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
			
			@if ($foto == "ico/default-avatar.png")
				<div class="container">
				<div class="top-top papel">
					<div class="row">
						<div class="col-md-offset-1 col-md-2 ">
							<div class="ico-house" ></div>
						</div>
						<div class="col-md-6  ">
						<p onmouseover="fun_p(this)" class=" ">BienVenido <strong>{{ Auth::user()->nombres.' '.Auth::user()->apellidos }}</strong>, en esta plataforma podras publicar tus productos y/o servicios que tú sepas hacer, tambien tenemos algunas herramientas que te podran ayudar en el acceso y navegabilidad en el sitio", para mas detalles pulsa <a href="#">aquí</a></p>

						<blockquote >
						  	<p onmouseover="fun_p(this)"><strong>Primer paso</strong></p>
							<p class="pequenio"><i class="fa fa-camera" ></i> <a onmouseover="fun_p(this)" href="{{ url('userDependiente/cambiarFoto') }}">Identíficate con tu foto de perfil</a></p>
						</blockquote>
						</div>
					</div>
				</div>
				<div class="centro-link">
					<a  onmouseover="fun_a(this)" href="logout">Salir</a>
				</div>
			</div>
			@endif
			@if ($foto != "ico/default-avatar.png")
				<p>wtf</p>
			@endif

	</div>

		
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