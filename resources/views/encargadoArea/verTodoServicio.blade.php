@extends('encargadoArea.master_encargadoArea')

@section('content')
	@include('buscar_dentro.todoServicio',['ruta' => 'encargadoArea', 'user' => 2])
@endsection