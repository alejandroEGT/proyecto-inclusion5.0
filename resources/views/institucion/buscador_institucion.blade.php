@extends('institucion.master_institucion')

@section('content')
	<div class="padre-agregar">
		<div class="row">
			<div class="col-md-offset-2 col-md-6 panel">
				@foreach ($datos as $d)
					<p><img src="{{'/'.$d->foto}}" class="img-thumbnail" width="100" height="120">  {{ $d->nombres.' '.$d->apellidos}}</p>
				@endforeach
			</div>
		</div>
	</div>

@endsection