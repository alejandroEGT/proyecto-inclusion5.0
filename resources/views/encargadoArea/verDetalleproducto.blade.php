@extends('encargadoArea.master_encargadoArea')

@section('content')

	@include('verDetalle.producto', ['ruta' => 'encargadoArea', 'user' => 2])

@endsection