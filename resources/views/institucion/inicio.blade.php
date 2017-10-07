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
				<center><label>Noticias Generales</label></center>
				<hr>
				<img class="img-notix"  src="http://www.uaa.mx/rectoria/dcrp/wp-content/uploads/2015/05/184-Reuni%C3%B3n-SICOM.jpg" height="70" width="90">
				<p class="img-titu" ><label>reunión en los angeles con canciller y ministors del interior y de educación</label></p>
				<p class="img-titu" ><a href="#" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
			
				<hr>
				<img class="img-notix"  src="https://jazminoddy.files.wordpress.com/2016/04/12002982_1648419215376199_7949008010979303282_n-770x400.jpg?w=662" height="70" width="90">
				<p class="img-titu"><label>Jovenes crean nuevos productos de innovación</label></p>
				<p class="img-titu" ><a href="#" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
				<hr>
				<p><label><small><a href="#">Ver todas las noticias...</a></small></label></p>

				<hr>
				
				<center><label>Noticias Locales</label></center>
				<hr>
				<img class="img-notix"  src="http://www.uaa.mx/rectoria/dcrp/wp-content/uploads/2015/05/184-Reuni%C3%B3n-SICOM.jpg" height="70" width="90">
				<p class="img-titu" ><label>reunión en los angeles con canciller y ministors del interior y de educación</label></p>
				<p class="img-titu" ><a href="#" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
			
				<hr>
				<img class="img-notix"  src="https://jazminoddy.files.wordpress.com/2016/04/12002982_1648419215376199_7949008010979303282_n-770x400.jpg?w=662" height="70" width="90">
				<p class="img-titu"><label>Jovenes crean nuevos productos de innovación</label></p>
				<p class="img-titu" ><a href="#" class="btn btn-info btn-block btn-xs" >Ver mas</a></p>
				<hr>
				<p><label><small><a href="#">Ver todas las noticias...</a></small></label></p>
				<hr>
				
			</div>
			<div class="col-md-7  fondo-blanco">
				@if (count($productos)>0)
					<div class="row">
						<div class="col-md-12">
							<center><label>Productos</label>  <i class="fa fa-tags" aria-hidden="true"></i></center>
							<hr>
							
							@foreach ($productos as $producto)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$producto->foto }}" class="img-thumbnail img-prod ">
									<p>{{ $producto->nombre }}</p>
									<p><a href="" class="btn btn-primary btn-xs">Ver</a></p>
								</center>

							</div>	
							@endforeach
								<!--<center>{{-- $productos->links() --}}</center>-->
							<center class="center-top" ><label><small><a href="#">Ver mas..</a></small></label></center>
						</div>

					</div>

				@endif
				@if (!count($productos))
					<center><label for="">No Existen productos para mostrar</label></center>
				@endif
				
				<hr>

				@if (count($productos)>0)
					<div class="row">
						<div class="col-md-12">
							<center><label>Servicios</label> <i class="fa fa-star-o" aria-hidden="true"></i></center>
							<hr>
							
							@foreach ($productos as $producto)
							<div class="box-producto">
								<center>
									<img src="{{ '/'.$producto->foto }}" class="img-thumbnail img-prod ">
									<p>{{ $producto->nombre }}</p>
									<p><a href="" class="btn btn-primary btn-xs">Ver</a></p>
								</center>

							</div>	
							@endforeach
							<!--<center>{{-- $productos->links() --}}</center>-->
							<center class="center-top" ><label><small><a href="#">Ver mas..</a></small></label></center>
						</div>

					</div>

				@endif
				@if (!count($productos))
					<center><label for="">No Existen Servicios para mostrar</label></center>
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



