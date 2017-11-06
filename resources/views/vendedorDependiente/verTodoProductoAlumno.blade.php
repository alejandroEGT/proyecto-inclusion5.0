@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
	
	@include('verDetalle.verMasProductosAlumno', ['ruta' => 'userDependiente'])

@endsection