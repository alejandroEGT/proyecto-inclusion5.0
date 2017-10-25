@extends('institucion.master_institucion')

@section('content')

	@include('buscar_dentro.todoServicio',['ruta' => 'institucion', 'user' => 1])

@endsection