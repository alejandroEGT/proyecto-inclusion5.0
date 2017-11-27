@extends('inicioCliente.clienteMaster')

<title>Cancelar Compra</title>
@section('content')
<div class="cancelar_compra">
<center><img src="/khipu/compra_aceptar.gif"></center>
</div>


<script>
	setTimeout(function(){
		location.href = '{{url('/cliente/perfil_cliente')}}';
	}, 5000);
</script>
@endsection