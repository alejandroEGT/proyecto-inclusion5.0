@extends('encargadoArea.master_encargadoArea')

@section('content')
	<center><label>Bienvenido {{ Auth::user()->nombres.' '.Auth::user()->nombres }}</label></center>
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
				    	<label>Ingresa una nueva contraseña</label>
						<input class="mi-input" type="password" name="nuevaclave">
						<label>Repita una nueva contraseña</label>
						<input class="mi-input" type="password" name="rnuevaclave">
				   		 <input style="display: none;" name="fotoP" id="file-input" type="file"/>
				   		 <br/><br/>
				   		 <input type="submit" name="" value="Cambiar clave" class="btn btn-primary" >
			
					</form>
			    </div>
	</div>
@endsection