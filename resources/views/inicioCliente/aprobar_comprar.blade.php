@extends('inicioCliente.clienteMaster')

<title>Cancelar Compra</title>
@section('content')
<div class="cancelar_compra">
<center><img src="/khipu/proceso_compra.gif"></center>
<center><h2>Tu pago esta siendo procesado, al ser verifcado te llegara un correo electronico con la verificacion del pago.</h2></center>
</div>


<script>
	setTimeout(function(){
		location.href = '{{url('/cliente/mis_compras')}}';
	}, 5000);
</script>
@endsection