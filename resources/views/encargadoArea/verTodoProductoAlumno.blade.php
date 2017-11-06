@extends('encargadoArea.master_encargadoArea')

@section('content')
	
	@include('verDetalle.verMasProductosAlumno', ['ruta' => 'encargadoArea'])

@endsection