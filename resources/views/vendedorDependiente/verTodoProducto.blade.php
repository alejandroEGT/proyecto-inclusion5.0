@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
	@include('buscar_dentro.todoProducto',['ruta' => 'userDependiente', 'user' => 3])
@endsection