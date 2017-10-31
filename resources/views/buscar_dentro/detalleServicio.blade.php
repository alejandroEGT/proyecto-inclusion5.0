@if (count($servicio))
	<br>
	<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
	<center><label>Detalle del Servcicio</label></center>
	<hr>
	<div class="row panel">
		@if (count($errors))
				
						<div class="alert alert-danger">
						    <a href="" class="close" data-dismiss="alert">&times;</a>
						    @foreach ($errors->all() as $e)
								<ul>
									<li>{{ $e }}</li>
								</ul>
							@endforeach
						</div>
				
			@endif
		@if (Session::has('correcto'))
				<div class="alert alert-info">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        {{ Session::get('correcto') }}
			    </div>
		@endif
		<div class="col-md-offset-1 col-md-3 ">
			<img src="{{ '/'.$servicio[0]->foto }}" class="img-thumbnail img-responsive">
		
			
				
				<br><br>
		</div>
		<div class="col-md-6 ">
			<p><label><strong>Nombre:</strong></label> {{ $servicio[0]->nombre }}</p>
			

			<p><label><strong>Descripción:</strong></label> {{ $servicio[0]->descripcion }}</p>
			
			<p><label><strong>Categoría:</strong></label> {{ $servicio[0]->nombreCategoria }}</p>
			
			
			
			<p><label><strong>Área o especialidad:</strong></label> {{ $servicio[0]->nombreArea }}</p>
			
			<hr>
			<p><label><strong>Creado:</strong></label> {{ $servicio[0]->creado }}</p>
		</div>
	</div>
	
@endif

@if (!count($servicio))
	<center><p style="font-size: 19px" >Nada para mostrar</p></center>
@endif