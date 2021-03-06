@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')

	@section('content')
<center><label>{{$titulo}}</label></center>
<hr>
<div class="row">
	<div class="col-md-offset-2 col-md-8 panel">
		<form action="{{ url('encargadoArea/filtrarServicio') }}" method="GET"> 
								  <div class="row">
								    <div class="col-md-12">
								      <div class="input-group">
								      	{{ csrf_field() }}
								   <input type="text" class="form-control" placeholder="Buscar servicios" name="buscar"/>
								   <div class="input-group-btn">
								        <button class="btn btn-primary" type="submit">
								        <span class="glyphicon glyphicon-search"></span>
								        </button>
								   </div>
								   </div>
								    </div>
								  </div>
							</form>	
	</div>
</div>
<div class="row">
	<div class="col-md-offset-2 col-md-8 panel">
		@if (count($servicios)>0)
			@foreach ($servicios as $servicio)
				<div class="row">
					<div class="col-md-3  ">
						<img src="{{'/'.$servicio->foto}}" class="img-thumbnail img-responsive " >
					</div>
					<div class="col-md-3  ">
						<p><label>{{ $servicio->nombre }}</label></p>
						<p><label style="color:#85929E" >{{ $servicio->descripcion }}</label></p>
						<p>
							<a class="btn btn-primary btn-xs" href="{{ url("userDependiente/detalleServicio/".base64_encode($servicio->id)) }}">Ver..</a>	
						</p>
					</div>
				</div>
			@endforeach
		@endif
		@if (!count($servicios))
			<label for="">No hay servicios <img src="/ico/sad.png"></label>
		@endif
	</div>
</div>

@endsection

@endsection