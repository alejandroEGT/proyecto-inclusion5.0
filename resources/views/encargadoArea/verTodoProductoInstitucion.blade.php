@extends('encargadoArea.master_encargadoArea')

@section('content')
	
	@include('verDetalle.verMasProductosInstitucion', [ 'ruta' => 'encargadoArea'])

@endsection