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


						@foreach($mis_compras as $compras)
							
							<div class="panel">
									<br><h4 class="text-center"><b>Resumen de la compra</b> {{$compras->fecha}} </h4><br>
				
								<div class="table-condensed">
									<table class="table">
									    <tbody>
										    <tr>
										      	<td>	
		  											 <div class="imagen-producto-detalle" align="center"><br>
														<img class="mdl-card__media"  src="{{ '/'.$compras->fotoProducto }}">
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
										        <td>{{ $compras->nombreProducto }}</td>
										    </tr>
									    </tbody>

									    <thead>
									    	<tr class="list-group-item-light">
									    		<th>Descripcion</th>
									    	</tr>
									    </thead>

									    <tbody>
									    	<tr>
									    		<td>{{$compras->descripcionProducto}}</td>
									    	</tr>
									    </tbody>

									        <thead>
									    	<tr class="list-group-item-light">									    	
									        	<th>Cantidad</th>
									    	</tr>
									    </thead>

									    <tbody>
									    	<tr>
										        <td>{{ $compras->cantidadProducto }}</td> 
									    	</tr>
									    </tbody>

									    <thead>
									    	<tr class="list-group-item-light">
										   		<th>Precio unitario</th>
									    	</tr>
									    </thead>

									    <tbody>
									    	<tr>
									    		<td>{{ '$'.$compras->precioProducto }} CLP </td>
									    	</tr>
									    </tbody>

									    <thead>
									    	<tr class="list-group-item-light">
										        <th>estado de compra</th>
									    	</tr>
									    </thead>

									    <tbody>
									    	<tr>
												<td>{{$compras->nombre_estado}}</td>
									    	</tr>
									    </tbody>

									</table>
								</div>
							</div><br>
						@endforeach
					</div>
				</div>
			</div>

			

@endsection