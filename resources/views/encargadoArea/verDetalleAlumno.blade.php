@extends('encargadoArea.master_encargadoArea')

@section('content')

	@include('verDetalle.alumno', ['ruta' => 'encargadoArea', 'user' => 2])

@endsection