@extends('institucion.master_institucion')

@section('content')
	
	<div class="padding-body">
		<div class="row well blue-sky">
			<form  @submit.prevent="formArea" method="POST" >
					<div class="col-md-offset-1 col-md-6">
						{{ csrf_field() }}
						<p>Nombre de area o especialdiad</p>
						<input v-model="inserarArea.nombre" type="text" class="form-control">
						<p>Nombre descripción</p>
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
					<td><a v-bind:href="'verArea/' + item.id"> <i class="fa fa-eye" ></i> ver..</a></td>
				</tr>	
			</table>

</div>
		</div>

	</div>

@endsection