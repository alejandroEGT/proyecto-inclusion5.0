@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')

	@include('verDetalle.producto', ['ruta' => 'userDependiente', 'user' => 3])

@endsection