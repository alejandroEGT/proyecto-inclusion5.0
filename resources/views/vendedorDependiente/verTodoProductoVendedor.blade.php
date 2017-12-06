@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
	
	@include('verDetalle.verMasProductosVendedor', ['ruta' => 'userDependiente'])

@endsection