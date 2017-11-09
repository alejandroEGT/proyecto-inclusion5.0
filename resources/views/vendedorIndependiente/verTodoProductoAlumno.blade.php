@extends('institucion.master_institucion')

@section('content')
	
	@include('verDetalle.verMasProductosAlumno', ['ruta' => 'institucion'])

@endsection