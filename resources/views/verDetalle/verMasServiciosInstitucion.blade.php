

<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
<div class="row">
	<div class="col-md-offset-2 col-md-8 fondo-blanco">
		 <center>
				<img src="{{ '/'.$institucion->logo }}" class="img-circle img-prod ">
			
			<p><label class="lbl-" ></label></p>
			<hr>
		</center>	
	</div>
</div>
<div class="row">
	<div class="col-md-offset-2 col-md-8  fondo-blanco">
				@if (count($servicios)>0)
					<div class="row">
						<div class="col-md-12">
							<center><label>Servicios</label>  <i class="fa fa-tags" aria-hidden="true"></i></center>
						
		
							<hr>
							@foreach ($servicios as $servicio)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$servicio->foto }}" class="img-thumbnail img-prod ">
									<p>{{ str_limit($servicio->nombre,10) }}</p>
								
									<p><a href="{{ url($ruta.'/detalleServicio/'.base64_encode($servicio->id).'/'.base64_encode($institucion->id)) }}" class="btn btn-primary btn-xs">Ver a</a>
									
									</p>
								</center>

							</div>	
							@endforeach
								<center>{{$servicios->links()}}</center>
							
						</div>

					</div>

				@endif
				@if (!count($servicios))
					<center><label for="">No Existen servicios para mostrar</label></center>
				@endif
	</div>
</div>	