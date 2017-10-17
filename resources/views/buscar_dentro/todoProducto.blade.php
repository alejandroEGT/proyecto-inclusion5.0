<div class="col-md-12  fondo-blanco">
				@if (count($productos)>0)
					<div class="row">
						<div class="col-md-offset-2 col-md-8">
							<center><label>Productos</label>  <i class="fa fa-tags" aria-hidden="true"></i></center>
						
						<form action="{{ url($ruta.'/filtrarProducto') }}" method="GET"> 
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
						

							<hr>
							
							@foreach ($productos as $producto)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$producto->foto }}" class="img-thumbnail img-prod ">
									<p>{{ str_limit($producto->nombre,10) }}</p>
									<p><a href="{{ url($ruta.'/detalleProducto/'.base64_encode($producto->idProducto)) }}" class="btn btn-primary btn-xs">Ver</a>
									
									<input type="button" @click="eliminarProducto({!! $producto->idProducto  !!})" class="btn btn-warning btn-xs" value="Eliminar"/>
									</p>
								</center>

							</div>	
							@endforeach
								<center>{{$productos->links()}}</center>
							
						</div>

					</div>

				@endif
				@if (!count($productos))
					<center><label for="">No Existen productos para mostrar</label></center>
				@endif
</div>			