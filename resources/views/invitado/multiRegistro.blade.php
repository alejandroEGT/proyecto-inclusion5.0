@extends('invitado.master_invitado')

@section('content')
	
	<div class="padding color-verde">
		<div class="row">
			<div class="col-md-12 animated bounceInDown">
				<h3>BienVenido a nuestro sitio web</h3>
				<h4 class="txt">Este proyecto es una version de prueba, puedes registrarte segun tu situación.</h4>
			</div>
		</div>
		<div class="ico-delivery animated bounceInDown"></div>
	</div>
	<div class="animated bounceIn" >
		<p class="p-center-tittle ">Registrate como:</p>
		<div class="salto row">
			<div class="col-md-offset-2 col-md-4">
				<div onclick="schoolUser()" class="ico-schooluser"></div>
				<p class="p-center" >usuario de institución</p>
			</div>
			<div class="col-md-4">
				<div onclick="userOnly()" class="ico-user"></div>
				<p class="p-center">usuario individual</p>
			</div>
		</div>
	</div>

@endsection