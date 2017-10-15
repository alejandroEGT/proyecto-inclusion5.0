@extends('institucion.master_institucion')

@section('content')

	@include('verDetalle.servicio', ['ruta' => 'institucion', 'user' => 1])

@endsection