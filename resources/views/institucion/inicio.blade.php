 @extends('institucion.master_institucion')

@section('content')

@if (isset($institucion))
	<div class="" >
		<div class="row">
			<div class="col-md-12 well">
				<div class="centro1" >
					<img src="{{ '/'.$institucion->logo }}" width="100">
					<!--<p class="p-titulo-inst"> {{--$institucion->nombre--}} </p>-->
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-offset-1 col-md-6 papel-inicio">
				<div class="papel-titulo">
					<p>Publicar tus novedades <div class="ico-push" ></div></p>
				</div>
				<div class="papel-body" >
					<p>Puedes publicar tus novedades cuando gustes, también lo podrán hacer personas que pertenezcan a {{Auth::guard('institucion')->user()->nombre}}</p>
						<div class="botones-grupo">
							<a href="{{ url('institucion/publicarProducto') }}" class="btn btn-verde" >Publicar Producto</a>
							<a href="{{ url('institucion/publicarServicio') }}" class="btn btn-naranja" >Publicar Servicio</a>
						</div>
				</div>
			</div>
			<div class="col-md-4">
					<div class="panel panel-info">
					  <div class="panel-heading">Agregar información a nuestra institución</div>
					  <div class="panel-body">
					  		<div class="list-group">
	 							<a class="list-group-item" href="agregarAE"> <i class="fa fa-plus"></i> Agregar Área / Especialidad</a>
	 							<a class="list-group-item" href="agregarAlumno"> <i class="fa fa-plus"></i> Agregar Alumno</a>
	 							<a class="list-group-item" href="paginaweb"> <i class="fa fa-plus"></i> Agregar mi sitio web</a>
 						</div>
					  </div>
					</div>


			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-offset-1 col-md-3 linea-gris fondo-blanco">
				@if(count($noticias_generales)>0)
					<center><label>Noticias Generales</label></center>
					
					@foreach ($noticias_generales as $ng)
						<hr>
						<img class="img-notix"  src="{{ '/'.$ng->foto }}" height="70" width="90">
						<p class="img-titu" ><label>{{ $ng->titulo}}</label></p>
						<p class="img-titu" ><a href="{{ url('institucion/detalleNoticia_general/'.base64_encode($ng->id)) }}" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
					@endforeach
					<hr>
					<label><a href="{{ url('institucion/verNoticiasGenerales') }}">Ver todas las noticias...</a></label>

					<hr>
				@endif
				@if (!count($noticias_generales))
						<p>No existen noticias</p>
						<hr>
				@endif	
				
				@if(count($noticias_locales)>0)
					<center><label>Noticias Locales</label></center>
					@foreach ($noticias_locales as $nl)
						<hr>
						<img class="img-notix"  src="{{ '/'.$nl->foto }}" height="70" width="90">
						@if ($nl->id_estado == 1)
							<p class="img-titu" ><label>{{ $nl->titulo}}</label> <img src="/ico/world.png"></p>
						@endif
						@if ($nl->id_estado == 2)
							<p class="img-titu" ><label>{{ $nl->titulo}}</label> <img src="/ico/padlock.png"></p>
						@endif
						<p class="img-titu" ><a href="{{ url('institucion/detalleNoticia_local/'.base64_encode($nl->id)) }}" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
					@endforeach
					<hr>
					<label><a href="{{ url('institucion/verNoticiasLocales') }}">Ver todas las noticias...</a></label>
					<hr>
				@endif	
				@if (!count($noticias_locales))
					<p>No existen noticias</p>
						<hr>
				@endif
			</div>
			<div class="col-md-7  fondo-blanco">
				@if (count($productos)>0)
					<div class="row">
						<div class="col-md-12">
							<center><label>Productos</label>  <i class="fa fa-tags" aria-hidden="true"></i></center>
						
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
						

							<hr>
							
							@foreach ($productos as $producto)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$producto->foto }}" class="img-thumbnail img-prod ">
									<p>{{ str_limit($producto->nombre,10) }}</p>
									<p><a href="{{ url('institucion/detalleProducto/'.base64_encode($producto->idProducto)) }}" class="btn btn-primary btn-xs">Ver</a>
									<input type="button" @click="eliminarProducto({!! $producto->idProducto  !!})" class="btn btn-warning btn-xs" value="Eliminar"/>
									</p>
								</center>

							</div>	
							@endforeach
								<!--<center>{{-- $productos->links() --}}</center>-->
							<center class="center-top" ><label><small><a href="{{ url('institucion/ver_todo_producto') }}">Ver mas..</a></small></label></center>
						</div>

					</div>

				@endif
				@if (!count($productos))
					<center><label for="">No Existen productos para mostrar <img src="/ico/sad.png"></label></center>
				@endif
				
				<hr>

				@if (count($servicios)>0)
					<div class="row">
						<div class="col-md-12">
							<center>
								<label>Servicios</label> <i class="fa fa-star-o" aria-hidden="true"></i>
							</center>

							<form action="{{ url('institucion/filtrarServicio') }}" method="GET"> 
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
									<p><a href="{{ url('institucion/detalleServicio/'.base64_encode($servicio->id)) }}" class="btn btn-primary btn-xs">Ver</a>
										
									<input type="button" @click="eliminarServicio({!! $servicio->id !!});"  class="btn btn-danger btn-xs" value="Eliminar" >
									</p>
								</center>

							</div>	
							@endforeach
							<!--<center>{{-- $productos->links() --}}</center>-->
							<center class="center-top" ><label><small><a href="{{ url('institucion/ver_todo_servicio') }}">Ver mas..</a></small></label></center>
						</div>

					</div>

				@endif
				@if (!count($servicios))
					<center><label for="">No Existen Servicios para mostrar <img src="/ico/sad.png"></label></center>
				@endif
			</div>
		</div>
	</div>
@endif

	
 		<!--<div class="padre well">
 			<div class="row" v-for="item in db_institucion">
 					<div class="col-md-offset-1 col-md-2 centro">
 						<img onmouseover="fun_img(this)" :src="'/'+item.logo" alt="">
 					</div>
 					<div class="col-md-2 centro">
 						<p onmouseover="fun_p(this)">@{{ item.nombre }}</p>
 						<p onmouseover="fun_p(this)" >@{{ item.razonSocial }}</p>
 						<p onmouseover="fun_p(this)" >Telefono 1: @{{ item.telefono1 }}</p>
 						<p onmouseover="fun_p(this)" >Telefono 2: @{{ item.telefono2 }}</p>
 					</div>
 					<div class="col-md-4 centro">
 						<div class="ico-map" ></div><p>@{{ item.direccion }}</p>
 					</div>
 					<div class="col-md-3 mas">
 						<div class="list-group">
	 							<a class="list-group-item" href="agregarAE"> <i class="fa fa-plus"></i> Agregar Area / Especialidad</a>
	 							<a class="list-group-item" href="#"> <i class="fa fa-plus"></i> Agregar Alumno</a>
	 							<a class="list-group-item" href="#"> <i class="fa fa-plus"></i> Agregar Producto o servicio</a>
 						</div>
 					</div>
 			</div>
 		</div>-->
@endsection



