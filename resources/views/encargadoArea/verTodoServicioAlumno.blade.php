@extends('encargadoArea.master_encargadoArea')

@section('content')

	@include('verDetalle.verMasServiciosAlumno',['ruta' => 'encargadoArea', 'user' => 2])

@endsection