@extends('institucion.master_institucion')

@section('content')

	@include('verDetalle.verMasServiciosInstitucion',['ruta' => 'institucion', 'user' => 1])

@endsection