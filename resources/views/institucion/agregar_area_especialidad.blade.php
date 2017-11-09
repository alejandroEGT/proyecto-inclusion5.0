@extends('institucion.master_institucion')

@section('content')
	
	<div class="">
	<a href="{{ url('institucion/inicio') }} "><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
		<div class="row">
			<div class="col-md-offset-2 col-md-2">
				<div class="ico-addArea"></div>
			</div>
			<div class="col-md-6">
				<p class="panel-title-agregar">Ingresa un área o especialidad </p>
				<p class="panel-body-mst">
					En este formulario podrás registrar las áreas o especialidades que tenga la institución, también podrás asignar un encargado en cada área o especialidad.
				</p>
			</div>
		</div>
		<div class="row animated buttomytop fadeInLeft">
			<form  @submit.prevent="formArea" method="POST" >
					<div class="col-md-offset-1 col-md-6">
						{{ csrf_field() }}
						<p><label>Nombre de área o especialdiad</label></p>
						<input  v-model="inserarArea.nombre" type="text" class="form-control" placeholder="Área o especialidad" autofocus>
						<p><label>Nombre descripción</label></p>
						<textarea v-model="inserarArea.desc" class="form-control" name="" id="" cols="20" rows="5"></textarea>
					</div>
					<div class="col-md-1 padding">
						<input type="submit" class="btn" value="registrar" >
					</div>
			</form>
		</div>

		<div class="container" >
			<table class=" table table-responsive ">
				<tr class="tr-estilo" >
					<td><strong>Nombre de Area</strong></td>
					<td><strong>Descripción</strong></td>
					<td><strong>Ver</strong></td>
					<!--<td><strong>Correo</strong></td>-->
				</tr>
				<tr v-for="item in db_area">
					<td>@{{ item.nombre }}</td>
					<td>@{{ item.descripcion }}</td>
					<td><a :href="'verArea/' + item.id"> <i class="fa fa-eye" ></i> ver..</a></td>
				</tr>	
			</table>

		</div>
		</div>

	</div>

@endsection