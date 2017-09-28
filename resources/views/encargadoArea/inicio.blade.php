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
						<a href="#"><div class="ico-small-service"></div></a>
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
			<div class="col-md-12">
				@if (count($productos)>0)
				ver productos..
				@endif
				@if (count($productos)<=0)
					<h4><center><label style="color:#A4A4A4">No existen producto y servicios en esta área<br><br> <i class="fa fa-camera fa-4x" aria-hidden="true"></i></label></center></h4>
				@endif
			
				
					{{-- expr --}}
				
			</div>	
		</div>
	</div>
				
@endif	
	
</div>

@endsection

