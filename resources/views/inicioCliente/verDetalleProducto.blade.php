@extends('inicioCliente.clienteMaster')

@section('content')

	
@if (is_null($productos[0]))
	<center><p style="font-size: 19px" >Nada para mostrar</p></center>
@endif
@if (!is_null($productos[0]))
	{{-- expr --}}

<br>
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
		<img src="{{ '/'.$productos[0]->foto }}" class="img-thumbnail img-responsive"><br>
	</div>
	<div class="col-md-6">
		
			<p><label><strong>Nombre:</strong></label> {{ $productos[0]->nombre }}></p>
			

			<p><label><strong>Descripción:</strong></label> {{ $productos[0]->descripcion }}</p>
			

			<p><label><strong>Precio:</strong></label> {{ $productos[0]->precio }}</p>

			<p><label><strong>Cantidad:</strong></label> {{ $productos[0]->cantidad }}</p>
		
			<p><label><strong>Visibilidad:</strong></label> {{ $productos[0]->estadoProducto }} </p>
			
			<p><label><strong>Categoría:</strong></label> {{ $productos[0]->nombreCategoria }} </p>
			
			<p><label><strong>Área o especialidad:</strong></label> {{ $productos[0]->nombreArea }} </p>
			<hr>
			<p><label><strong>Creado:</strong></label> {{ $productos[0]->creado }}</p>
			
			
		</div>
	</div>
	
</div>	

@endif


@endsection