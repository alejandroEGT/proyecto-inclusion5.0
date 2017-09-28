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
							<a href="#" class="btn btn-naranja" >Publicar Servicio</a>
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



