 @extends('institucion.master_institucion')

@section('content')

@if (isset($institucion))
	<div class="padre" >
		<div class="row">
			<div class="col-md-12 well">
				<div class="centro" >
					<img src="{{ '/'.$institucion->logo }}" width="100">
					<p class="p-titulo-inst"> {{ $institucion->nombre }} </p>

				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-offset-1 col-md-6 papel-inicio">
				<div class="papel-titulo">
					<p>Publicar tus novedades <div class="ico-push" ></div></p>
				</div>
				<div class="papel-body" >
					<p>Puedes publicar tus novedades cuando gustes, tambien lo podran hacer personas que pertenescan a {{Auth::guard('institucion')->user()->nombre}}</p>
						<div class="botones-grupo">
							<button class="btn btn-verde" >Pubicar Producto</button>
							<button class="btn btn-naranja" >Pubicar Servicio</button>
						</div>
				</div>
			</div>
			<div class="col-md-4">
					<div class="panel panel-info">
					  <div class="panel-heading">Agregar información a nuestra institución</div>
					  <div class="panel-body">
					  		<div class="list-group">
	 							<a class="list-group-item" href="agregarAE"> <i class="fa fa-plus"></i> Agregar Area / Especialidad</a>
	 							<a class="list-group-item" href="agregarAlumno"> <i class="fa fa-plus"></i> Agregar Alumno</a>
	 							<a class="list-group-item" href="#"> <i class="fa fa-plus"></i> Agregar mi sitio web</a>
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



