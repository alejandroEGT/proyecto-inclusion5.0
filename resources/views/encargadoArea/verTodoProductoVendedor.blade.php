@extends('encargadoArea.master_encargadoArea')

@section('content')
	
	@include('verDetalle.verMasProductosVendedor', ['ruta' => 'encargadoArea'])

@endsection