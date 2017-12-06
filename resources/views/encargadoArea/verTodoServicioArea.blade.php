@extends('encargadoArea.master_encargadoArea')

@section('content')

	@include('verDetalle.verMasServiciosArea',['ruta' => 'encargadoArea', 'user' => 2])

@endsection