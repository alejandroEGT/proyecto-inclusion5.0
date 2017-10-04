<title>Productos</title>
@extends('inicioCliente.clienteMaster')

@section('content')


							<div class="col-md-6">
								<div><h1>{{$productos->nombre}}</h1></div>
								<div><h3>{{$productos->descripcion}}</h3></div>
							</div>




@endsection