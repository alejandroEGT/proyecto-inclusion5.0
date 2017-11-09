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
									<li><label>{{ $e }}</label></li>
								</ul>
							@endforeach
						</div>
					</div>
				</div>	
			@endif
			<div class="col-md-offset-2 col-md-7">
				
				<label><strong>Rut </strong></label><small> <label>{{Auth::guard('institucion')->user()->rut}}</label></small>
				<button data-toggle="collapse" data-target="#nombre" class="btn btn-xs btn-success" >Editar</button>

				<div id="nombre" class="collapse">
					<div class="alert alert-info" role="alert">
						<form action="{{ url('institucion/actualizar_rut') }}" method="post">
						 {{csrf_field()}}
					  		<p><label><strong>Actualizar Rut</strong></label> </p>
					  		<p><input class="" type="text" name="rut" placeholder="Rut de la institución">
							<input type="submit" value="Guardar" name=""></p>	
						</form>	
					</div>
												
				</div>
				<hr>
				<label><strong>Nombre </strong></label><small> <label>{{Auth::guard('institucion')->user()->nombre}}</label></small>
				<button data-toggle="collapse" data-target="#nombre" class="btn btn-xs btn-success" >Editar</button>

				<div id="nombre" class="collapse">
					<div class="alert alert-info" role="alert">
						<form action="{{ url('institucion/actualizar_nombre') }}" method="post">
						 {{csrf_field()}}
					  		<p><label><strong>Actualizar Nombre</strong></label> </p>
					  		<p><input class="" type="text" name="nombre" placeholder="Nombre">
							<input type="submit" value="Guardar" name=""></p>	
						</form>	
					</div>
												
				</div>
				<hr>
				<label><strong>Razón Social </strong></label><small> <label>{{Auth::guard('institucion')->user()->razonSocial}}</label></small>
				<button data-toggle="collapse" data-target="#rs" class="btn btn-xs btn-success" >Editar</button>

				<div id="rs" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_rs') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Razón Social</strong></label> </p>
							  		<p><input class="" type="text" name="razonSocial" placeholder="Razón social">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>					
								
				</div>
				<hr>
				<label><strong>Nª Teléfono 1 </strong></label><small> <label>{{Auth::guard('institucion')->user()->telefono1}}</label></small>
				<button data-toggle="collapse" data-target="#tel1" class="btn btn-xs btn-success" >Editar</button>

				<div id="tel1" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_tel1') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Teléfono 1</strong></label> </p>
							  		<p><input class="" type="numeric" name="teléfono1" placeholder="Teléfono 1">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
				</div>
				<hr>
				<label><strong>Nª Teléfono 2 </strong></label><small><label> {{Auth::guard('institucion')->user()->telefono2}}</label></small>
				<button data-toggle="collapse" data-target="#tel2" class="btn btn-xs btn-success" >Editar</button>

				<div id="tel2" class="collapse">
						<div class="alert alert-info" role="alert">
							<form action="{{ url('institucion/actualizar_tel2') }}" method="post">
							{{csrf_field()}}
						  		<p><label><strong>Actualizar Teléfono 2</strong></label> </p>
						  		<p><input class="" type="numeric" name="teléfono2" placeholder="Teléfono 2">
								<input type="submit" value="Guardar"></p>	
							</form>	
						</div>

				</div>
				<hr>
				<label><strong>Dirección </strong></label><small> <label>{{Auth::guard('institucion')->user()->direccion}}</label></small>
				<button data-toggle="collapse" data-target="#dir" class="btn btn-xs btn-success" >Editar</button>

				<div id="dir" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_direccion') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Dirección</strong></label> </p>
							  		<p><input class="" type="text" name="dirección" placeholder="Dirección">
									<input type="submit" value="Guardar" name="direccion"></p>	
								</form>	
							</div>

				</div>
				<hr>
				<label><strong>Correo </strong></label><small> <label>{{Auth::guard('institucion')->user()->email}}</label></small>
				<button data-toggle="collapse" data-target="#correo" class="btn btn-xs btn-success" >Editar</button>

				<div id="correo" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_correo') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Correo</strong></label> </p>
							  		<p><input class="" type="email" name="correo" placeholder="Correo electrónico">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>

				</div>
				<hr>
				<label><strong>Sitio Web </strong></label><small>
				 
				 @if (empty(Auth::guard('institucion')->user()->sitioWeb))
				 	<label>(No existe sitio web)</label>
				 @else
					<label>{{Auth::guard('institucion')->user()->sitioWeb}}</label>
				 @endif


				 </small>
				<button data-toggle="collapse" data-target="#paginaweb" class="btn btn-xs btn-success" >Editar</button>

				<div id="paginaweb" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/ingresar_pagweb') }}" method="post">
								{{ csrf_field() }}
							  		<p><label><strong>Actualizar Sitio Web</strong> </label></p>
							  		<p><small>Sitio web</small><input class="" type="text" name="paginaWeb" placeholder="Sitio web">
							  	
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>

				</div>
				<hr>
				<label><strong>Contraseña </strong></label><small><label> (No visible)</label> </small>
				<button data-toggle="collapse" data-target="#clave" class="btn btn-xs btn-success" >Editar</button>

				<div id="clave" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_clave') }}" method="post">
								{{ csrf_field() }}
							  		<p><label><strong>Actualizar Contraseña</strong></label> </p>
							  		<p><small><label>Contraseña actual </label></small><input placeholder="Contraseña actual" class="" type="password" name="clave_actual">
							  		<p><small><label>Contraseña Nueva </label></small><input placeholder="Contraseña nueva" class="" type="password" name="clave_nueva">
							  		<p><small><label>Repetir Contraseña Nueva </label></small><input placeholder="Nuevamente contraseña nueva" class="" type="password" name="confirm_clave_nueva">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>

				</div>
				<hr>
				<img src="{{ '/'.Auth::guard('institucion')->user()->logo }}" alt="Logo de la institución" class="img img-thumbnail" height="100" width="130">
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