@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
	<div class="margen"><!--probandi-->
		@if ($estado_password == 1)
				<div class="row">
					<div class="col-md-offset-3 col-md-6">
						<center><label>Bienvenido {{ Auth::user()->nombres.' '.Auth::user()->nombres }}</label></center>
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
			
			<div class="container">
					<div class="">
						BienVenido {{ $foto }}
					</div>
				</div>
				
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