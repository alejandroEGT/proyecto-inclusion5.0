@extends('institucion.master_institucion')

@section('content')
	@include('buscar_dentro.todoProducto',['ruta' => 'institucion', 'user' => 1])
@endsection