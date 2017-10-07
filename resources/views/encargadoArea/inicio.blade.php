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
			<div class="col-md-offset-1 col-md-7">
				@if (count($productos)>0)
					<div class="row">
						<div class="col-md-11 panel">
							<center><label>Productos</label></center>
							<hr>
							
							@foreach ($productos as $producto)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$producto->foto }}" class="img-thumbnail img-prod ">
									<p>{{ $producto->nombre }}</p>
									<p><a href="" class="btn btn-primary btn-xs">Ver</a></p>
								</center>

							</div>	
							@endforeach
							<!--<center>{{--$productos->links() --}}</center>-->
							<center class="center-top" ><label><small><a href="#">Ver mas..</a></small></label></center>
						</div>

					</div>

				@endif
				@if (!count($productos))
					<center><label for="">No Existen productos para mostrar</label></center>
				@endif
			</div>
			<div class="col-md-3 panel">
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
		</div>
	</div>
				
@endif	
	
</div>

@endsection

