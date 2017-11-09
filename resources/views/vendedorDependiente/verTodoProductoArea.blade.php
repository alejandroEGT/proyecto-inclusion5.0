@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
	
	@include('verDetalle.verMasProductoArea', [ 'ruta' => 'userDependiente'])

@endsection