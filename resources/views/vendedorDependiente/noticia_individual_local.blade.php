@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
	@include('verDetalle.unica_noticia_local', ['ruta' => 'userDependiente'])
@endsection