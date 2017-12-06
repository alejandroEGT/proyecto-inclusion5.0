@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')

	@include('verDetalle.verMasServiciosAlumno',['ruta' => 'userDependiente' ])

@endsection