@extends('invitado.master_invitado')

@section('content')
	
	<div class="padding color-verde">
		<div class="row">
			<div class="col-md-12 animated bounceInDown">
				<h3>BienVenido a nuestro sitio web</h3>
				<h4 class="txt">Somos un sistema sin fines de lucro denominados como "Proyecto Inclusión", puedes registrarte gratis de las siguientes maneras que tenemos para ti o institucion a la que pertenescas</h4>
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
	<hr>
	<div class="row">
		<div class="col-md-12">
			<h5><a class="a-center" href="/formInstitucion">Registrar una institución</a></h5>
		</div>
	</div>

@endsection