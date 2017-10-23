@extends('invitado.master_invitado')

@section('content')

	<div class="padding color-verde">
		<div class="row">
			<div class="col-md-12">
				<h3><label>Registro de usuario</label></h3>
				<h4 class="txt"><label>Registro de usuario individual o no perteneciente a una institución.</label></h4>
			</div>
		</div>
		<div class="ico-user-form animated bounceIn"></div>
	</div>

	<form action="/insertar_vendedor" method="Post">
		{{csrf_field()}}
		<div class="container estilo-form animated fadeInUp ">

	<!-- Validacion de campos vacios-->
				@if (count($errors))
				<div class="row">
					<div class="col-md-offset-3 col-md-6">
						<div class="alert alert-danger">
						    <a href="" class="close" data-dismiss="alert">&times;</a>
						    @foreach ($errors->all() as $e)
								<ul>
									<li>{{ $e }}</li>
								</ul>
							@endforeach
						</div>
					</div>
				</div>	
				@endif
				@if (Session::has('ingresado'))
					<div class="col-md-offset-3 col-md-6">
						<div class="alert alert-info">
					    <a href="" class="close" data-dismiss="alert">&times;</a>
						        {{ Session::get('ingresado') }}
					    </div>
					</div>    
			@endif
			<div class="row">
					<div class="col-md-offset-3 col-md-3">
						<label class="p-form">Nombres</label>
						<input name="nombres" class="form-control input" type="text" placeholder="Nombres" value="{{ old('nombres') }}">
						<label class="p-form">Apellidos</label>
						<input name="apellidos" class="form-control input" type="text" placeholder="Apellidos" value="{{ old('apellidos') }}">
						<label class="p-form">Fecha de Nacimiento</label>
    						<p>
    						<!--<input name="dia" class="form-control fech" size="2" maxlength="2" type="text" placeholder="Día" value="{{--old('dia')--}}">-
    						<input name="mes" class="form-control fech" size="2" maxlength="2" type="text" placeholder="Mes" value="{{--old('mes')--}}">-
    						<input name="anio" class="form-control fech" size="2" maxlength="4" type="text" placeholder="Año" value="{{--old('anio')--}}" >-->
    						<input type="date" class="form-control input" name="fecha">
    						</p>
						<label class="p-form">Sexo</label>
						<select name="id_sexo"  class="form-control input" >
							<option value="">Seleccione su sexo</option>
							@foreach ($sexo as $sex)
								<option value="{{$sex->id}}">{{ $sex->nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label class="p-form">Nª telefono</label>
						<input name="telefono" class="form-control input" type="text" placeholder="Telefono" value="{{ old('telefono') }}">
						<label class="p-form">Correo</label>
						<input name="correo" class="form-control input" type="text" placeholder="Correo" value="{{ old('correo') }}">
						<label class="p-form">Clave</label>
						<input name="clave" class="form-control input" type="password" placeholder="Clave">
						<label class="p-form">Repita Clave</label>
						<input name="rClave" class="form-control input" type="password" placeholder="Clave nuevamente">
					</div>
			</div>
			<div class="row top">
				<div class="col-md-offset-3 col-md-6">
					<input class="btn btn-success input-btn" type="submit" value="Registrar">
				</div>
			</div>
		</div>
	</form>	
@endsection