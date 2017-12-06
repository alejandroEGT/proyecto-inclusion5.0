@extends('institucion.master_institucion')

@section('content')

	@include('verDetalle.verMasServiciosAlumno',['ruta' => 'institucion', 'user' => 1])

@endsection