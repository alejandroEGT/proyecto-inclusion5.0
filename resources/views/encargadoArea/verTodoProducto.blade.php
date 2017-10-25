@extends('encargadoArea.master_encargadoArea')

@section('content')
	@include('buscar_dentro.todoProducto',['ruta' => 'encargadoArea', 'user' => 2])
@endsection