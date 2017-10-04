@extends('institucion.master_institucion')

@section('content')

	@include('verDetalle.alumno', ['ruta' => 'institucion', 'user' => 1])

@endsection