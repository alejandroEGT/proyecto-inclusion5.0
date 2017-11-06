@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')

	@include('verDetalle.verMasServiciosInstitucion',['ruta' => 'userDependiente'])

@endsection