@extends('inicioCliente.clienteMaster')

<title>Mis compras</title>
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


			<div class="container">		
				<hr><h1 class="text-center">Mis compras</h1><hr>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 fondo-blanco">
						<div class="panel">

							@if (Session::has('Prueba'))
		<div class="container">
			
				<center><h2>No Existe la Pagina que buscas</h2></center>
				

		</div>
		@else
						@if(count($idVenta)>0)

						@foreach($arrayVenta as $compras)
						

							<div class="linea-gris"><br>
								<div class="table-condensed">
									<table class="table"><br>	
		  							<h4 class="text-center"><b>Detalle de la venta</b></h4>
									<p class="contenido-sesion"><b>Identificador de compra: </b> {{$compras[0]->id_venta}} </p>
									<p class="contenido-sesion"><b>Fecha de la compra: </b> <strong>{{date('d-m-Y / (H:i:s)', strtotime($compras[0]->fecha))}}</strong> </p>			
									</table>
									
							
							</div>


							@foreach($compras as $c)


							
							<div class="linea-gris">
								<div class="table-condensed">
									<table class="table">
									    <tbody>
										    <tr>
										      	<td>	
		  											 <div class="imagen-producto-detalle" align="center"><br>
														<img class="mdl-card__media"  src="{{ '/'.$c->fotoProducto }}">
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>

								<div class="table-striped table-condensed">
									<table class="table">
										<thead>
									      	<tr class="list-group-item-light">
									      		<th>Producto</th>
									      	</tr>
									    </thead>

										<tbody>
											<tr>
										        <td>{{ $c->nombreProducto }}</td>
										    </tr>
									    </tbody>

									    <thead>
									    	<tr class="list-group-item-light">
									    		<th>Descripcion</th>
									    	</tr>
									    </thead>

									    <tbody>
									    	<tr>
									    		<td>{{$c->descripcionProducto}}</td>
									    	</tr>
									    </tbody>

									        <thead>
									    	<tr class="list-group-item-light">									    	
									        	<th>Cantidad</th>
									    	</tr>
									    </thead>

									    <tbody>
									    	<tr>
										        <td>{{ $c->cantidadProducto }}</td> 
									    	</tr>
									    </tbody>

									    <thead>
									    	<tr class="list-group-item-light">
										   		<th>Precio unitario</th>
									    	</tr>
									    </thead>

									    <tbody>
									    	<tr>
									    		<td>{{ '$'.number_format($c->precioProducto, 0, ',', '.') }} CLP </td>
									    	</tr>
									    </tbody>

									    <thead>
									    	<tr class="list-group-item-light">
										   		<th>Total</th>
									    	</tr>
									    </thead>

									    <tbody>
									    	<tr>
									    		<td>{{ '$'.number_format($c->precioProducto*$c->cantidadProducto, 0, ',', '.') }} CLP </td>
									    	</tr>
									    </tbody>

									    <thead>
									    	<tr class="list-group-item-light">
										        <th>Estado del pago</th>
									    	</tr>
									    </thead>

									    <tbody>
									    	<tr>
												<td>{{$c->nombre_estado}}</td>
									    	</tr>
									    </tbody>

									</table>
								</div>
							</div>


						@endforeach
						<br><div class="separacion-compras"><img src="/ico/separar.png"></div><br>	
					@endforeach
					
						<center>{{ $idVenta->links() }}</center>
						@endif
							@if (!count($idVenta))
									<center><h1>No tienen niguna compra realizada aun.</h1></center>
									<hr>
							@endif	
				
						</div>
					</div>
				</div>
			</div>

				@endif

@endsection