<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
<div class="row">
	<div class="col-md-offset-2 col-md-8 fondo-blanco">
		 <center>
			<img src="{{ '/'.$institucion->logo}}" class="img-circle img-prod ">
			<p><label class="lbl-" ></label></p>
			<hr>
		</center>	
	</div>
</div>
<div class="row">
	<div class="col-md-offset-2 col-md-8  fondo-blanco">
				@if (count($productos)>0)
					<div class="row">
						<div class="col-md-12">
							<center><label>Productos</label>  <i class="fa fa-tags" aria-hidden="true"></i></center>
						
		
							<hr>
							
							@foreach ($productos as $producto)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$producto->foto }}" class="img-thumbnail img-prod ">
									<p>{{ str_limit($producto->nombre,10) }}</p>
									<p><label class="lbl-precio" > $ {{ number_format($producto->precio,0,',','.') }}</label></p>
									<p><a href="{{ url($ruta.'/detalleProducto/'.base64_encode($producto->idProducto).'/'.base64_encode($institucion->id)) }}" class="btn btn-primary btn-xs">Ver</a>
									
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
</div>	