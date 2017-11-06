@extends('institucion.master_institucion')

@section('content')

	@include('verDetalle.verMasServiciosArea',['ruta' => 'institucion', 'user' => 1])

@endsection