@extends('encargadoArea.master_encargadoArea')

@section('content')
	@include('verDetalle.todas_noticias_generales', ['ruta' => 'encargadoArea', 'user' => 2])
@endsection