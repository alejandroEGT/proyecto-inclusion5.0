@extends('institucion.master_institucion')

@section('content')
	@include('verDetalle.todas_noticias_locales', ['ruta' => 'institucion'])
@endsection