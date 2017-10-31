@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
	
	@include('buscar_dentro.perfil_institucion' , ['ruta' => 'userDependiente'])

@endsection