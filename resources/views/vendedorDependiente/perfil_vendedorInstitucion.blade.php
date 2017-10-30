@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')

@include('buscar_dentro.perfil_vendedorInstitucion', ['ruta' => 'userDependiente'])

@endsection