
@extends('encargadoArea.master_encargadoArea')

@section('content')

	@include('verDetalle.todas_noticias_locales', ['ruta' => 'encargadoArea'])

@endsection