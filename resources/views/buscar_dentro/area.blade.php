<br>
<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
<center><label class="titulodearea" >Área o especialidad de la institución {{ $institucion->nombre }}</label></center>

<div class="row">
	<div class="col-md-offset-1 col-md-3">
			<div class="row">
				<div class="col-md-12 well blanco">
					@if ($area->logo != null)
					<center>
						<img src="{{'/'.$area->logo}}" class="img-logo">
						<br><br>
						<p><label>{{ $area->nombre }}</label></p>
					</center>			
				
					@endif
					@if ($area->logo == null)
						<center><label>(No existe logo)</label>
						<br><br>
						<p><label>{{ $area->nombre }}</label></p>
						</center>
					@endif
					<hr>
					<center>
						<label><p>{{ $area->descripcion }}</p></label>
					</center>
				</div>
			</div>
			@if (!empty($encargado))
			<div class="row">
				<div class="col-md-12 well blanco">
					<label>Encargado(a):</label><hr>
					<div class="row">
						<div class="col-md-4">
							<img src="{{'/'.$encargado->foto}}" class="sizeLogo img-circle"> 
						</div>
						<div class="col-md-8">
							<label class="letra-pequenia">{{$encargado->nombres.' '.$encargado->apellidos}}</label>
						</div>
					</div>
				</div>
			</div>
			@endif
			@if (empty($encargado))
				<div class="row">
					<div class="col-md-12 well blanco">
						<label>No existe encargado(a)..</label>
					</div>
				</div>
			@endif
			@if (count($alumnos)>0)

				<div class="row">
					<div class="col-md-12 well blanco">
						<label>Alumnos:</label>
						<hr>
						@foreach ($alumnos as $a)
							<a href="{{ url($ruta.'/perfil_venInst/'.base64_encode($a->id_user)) }}" ><img src="{{'/'.$a->foto}}" class="sizeFP "> </a>
						@endforeach
					</div>
				</div>
			@endif

	</div>
	<div class="col-md-7">
		<div class="row">
			<div class="col-md-12  well blanco">
					<p><img src="{{ '/'.$institucion->logo }}" class="sizeLogoMin" ></p>
					<p><label><strong>Institución: </strong> {{$institucion->nombre}} </label></p>
					<hr>
					<p><label><strong>Razón social: </strong> {{$institucion->razonSocial}} </label></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12  well blanco">
					@if (count($productos)>0)
					<div class="row">
						<div class="col-md-11 linea-gris fondo-blanco">
							<center><label>Productos del área o especialidad</label></center>
						<form action="{{ url('encargadoArea/filtrarProducto') }}" method="GET"> 
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
									<p>{{ str_limit($producto->nombre, 10) }}</p>
							
										<a class="btn btn-primary btn-xs" href="{{ url($ruta."/detalleProducto/".base64_encode($producto->idProducto).'/'.base64_encode($institucion->id)) }}">Ver..</a>
										

								</center>

							</div>	
							@endforeach
							<!--<center>{{--$productos->links() --}}</center>-->
							<center class="center-top" ><label><small><a href="{{ url('encargadoArea/ver_todo_producto') }}">Ver mas..</a></small></label></center>
						</div>

					</div>
					<hr>
				@endif
				@if (!count($productos))
					<center>
						<label for="">No Existen productos para mostrar</label>
						<img src="/ico/sad.png">
					</center>
					<hr>
				@endif
			</div>
		</div>
	</div>
</div>