@extends('institucion.master_institucion')

@section('content')

<center><label>Busqueda personalizada</label></center>
<hr>
<div class="row">
	<div class="col-md-12">
		<label>Mostrar cantidad maxima de:</label>
		<form action="productos_disponibles" >
			<select name="numero" id="numero">
			<option value="1" >1 producto disponible</option>
			<option value="2" >2 productos disponible</option>
			<option value="3" >3 productos disponible</option>
			<option value="4" >4 productos disponible</option>
			<option value="5" >5 productos disponible</option>
			<option value="6" >6 productos disponible</option>
			<option value="7" >7 productos disponible</option>
			<option value="8" >8 productos disponible</option>
			<option value="9" >9 productos disponible</option>
			<option value="10" >10 productos disponible</option>
		</select>
		</form>
	</div>
</div>

@endsection