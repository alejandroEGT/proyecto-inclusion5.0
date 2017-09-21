@extends('institucion.master_institucion')

@section('content')
<div class="margen">
	
<div class="container">

    <h1>Laravel 5 Chart example using Charts Package</h1>

    {!! Charts::assets() !!}
    {!! $chart->render() !!}

  </div>

</div>
@endsection
