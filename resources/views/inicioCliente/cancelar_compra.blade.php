@extends('inicioCliente.clienteMaster')

<title>Cancelar Compra</title>
@section('content')
<div class="cancelar_compra">
<center><h2>Compra cancelada</h2></center>
<center><h3>Redireccionando a la cesta</h3></center>
<center><img src="/khipu/proceso_compra.gif"></center>
</div>


<script>
	setTimeout(function(){
		location.href = '{{url('/carro/miCarro')}}';
	}, 5000);
</script>
@endsection