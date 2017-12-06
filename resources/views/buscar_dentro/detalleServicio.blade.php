@if (count($servicio))
	<br>
	<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
	<center><label>Detalle del Servicio</label></center>
	<hr>
	<div class="row panel">
		@if (count($errors))
				
						<div class="alert alert-danger">
						    <a href="" class="close" data-dismiss="alert">&times;</a>
						    @foreach ($errors->all() as $e)
								<ul>
									<li><label>{{ $e }}</label></li>
								</ul>
							@endforeach
						</div>
				
			@endif
		@if (Session::has('correcto'))
				<div class="alert alert-info">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <label>{{ Session::get('correcto') }}</label>
			    </div>
		@endif
		<div class="col-md-offset-1 col-md-3 ">
			<img src="{{ '/'.$servicio[0]->foto }}" alt="foto de {{ $servicio[0]->nombre }}" class="img-thumbnail img-responsive">
		
			
				
				<br><br>
		</div>
		<div class="col-md-6 ">
			<p><label><strong>Nombre:</strong></label> <label>{{ $servicio[0]->nombre }}</label></p>
			

			<p><label><strong>Descripción:</strong></label> <label>{{ $servicio[0]->descripcion }}</label></p>
			
			<p><label><strong>Categoría:</strong></label> <label>{{ $servicio[0]->nombreCategoria }}</label></p>
			
			
			
			<p><label><strong>Área o especialidad:</strong></label> <label>{{ $servicio[0]->nombreArea }}</label></p>
			
			<hr>
			<p><label><strong>Creado:</strong></label> <label>{{ $servicio[0]->creado }}</label></p>
		</div>
	</div>
	
@endif

@if (!count($servicio))
	<center><p style="font-size: 19px" ><label>Nada para mostrar</label></p></center>
@endif