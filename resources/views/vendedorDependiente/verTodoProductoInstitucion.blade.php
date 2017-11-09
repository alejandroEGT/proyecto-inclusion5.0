@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
	
	@include('verDetalle.verMasProductosInstitucion', [ 'ruta' => 'userDependiente'])

@endsection