@extends('encargadoArea.master_encargadoArea')

@section('content')

	<div class="row" >
		<div class="col-md-offset-3 col-md-5" >
			<div class="papelImagen">
				<div class="cabeza">
										
					<div class="ico-pass"></div>
					<a href="{{ url('encargadoArea/inicio') }} "><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
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
							@if (Session::has('clave'))
								<div class="alert alert-info">{{ Session::get('clave') }}</div>
							@endif

					    		<br>
						    	<p><label>Ingresa una nueva contraseña</label></p>
								<p><input class="mi-input" type="password" name="nuevaclave"></p>
								<p><label>Repita una nueva contraseña</label></p>
								<p><input class="mi-input" type="password" name="rnuevaclave"></p>
						   		
						   		 <input type="submit" name="" value="Cambiar clave" class="btn btn-primary" >
					
							</form>
					    </div>
			</div>
		</div>	
	</div>		
@endsection