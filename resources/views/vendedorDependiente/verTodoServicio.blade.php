@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
	@include('buscar_dentro.todoServicio',['ruta' => 'userDependiente', 'user' => 3])
@endsection