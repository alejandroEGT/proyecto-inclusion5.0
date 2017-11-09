@extends('institucion.master_institucion')

@section('content')
	
	@include('verDetalle.verMasProductosInstitucion', [ 'ruta' => 'institucion'])

@endsection