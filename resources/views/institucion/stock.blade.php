@extends('institucion.master_institucion')
@section('content')
	@if ($errors->any())
			    <div class="alert alert-danger">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li class="validacionRequest"><label>{{ $error }}</label></li>
				            @endforeach
				        </ul>
			    </div>
			@endif
			@if (Session::has('correcto'))
				<div class="alert alert-info">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <center>
				        	<i class="fa fa-check" aria-hidden="true"></i> {{ Session::get('correcto') }}
				        </center>	
			    </div>
			@endif
			@if (Session::has('incorrecto'))
				<div class="alert alert-danger">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <center>
				        	<i class="fa fa-info-circle" aria-hidden="true"></i> {{ Session::get('incorrecto') }}
				        </center>	
			    </div>
			@endif
	<center><i class="fa fa-cogs" aria-hidden="true"></i> <label>Stock minimo</label></center>
	<br>
	<center>
		<label>En esta configuración te podemos alertar cuando tengas un stock de productos criticos, sin importar su tipo o área de la que pertenezca.</label>

		<center>

			<form action="{{ url('institucion/activar_stock_min') }}" method="post">
				{{ csrf_field() }}
				<small><strong>Alertar cuando la cantidad de mis productos sea menor a: 
							<select class="" name="cantidad" >
								<option value="1" >1</option>
								<option value="2" >2</option>
								<option value="3" >3</option>
								<option value="4" >4</option>
								<option value="5" >5</option>
								<option value="6" >6</option>
								<option value="7" >7</option>
								<option value="8" >8</option>
								<option value="9" >9</option>
								<option value="10" >10</option>
							</select>
						</strong>
					</small>
					<br><br>
					<p><button type="submit" class="btn btn-success btn-sm" >Activar cambio</button></p>
					<br>
					@if ($opcion == null)
						<p><i class="fa fa-times" aria-hidden="true"></i> Opcion no activada</p>
					@endif
					@if ($opcion != null)
						<p><i class="fa fa-check" aria-hidden="true"></i> alertar cuando existan productos con cantidades menores a {{$opcion->cantidad_minima}}</p>
					@endif
				
			</form>		
		</center>


	</center>

@endsection