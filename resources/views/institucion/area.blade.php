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
			<small><label>Al registrar un encargado la contraseña temporal se le enviará a su correo, Una vez añadido un encargado podras visualizar las actividades de esta area</label></small>
			<hr>
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
							<input type="" name="telefono" class="form-control ">
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
			
		

		<div class="row panel">
			<div class="col-md-12">
				<p><label>Encargado(a):</label> @{{ bd_encargado }}</p>	
			</div>
		</div>
	</div>
@endsection