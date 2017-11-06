@extends('encargadoArea.master_encargadoArea')

@section('content')

	@include('verDetalle.verMasServiciosInstitucion',['ruta' => 'encargadoArea', 'user' => 2])

@endsection