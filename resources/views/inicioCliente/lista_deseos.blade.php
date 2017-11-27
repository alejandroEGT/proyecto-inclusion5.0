@extends('inicioCliente.clienteMaster')

@section('content')
@if ($errors->all())
			    <div class="alert alert-danger">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li class="validacionRequest"><label>{{ $error }}</label></li>
				            @endforeach
				        </ul>
			    </div>
			@endif
			@if (Session::has('exito'))
				<div class="alert alert-info">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        {{ Session::get('exito') }}
			    </div>
			@endif
	<br>
<div class="container">
	<div class="panel panel-succses">
	    <div class="panel-heading">
	        <center><p><h4>Lista de deseos</h4></p></center>
	        <hr>
	    </div>
	    <div class="panel-body">
	    	@if (count($lista)>0)
		
		@foreach ($lista as $l)
			<div class="row">
				<div class="col-md-3">
					<img src="{{ '/'.$l->foto }}" class="foto-producto-p">
				</div>
				<div class="col-md-6">
					<p><label class="lbl-nom" >{{$l->nombre}}</label></p>
					<p><label class="lbl-precio" >$ {{$l->precio}}</label></p>
					<p><button class="btn btn-raised btn-info btn-xs">
						<a href="{{ url('/verDetalleProducto/'.base64_encode($l->id_producto)) }}" style="color:white" >Ver</a>
					</button>
					<button class="btn btn-raised btn-warning btn-xs">
						<a href="{{ url('cliente/eliminarProductoLista/'.base64_encode($l->id_producto)) }}" style="color:white" >Eliminar de mi lista</a>
					</button>
					</p>
					
				</div>
			</div>
			<hr>
		@endforeach

	@endif
	@if (!count($lista))
		<center><p>Nada para listar</p></center>
	@endif
	    </div>
	</div>
		

</div>

@endsection