
@if (is_null($productos[0]))
	<center><p style="font-size: 19px" >Nada para mostrar</p></center>
@endif
@if (!is_null($productos[0]))
	{{-- expr --}}

<br>
	<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
	<center><label>Detalle del producto</label></center>
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
				        {{ Session::get('correcto') }}
			    </div>
		@endif
			
	<div class="col-md-offset-1 col-md-3">
		<img src="{{ '/'.$productos[0]->foto }}" alt="foro de {{ $productos[0]->nombre }}" class="img-thumbnail img-responsive"><br>
		
	</div>
	<div class="col-md-6">
		
			<p><label><strong>Nombre:</strong></label> <label>{{ $productos[0]->nombre }}</label> </p>
			

			<p><label><strong>Descripción:</strong></label> <label>{{ $productos[0]->descripcion }}</label></p>
			
			
			<p><label><strong>Precio: $ </strong></label> <label>{{ number_format($productos[0]->precio, 0, ',', '.')}}</label></p>
			

			<p><label><strong>Cantidad:</strong></label> <label>{{ $productos[0]->cantidad }}</label> </p>
			
			
			<p><label><strong>Visibilidad:</strong></label> <label>{{ $productos[0]->estadoProducto }}. (Apto para la visualización en la tienda)</label></p>
			

			<p><label><strong>Categoría:</strong></label> <label>{{ $productos[0]->nombreCategoria }}</label></p>
			

			<p><label><strong>Área o especialidad:</strong></label> <label>{{ $productos[0]->nombreArea }}</label></p>
				
			
			<hr>
			<p><label><strong>Creado:</strong></label> <label>{{ date('h:i:s - d-m-Y',strtotime($productos[0]->creado)) }}</label></p>
			
			
		</div>
	</div>
	
</div>	

@endif