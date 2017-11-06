 @extends('institucion.master_institucion')

@section('content')

<center><label>{{$titulo}}</label></center>
<hr>
<div class="row">
	<div class="col-md-offset-2 col-md-8 panel">
		<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
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
						
							<a class="btn btn-primary btn-xs" href="{{ url("institucion/detalleProducto/".base64_encode($producto->idProducto)) }}">Ver..</a>
							<input type="button" @click="eliminarProducto({!! $producto->idProducto  !!})" class="btn btn-warning btn-xs" value="Eliminar"/>	
							
							
						</p>
					</div>
				</div>
			@endforeach
		@endif
		@if (!count($productos))
			<label>No hay productos <img src="/ico/sad.png"> </label>
		@endif
	</div>
</div>

@endsection