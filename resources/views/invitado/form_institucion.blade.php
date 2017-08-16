@extends('invitado.master_invitado')

@section('content')
	
	<div class="padding color-verde">
		<div class="row">
			<div class="col-md-12">
				<h3>Registro institucional</h3>
				<h4 class="txt">Registro de una institución que trabaje y apoye el arte de personas en situación de discapacidad.</h4>
			</div>
		</div>
		<div class="ico-instituto-form animated bounceIn"></div>
	</div>


	<div class="row" >
		<div class="col-md-offset-3 col-md-6">
			@if ($errors->any())
			    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
			    </div>
			@endif
			
		</div>
	</div>

	<form action="/guardarInstitucion" method="post" enctype="multipart/form-data" >
		<div class="container estilo-form animated fadeInUp">
			<div class="row">
				<div class="col-md-offset-3 col-md-3">
					{{ csrf_field() }}
					<label  class="p-form">RUT</label>
					<input  class="form-control input" type="text" name="rut" placeholder="rut" >
					<label  class="p-form">Nombre</label>
					<input  class="form-control input" type="text" name="nombre" placeholder="nombre" >
					<label class="p-form">Razon Social</label>
					<input  class="form-control input" type="text" name="razonSocial" placeholder="razón social" >
					<label  class="p-form">Telefono 1</label>
					<input  class="form-control input" type="text" name="telefono1" placeholder="telefono 1" >
					<p class="p-form">Telefono 2</p>
					<input class="form-control input" type="text" name="telefono2" placeholder="telefono 2">
				</div>
					<div class="col-md-3">
						<p  class="p-form">Dirección</p>
						<input class="form-control input" type="text" name="direccion" placeholder="dirección">
						<p  class="p-form">Logo</p>
						<input class="form-control input" type="file" name="logo" placeholder="logo">
						<p  class="p-form">Correo</p>
						<input class="form-control input" type="text" name="correo" placeholder="correo">
						<p  class="p-form">Clave</p>
						<input class="form-control input" type="password" name="clave" placeholder="clave">
						<p  class="p-form">Repita Clave</p>
						<input class="form-control input" type="password" name="repeClave" placeholder="nuevamente clave">
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