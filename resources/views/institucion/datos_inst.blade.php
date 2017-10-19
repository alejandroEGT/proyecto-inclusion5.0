@extends('institucion.master_institucion')


@section('content')
	<div class="">
	<br>
		<div class="row">
			<div class="col-md-12">
			<a href="{{ url('institucion/inicio') }} "><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
				<center><label>Datos de la Institución</label>
				<div class="ico-security" ></div></center>
			</div>
			
		</div>
		<hr>
		
		<div class="row">
		@if (count($errors))
				<div class="row">
					<div class="col-md-offset-2 col-md-7">
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
			<div class="col-md-offset-2 col-md-7">
			
				<label><strong>Nombre </strong></label><small> {{Auth::guard('institucion')->user()->nombre}}</small>
				<button data-toggle="collapse" data-target="#nombre" class="btn btn-xs btn-success" >Editar</button>

				<div id="nombre" class="collapse">
					<div class="alert alert-info" role="alert">
						<form action="{{ url('institucion/actualizar_nombre') }}" method="post">
						 {{csrf_field()}}
					  		<p><strong>Actualizar Nombre</strong> </p>
					  		<p><input class="" type="" name="nombre">
							<input type="submit" value="Guardar" name=""></p>	
						</form>	
					</div>
												
				</div>
				<hr>
				<label><strong>Razón Social </strong></label><small> {{Auth::guard('institucion')->user()->razonSocial}}</small>
				<button data-toggle="collapse" data-target="#rs" class="btn btn-xs btn-success" >Editar</button>

				<div id="rs" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_rs') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Razón Social</strong> </p>
							  		<p><input class="" type="" name="razonSocial">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>					
								
				</div>
				<hr>
				<label><strong>Nª Teléfono 1 </strong></label><small> {{Auth::guard('institucion')->user()->telefono1}}</small>
				<button data-toggle="collapse" data-target="#tel1" class="btn btn-xs btn-success" >Editar</button>

				<div id="tel1" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_tel1') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Teléfono 1</strong> </p>
							  		<p><input class="" type="" name="teléfono1">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
				</div>
				<hr>
				<label><strong>Nª Teléfono 2 </strong></label><small> {{Auth::guard('institucion')->user()->telefono2}}</small>
				<button data-toggle="collapse" data-target="#tel2" class="btn btn-xs btn-success" >Editar</button>

				<div id="tel2" class="collapse">
						<div class="alert alert-info" role="alert">
							<form action="{{ url('institucion/actualizar_tel2') }}" method="post">
							{{csrf_field()}}
						  		<p><strong>Actualizar Teléfono 2</strong> </p>
						  		<p><input class="" type="" name="teléfono2">
								<input type="submit" value="Guardar"></p>	
							</form>	
						</div>

				</div>
				<hr>
				<label><strong>Dirección </strong></label><small> {{Auth::guard('institucion')->user()->direccion}}</small>
				<button data-toggle="collapse" data-target="#dir" class="btn btn-xs btn-success" >Editar</button>

				<div id="dir" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_direccion') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Dirección</strong> </p>
							  		<p><input class="" type="" name="dirección">
									<input type="submit" value="Guardar" name="direccion"></p>	
								</form>	
							</div>

				</div>
				<hr>
				<label><strong>Correo </strong></label><small> {{Auth::guard('institucion')->user()->email}}</small>
				<button data-toggle="collapse" data-target="#correo" class="btn btn-xs btn-success" >Editar</button>

				<div id="correo" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_correo') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Correo</strong> </p>
							  		<p><input class="" type="" name="correo">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>

				</div>
				<hr>
				<label><strong>Sitio Web </strong></label><small>
				 
				 @if (empty(Auth::guard('institucion')->user()->sitioWeb))
				 	(No existe sitio web)
				 @else
					{{Auth::guard('institucion')->user()->sitioWeb}}
				 @endif


				 </small>
				<button data-toggle="collapse" data-target="#paginaweb" class="btn btn-xs btn-success" >Editar</button>

				<div id="paginaweb" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/ingresar_pagweb') }}" method="post">
								{{ csrf_field() }}
							  		<p><strong>Actualizar Sitio Web</strong> </p>
							  		<p><small>Sitio web</small><input class="" type="text" name="paginaWeb">
							  	
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>

				</div>
				<hr>
				<label><strong>Contraseña </strong></label><small> (No visible) </small>
				<button data-toggle="collapse" data-target="#clave" class="btn btn-xs btn-success" >Editar</button>

				<div id="clave" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_clave') }}" method="post">
								{{ csrf_field() }}
							  		<p><strong>Actualizar Contraseña</strong> </p>
							  		<p><small>Contraseña actual </small><input class="" type="password" name="clave_actual">
							  		<p><small>Contraseña Nueva </small><input class="" type="password" name="clave_nueva">
							  		<p><small>Repetir Contraseña Nueva </small><input class="" type="password" name="confirm_clave_nueva">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>

				</div>
				<hr>
				<img src="{{ '/'.Auth::guard('institucion')->user()->logo }}" class="img img-thumbnail" height="100" width="130">
				 <button data-toggle="collapse" data-target="#logo" class="btn btn-xs btn-success" >Editar</button>

				<div id="logo" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_logo') }}" method="post" enctype="multipart/form-data">
									{{ csrf_field() }}
							  		<p><label for="file-input" class="label-foto-link">
									 		<img src="/ico/image.png" for="file-input" class="label-foto-link">
									 			Actualizar logo..
										</label>
								    </p>
									<input style="display: none;" name="logo" id="file-input" type="file"/>
														<input type="submit" value="Guardar" name="">	
								</form>	
							</div>

				</div>
			</div>

		</div>
	</div>
@endsection
@section('js')
	<script>
            function mostrarImagen(input) {
                if (input.files && input.files[0]) 
                {
                    var reader = new FileReader();
                    reader.onload = function (e) {
    
                        $('#img_destino').attr('style', 'background-image:url('+e.target.result+');');
                        $('#divFoto').attr('hidden', false);
   
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
           
 
                $("#file-input").change(function(){
                 mostrarImagen(this);
                 
                });
                
        </script>
@endsection