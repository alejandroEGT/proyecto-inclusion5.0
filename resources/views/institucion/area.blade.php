@extends('institucion.master_institucion')

@section('content')
<label id="v_area" hidden="true" >{{ $area->id }}</label>
	<div class="container padre-agregar">
		<div class="row panel">
			<div class="col-md-offset-1 col-md-4">
				<p style="text-align: center" class="panel-title-agregar-mv"><label>{{ $area->nombre}}</label></p>
				<p style="text-align: center" class="panel-body-mst"><label>{{ $area->descripcion }}</label>
				</p>
				<div class="ico-news"></div>
			</div>
			<div class="col-md-6">
			<p><label>Agregar encargado</label></p>
			<small><label>Al registrar un encargado la contraseña temporal se le enviará a su correo, Una vez añadido un encargado podrás visualizar las actividades de esta área</label></small>
			<hr>
			@if (count($errors))
			<div class="row alert alert-danger">
					<div class="col-md-offset-1 col-md-10">
						<a href="" class="close" data-dismiss="alert">&times;</a>
							@foreach ($errors->all() as $error)
								<ul>
									<li>{{ $error }}</li>
								</ul>
							@endforeach
					</div>				
			</div>
		@endif
				<form action="{{ url('institucion/agregarUsuario') }}" method="post"  >
					<div class="row">
						<div class="col-md-6">
							{{ csrf_field() }}
							<input name="area" type="hidden" value="{{ $area->id }}">
							<label>Nombres</label>
							<input type="" name="nombres" class="form-control " >
							<label>Apellidos</label>
							<input type="" name="apellidos" class="form-control " >
							<label>Correo</label>
							<input name="correo" type="text" name="" class="form-control ">
						</div>
						<div class="col-md-6">
							<label>Nª Teléfono</label>
							<input type="numeric" name="telefono" class="form-control ">
							<p class="p-form">Sexo</p>
							<select name="id_sexo"  class="form-control input" name="" id="">
								<option value="">Seleccione...</option>
								@foreach ($sexo as $sex)
									<option value="{{$sex->id}}">{{ $sex->nombre }}</option>
								@endforeach
							</select>
							<br clear="brcss" >
							<input class="btn btn-block btn-success top-btn" type="submit" value="registrar">
						</div>
					</div>
				</form>	
			</div>
		</div>	

		<div class="row panel">
			<div class="col-md-1">
				<button data-toggle="collapse" data-target="#demo" class="btn btn-info badge1" data-badge="{{ $contar }}">Personas</button>
			</div>
			<div class="col-md-3">
				<button class="btn btn-success badge1" data-badge="0">Productos y servicios</button>
			</div>
			<div class="col-md-5 ">
				<div v-if="this.existeEncargado == true">
					<p><label>Encargado(a):</label>@{{bd_encargadoId}} @{{ bd_encargadoNombre }} <button @click="eliminarEncargado(bd_encargadoId)" class="btn btn-primary btn-xs">Eliminar</button>	
				</div>
				<div v-if="this.existeEncargado == false">
					<p><label>No existe encargado(a)</label> 
				</div>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="demo" class="collapse">
						@if (!is_null($venInstitucion))
							
							<table class="table table-hover">
								<tr>
									<td>Foto</td>
									<td>Nombre</td>
									<td>Correo</td>
								</tr>							
								@foreach ($venInstitucion as $ven)
									<tr>
										<td><img height="70" src="{{'/'.$ven->foto}}"></td>
										<td>{{$ven->nombres.' '.$ven->apellidos}}</td>
										<td>{{$ven->email}}</td>
									</tr>
								@endforeach
							</table>

						@endif
						@if (is_null($venInstitucion))
							<p>no existen registros de usuarios..</p>
						@endif
				</div>
			</div>
		</div>
	</div>
@endsection