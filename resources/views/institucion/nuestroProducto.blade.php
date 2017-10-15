 @extends('institucion.master_institucion')

@section('content')
<center><label>{{$titulo}}</label></center>
<hr>
<div class="row">
	<div class="col-md-offset-2 col-md-8 panel">
		<form action="{{ url('institucion/filtrarProducto') }}" method="GET"> 
						  <div class="row">
						    <div class="col-md-12">
						      <div class="input-group">
						      	{{ csrf_field() }}
						   <input type="text" class="form-control" placeholder="Buscar productos" name="buscar"/>
						   <div class="input-group-btn">
						        <button class="btn btn-primary" type="submit">
						        <span class="glyphicon glyphicon-search"></span>
						        </button>
						   </div>
						   </div>
						    </div>
						  </div>
						</form>	
	</div>
</div>
<div class="row">
	<div class="col-md-offset-2 col-md-8 panel">
		@if (count($productos)>0)
			@foreach ($productos as $producto)
				<div class="row">
					<div class="col-md-3  ">
						<img src="{{'/'.$producto->foto}}" class="img-thumbnail img-responsive " >
					</div>
					<div class="col-md-3  ">
						<p><label>{{ $producto->nombre }}</label></p>
						<p><label style="color:#85929E" >{{ $producto->descripcion }}</label></p>
						<p>
							<form id="eliminar" action="{{ url("institucion/eliminar_producto_institucion") }}" method="post">
							{{ csrf_field() }}
							<a class="btn btn-primary btn-xs" href="{{ url("institucion/detalleProducto/".base64_encode($producto->idProducto)) }}">Ver..</a>
							<input type="hidden" value="{{ base64_encode($producto->idProducto) }}" name="idProducto">	
							
							<input type="button" @click="eliminarProducto" class="btn btn-warning btn-xs" value="Eliminar" >
						</form>	
						</p>
					</div>
				</div>
			@endforeach
		@endif
	</div>
</div>

@endsection