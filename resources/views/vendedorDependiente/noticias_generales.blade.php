@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
	@include('verDetalle.todas_noticias_generales', ['ruta' => 'userDependiente', 'user' => ''])
@endsection