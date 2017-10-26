@extends('invitado.master_invitado')

@section('content')
	
	<div class="padding color-verde">
		<div class="row">
			<div class="col-md-12">
				<h3><label>Registro institucional</label></h3>
				<h4 class="txt"><label>Registro de una institución que trabaje y apoye el arte de personas en situación de discapacidad.</label></h4>
			</div>
		</div>
		<div class="ico-instituto-form animated bounceIn"></div>
	</div>


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
				        {{ Session::get('ingresado') }}
			    </div>
			@endif
			
		</div>
	</div>

	<form action="{{ url('/guardarInstitucion') }}" method="post" enctype="multipart/form-data" >
		<div class="container estilo-form animated fadeInUp">
			<div class="row">
				<div class="col-md-offset-3 col-md-3">
					{{ csrf_field() }}
					<label  class="p-form">RUT</label>
					<input  class="form-control input" type="text" name="rut" placeholder="rut" value="{{ old('rut') }}" >
					<label  class="p-form">Nombre</label>
					<input  class="form-control input" type="text" name="nombre" placeholder="nombre" value="{{ old('nombre') }}" >
					<label  class="p-form">Razón Social</label>
					<input  class="form-control input" type="text" name="razonSocial" placeholder="razón social" value="{{ old('razonSocial') }}" >
					<label  class="p-form">Teléfono 1</label>
					<input  class="form-control input" type="numeric" name="telefono1" placeholder="telefono 1" value="{{ old('telefono1') }}" >
					<label class="p-form">Télefono 2</label>
					<input class="form-control input" type="numeric" name="telefono2" placeholder="telefono 2" value="{{ old('telefono2') }}">
				</div>
					<div class="col-md-3">
						<label  class="p-form">Dirección</label>
						<input class="form-control input" type="text" name="direccion" placeholder="dirección" value="{{ old('direccion') }}">
						<label  class="p-form">Logo</label>
						<input class="form-control input" type="file" name="logo" placeholder="logo" value="{{ old('logo') }}" >
						<label  class="p-form">Correo</label>
						<input class="form-control input" type="text" name="correo" placeholder="correo" value="{{ old('correo') }}">
						<label  class="p-form">Clave</label>
						<input class="form-control input" type="password" name="clave" placeholder="clave">
						<label  class="p-form">Repita Clave</label>
						<input class="form-control input" type="password" name="repeClave" placeholder="nuevamente clave" >
					</div>
			</div>
			<div class="row top">
				<div class="col-md-offset-3 col-md-6">
					<input class="btn btn-success input-btn" type="submit" value="Registrar" >
				</div>
			</div>
		</div>
		
	</form>	
@endsection