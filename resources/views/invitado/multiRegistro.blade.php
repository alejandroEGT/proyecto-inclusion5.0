@extends('invitado.master_invitado')

@section('content')
	
	<div class="padding color-verde">
		<div class="row">
			<div class="col-md-12 animated bounceInDown">
				<h4><label>Bienvenido a nuestro sitio web</label></h4>
				<h4 class="txt"><label>Este proyecto es una versión de prueba, puedes registrarte segun tu situación.</label></h4>
			</div>
		</div>
		<div class="ico-delivery animated bounceInDown"></div>
	</div>
	<div class="animated bounceIn" >
		<p class="p-center-tittle "><label>Registrate como:</label></p>
		<div class="salto row">
			<div class="col-md-offset-2 col-md-4">
				<div onclick="schoolUser()" class="ico-schooluser"></div>
				<p class="p-center" ><label>usuario de institución</label></p>
			</div>
			<div class="col-md-4">
				<div onclick="userOnly()" class="ico-user"></div>
				<p class="p-center"><label>usuario individual</label></p>
			</div>
		</div>
	</div>

@endsection