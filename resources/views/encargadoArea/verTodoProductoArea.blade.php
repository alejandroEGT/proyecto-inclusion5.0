@extends('encargadoArea.master_encargadoArea')

@section('content')
	
	@include('verDetalle.verMasProductoArea', [ 'ruta' => 'encargadoArea'])

@endsection