@extends('invitado.master_invitado')

@section('content')
	<div class="padding color-verde">
		<div class="row">
			<div class="col-md-12">
				<h3>Registro de usuario institucional</h3>
				<h4 class="txt">Registro de usuario que pertenesca y sea apoyado por una institución.</h4>
			</div>
		</div>
		<div class="ico-userInstituto-form animated bounceIn"></div>
	</div>

	<form action="/insertar" method="post">
		{{ csrf_field() }}
		<div class="container estilo-form animated fadeInUp">
			<div class="row">
					<div class="col-md-offset-3 col-md-3">
						<p class="p-form">Nombres</p>
						<input name="nombres" class="form-control input" type="text">
						<p class="p-form">Apellidos</p>
						<input name="apellidos" class="form-control input" type="text">
						<p class="p-form">Fecha de Nacimiento</p>
    						<input name="dia" class="form-control fech" size="2" maxlength="2" type="text"  required>-
    						<input name="mes" class="form-control fech" size="2" maxlength="2" type="text" required>-
    						<input name="anio" class="form-control fech" size="2" maxlength="4" type="text" required>
						<p class="p-form">Institución</p>
						<select name="id_institucion" @change="filtraArea"  class="form-control input" name="" id="">
							<option value="">Seleccione...</option>
							@foreach ($institucion as $ins)
								<option value="{{$ins->id}}">{{ $ins->nombre }}</option>
							@endforeach
						</select>
						<p class="p-form">Area o especialidad</p>
						<select name="id_area" class="form-control input" name="" id="">
							<option value="">Seleccione...</option>
							<option v-for="item in id_area" v-bind:value="item.id">@{{ item.nombre }}</option>	
						</select>
					</div>
					<div class="col-md-3">
						<p class="p-form">Sexo</p>
						<select name="id_sexo"  class="form-control input" name="" id="">
							<option value="">Seleccione...</option>
							@foreach ($sexo as $sex)
								<option value="{{$sex->id}}">{{ $sex->nombre }}</option>
							@endforeach
						</select>
						<p class="p-form">Nª telefono</p>
						<input name="telefono" class="form-control input" type="text">
						<p class="p-form">Correo</p>
						<input name="correo" class="form-control input" type="text">
						<p class="p-form">Clave</p>
						<input name="clave" class="form-control input" type="password">
						<p class="p-form">Repita Clave</p>
						<input name="rClave" class="form-control input" type="password">
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