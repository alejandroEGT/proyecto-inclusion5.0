@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')

	@include('verDetalle.todas_noticias_locales', ['ruta' => 'userDependiente', 'user' => 3])

@endsection