@extends('institucion.master_institucion')

@section('content')
	<div class="">
	<a href="{{ url('institucion/inicio') }} "><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
		<div class="row">
			<div class="col-md-offset-2 col-md-2">
				<div class="ico-add"></div>
			</div>
			<div class="col-md-6">
				<p class="panel-title-agregar">Ingresa un alumno</p>
				<p class="panel-body-mst">
					<label>En este formulario podrás registrar a los alumnos que ayudan a levantar la institución, cabe señalar que ellos mismos también podrán hacerlo desde un formulario que esta fuera de esta sesión, al registrar a un alumno, su clave será enviada a su correo electrónico, la cual será temporal hasta que la actualice.</label>
				</p>
			</div>
		</div>
			
		<!--<form action="/insertar_vendedor" method="Post">-->
		<form action="agregarAlumno_insert" method="Post">
		{{csrf_field()}}
		<div class="container estilo-form animated fadeInUp ">
				<!-- Validacion de campos vacios-->
				<div class="row" >
					<div class="col-md-offset-3 col-md-6">
						@if ($errors->any())
						    <div class="alert alert-danger">
			    				<a href="" class="close" data-dismiss="alert">&times;</a>
							        <ul>
							            @foreach ($errors->all() as $error)
							                <li class="validacionRequest"><label>{{ $error }}</label></li>
							            @endforeach
							        </ul>
						    </div>
						@endif	
						@if (Session::has('ingresado'))
				<div class="alert alert-info">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <i class="fa fa-check" aria-hidden="true"></i> {{ Session::get('ingresado') }}
			    </div>
			@endif
					</div>
				</div>

			<div class="row">
					<div class="col-md-offset-2 col-md-4">
						<p class="p-form"><label>Nombres</label></p>
						<input placeholder="Nombres" name="nombres" class="form-control input" type="text" value="{{ old('nombres') }}">
						<p class="p-form"><label>Apellidos</label></p>
						<input placeholder="Apellidos" name="apellidos" class="form-control input" type="text" value="{{ old('apellidos') }}">
						<p class="p-form"><label>Fecha de Nacimiento</label></p>
    						<!--<input name="dia" class="form-control fech" size="2" maxlength="2" type="text" value="{{-- old('dia')--}}">-
    						<input name="mes" class="form-control fech" size="2" maxlength="2" type="text" value="{{-- old('mes') --}}">-
    						<input name="anio" class="form-control fech" size="2" maxlength="4" type="text" value="{{-- old('anio') --}}">-->
    						<input type="date" name="fecha" class="form-control input">
					</div>
					<div class="col-md-4">
						<p class="p-form"><label>Sexo</label></p>
						<select name="id_sexo"  class="form-control input">
							<option value="">Seleccione...</option>
							@foreach ($sexo as $sex)
								<option value="{{$sex->id}}">{{ $sex->nombre }}</option>
							@endforeach
						</select>
						<p class="p-form"><label>Nª teléfono</label></p>
						<input placeholder="Número telefónico" name="telefono" class="form-control input" type="text" value="{{ old('telefono') }}">
						
						<label class="p-form"><label>Área o especialidad</label></label>
						<select name="id_area" class="form-control input">
							<option value="">Seleccione...</option>
							@foreach ($area as $a)
								<option value="{{ $a->id }}">{{ $a->nombre }}</option>	
							@endforeach
						</select>
						<p class="p-form"><label>Correo</label> </p>
						<input placeholder="Correo electrónico" name="correo" class="form-control input" type="text" value="{{ old('correo') }}">
						
					</div>
			</div>
			<div class="row top">
				<div class="col-md-offset-3 col-md-6">
					<input class="btn btn-success input-btn" type="submit" value="Registrar">
				</div>
			</div>
		</div>
	</form>	
	</div>
@endsection