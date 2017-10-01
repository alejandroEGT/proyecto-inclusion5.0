@extends('institucion.master_institucion')

@section('content')

	@include('verDetalle.producto', ['ruta' => 'institucion', 'user' => 1])

@endsection