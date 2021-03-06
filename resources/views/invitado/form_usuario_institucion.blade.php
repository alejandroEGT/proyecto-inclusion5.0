@extends('invitado.master_invitado')

@section('content')
	<div class="padding color-verde">
		<div class="row">
			<div class="col-md-12">
				<h3><label>Registro de usuario institucional</label></h3>
				<h4 class="txt"><label>Registro de usuario que pertenezca y sea apoyado por una institución.</label></h4>
			</div>
		</div>
		<div class="ico-userInstituto-form animated bounceIn"></div>
	</div>


	<form action="/insertar" method="post">
		{{ csrf_field() }}
		<div class="container estilo-form animated fadeInUp">

				<!-- Validacion de campos vacios-->
				<div class="row" >
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
				        {{ Session::get('ingresado') }}
			    </div>
			@endif
				</div>

			<div class="row">
					<div class="col-md-offset-3 col-md-3">
						<label class="p-form">Nombres</label>
						<input name="nombres" class="form-control input" type="text" placeholder="nombre" value="{{ old('nombres') }}">
						<label class="p-form">Apellidos</label>
						<input name="apellidos" class="form-control input" type="text" placeholder="apellido" value="{{ old('apellidos') }}">
						<label class="p-form">Fecha de Nacimiento</label>
    						<!--<p><input name="dia" class="form-control fech" placeholder="día" size="2" maxlength="2" type="text"  value="{{--old('dia')--}}">-
    						<input name="mes" placeholder="mes" class="form-control fech" size="2" maxlength="2" type="text"  value="{{--old('mes')--}}">-
    						<input name="anio" placeholder="año" class="form-control fech" size="2" maxlength="4" type="text" value="{{--old('anio')--}}"></p>-->
    						<p>
    							<input type="date" class="form-control input" name="fechaDeNacimiento" value={{ old('fechaDeNacimiento')}}>
    						</p>
						<label class="p-form">Institución</label>
						<select name="id_institucion" @change="filtraArea"  class="form-control input" name="" id="">
							<option value="">Seleccione...</option>
							@foreach ($institucion as $ins)
								<option value="{{$ins->id}}">{{ $ins->nombre }}</option>
							@endforeach
						</select>
						<label class="p-form">Área o especialidad</label>
						<select name="id_area" class="form-control input" name="" id="">
							<option value="">Seleccione...</option>
							<option v-for="item in id_area" v-bind:value="item.id">@{{ item.nombre }}</option>	
						</select>
					</div>
					<div class="col-md-3">
						<label class="p-form">Sexo</label>
						<select name="id_sexo"  class="form-control input" name="" id="">
							<option value="">Seleccione...</option>
							@foreach ($sexo as $sex)
								<option value="{{$sex->id}}">{{ $sex->nombre }}</option>
							@endforeach
						</select>
						<label class="p-form">Nª teléfono</label>
						<input name="telefono" class="form-control input" placeholder="teléfono" type="text" value="{{ old('telefono') }}" >
						<label class="p-form">Correo</label>
						<input name="correo" class="form-control input" placeholder="correo" type="text" value="{{ old('correo') }}" >
						<label class="p-form">Clave</label>
						<input name="clave" class="form-control input" placeholder="clave" type="password">
						<label class="p-form">Repita Clave</label>
						<input name="rClave" class="form-control input" placeholder="clave nuevamente" type="password">
					</div>
			</div>
			<div class="row top">
				<div class="col-md-offset-3 col-md-6">
					<input class="btn btn-info input-btn" type="submit" value="Registrar">
				</div>
			</div>
		</div>
		
	</form>	
@endsection