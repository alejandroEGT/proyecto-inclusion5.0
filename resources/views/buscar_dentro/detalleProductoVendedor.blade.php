
@if (is_null($producto))
	<center><p style="font-size: 19px" >Nada para mostrar</p></center>
@endif
@if (!is_null($producto))
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
			
	<div class="col-md-offset-1 col-md-3">
		<img src="{{ '/'.$producto->foto }}" class="img-thumbnail img-responsive"><br>
		
	</div>
	<div class="col-md-6">
		
			<p><label><strong>Nombre:</strong></label> {{ $producto->nombre }} </p>
			

			<p><label><strong>Descripción:</strong></label> {{ $producto->descripcion }}</p>
			
			
			<p><label><strong>Precio: $ </strong></label> {{ number_format($producto->precio, 0, ',', '.') }}</p>
			

			<p><label><strong>Cantidad:</strong></label> {{ $producto->cantidad }} </p>
			
			
			<p><label><strong>Visibilidad:</strong></label> {{ $producto->estadoProducto }}. (Apto para la visualización en la tienda)</p>
			

			<p><label><strong>Categoría:</strong></label> {{ $producto->nombreCategoria }}</p>
			

			
				
			
			<hr>
			<p><label><strong>Creado:</strong></label> {{ date('h:i:s - d/m/Y',strtotime($producto->creado)) }}</p>
			
			
		</div>
	</div>
	
</div>	

@endif