<div class="col-md-offset-2 col-md-8  fondo-blanco">
	@if (count($servicios)>0)
					<div class="row">
						<div class="col-md-12">
							<center>
								<label>Servicios</label> <i class="fa fa-star-o" aria-hidden="true"></i>
							</center>

							<form action="{{ url($ruta.'/filtrarServicio') }}" method="GET"> 
								  <div class="row">
								    <div class="col-md-12">
								      <div class="input-group">
								      	{{ csrf_field() }}
								   <input type="text" class="form-control" placeholder="Buscar servicios" name="buscar"/>
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
							
							@foreach ($servicios as $servicio)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$servicio->foto }}" class="img-thumbnail img-prod ">
									<p>{{ str_limit($servicio->nombre, 10) }}</p>
									<p><a href="{{ url($ruta.'/detalleServicio/'.base64_encode($servicio->id)) }}" class="btn btn-primary btn-xs">Ver</a>
									<input type="button" @click="eliminarServicio({!! $servicio->id !!});"  class="btn btn-danger btn-xs" value="Eliminar" >
									</p>
								</center>

							</div>	
							@endforeach
							<!--<center>{{-- $productos->links() --}}</center>-->
							
						</div>

					</div>

				@endif
				@if (!count($servicios))
					<center><label for="">No Existen Servicios para mostrar</label></center>
				@endif
</div>