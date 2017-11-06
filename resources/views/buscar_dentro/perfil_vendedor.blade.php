<div class=" well background-blue">
<div class="row">
	<div class="col-md-offset-1 col-md-3">
		<img src="{{ url($foto) }}" class="img img-thumbnail img-responsive img-circle tamanio" >
	</div>
	<div class="col-md-4">
		<p><strong class="nombreblue" ><i class="fa fa-user" aria-hidden="true"></i> {{$usuario->nombres.' '.$usuario->apellidos}}</strong></p>
		<p><strong class="correo" ><i class="fa fa-envelope" aria-hidden="true"></i> {{$usuario->email}}</strong></p>
		<p><strong class="numero" ><label><i class="fa fa-phone" aria-hidden="true"></i> {{$vendedor->telefono}}</label></strong></p>
		<p><strong><label>Vendedor</label></strong></p>

	</div>
</div>
	
</div>

@if (count($productos)>0)
					<div class="row">
						<div class="col-md-offset-2 col-md-8 panel">
							<center><label>Productos</label> <i class="fa fa-star-o" aria-hidden="true"></i></center>
							<hr>
							
							@foreach ($productos as $producto)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$producto->foto }}" class="img-thumbnail img-prod ">
									<p>{{ str_limit($producto->nombre, 10) }}</p>
									<p><a href="{{ url($ruta.'/detalleProductoVendedor/'.base64_encode($producto->idProducto).'/'.base64_encode($vendedor->id)) }}" class="btn btn-primary btn-xs">Ver</a></p>
								</center>

							</div>	
							@endforeach

							<center class="center-top" ><label><small><a href="#">Ver mas..</a></small></label></center>
						</div>

					</div>

				@endif