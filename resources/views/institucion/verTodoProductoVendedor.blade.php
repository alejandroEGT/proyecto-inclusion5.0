@extends('institucion.master_institucion')

@section('content')
	
	@include('verDetalle.verMasProductosVendedor', ['ruta' => 'institucion'])

@endsection