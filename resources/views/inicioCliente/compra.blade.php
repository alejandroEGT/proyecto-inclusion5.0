@extends('inicioCliente.clienteMaster')

<title>Detalle Compra</title>
@section('content')



			<!--<div class="container">
				<div class="row">

						<div class="col-xs-12 col-sm-12 col-md-6"><br>
							<div class="panel">
								<ul class="list-group">
									<li class="list-group-item list-group-item-info"><b>Direccion</b></li>
					 				<li class="list-group-item list-group-item-light"><b>Lugar:</b>mi casa</li>
									<li class="list-group-item list-group-item-light"><b>Direccion:</b>mi direccion</li>
									<li class="list-group-item list-group-item-light"><b>Ciudad:</b>los angeles bio bio</li>
								</ul>
								<br>
								<center><button type="submit" class="btn btn-primary btn-outline-danger">Modificar</button></center>
							</div>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-6"><br>	
							<div class="panel">
								<ul class="list-group">
									<li class="list-group-item list-group-item-success"><b>Nueva Direccion</b></li>
					 				<li class="list-group-item list-group-item-light"><b>Nombre:</b>
					 					<input type="text" class="form-control">
					 				</li>
									<li class="list-group-item list-group-item-light"><b>Direccion:</b>
										<input type="text" class="form-control">
									</li>
									<li class="list-group-item list-group-item-light"><b>Region:</b>
										<select class="form-control" id="Region">
									      <option>Bio-Bio</option>
									    </select>
									</li>
									<li class="list-group-item list-group-item-light"><b>Ciudad:</b>
										<select class="form-control" id="Ciudad">
									      <option>Los Angeles</option>
									      <option>Nacimiento</option>
									      <option>Mulchen</option>
									    </select>
									</li>
								</ul>
									<center><button type="submit" class="btn btn-primary btn-outline-success">guardar</button></center>
							</div>
						</div>

				</div>
			</div>-->

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
				<hr><h1 class="text-center">Resumen de la compra</h1><hr>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 fondo-blanco">


						@foreach($carro as $carros)
							
							<div class="panel">
									<br><h4 class="text-center"><b>Resumen del producto</b></h4><br>
				
								<div class="table-condensed">
									<table class="table">
									    <tbody>
										    <tr>
										      	<td>	
		  											 <div class="imagen-producto-detalle" align="center"><br>
														<img class="mdl-card__media"  src="{{ '/'.$carros->fotoProducto }}">
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
										        <td>{{ $carros->nombreProducto }}</td>
										    </tr>
									    </tbody>

									    <thead>
									    	<tr class="list-group-item-light">
									    		<th>Descripcion</th>
									    	</tr>
									    </thead>

									    <tbody>
									    	<tr>
									    		<td>{{$carros->descripcionProducto}}</td>
									    	</tr>
									    </tbody>

									        <thead>
									    	<tr class="list-group-item-light">									    	
									        	<th>Cantidad</th>
									    	</tr>
									    </thead>

									    <tbody>
									    	<tr>
										        <td>{{ $carros->cantidadProducto }}</td> 
									    	</tr>
									    </tbody>

									    <thead>
									    	<tr class="list-group-item-light">
										   		<th>Precio unitario</th>
									    	</tr>
									    </thead>

									    <tbody>
									    	<tr>
									    		<td>{{'$'.number_format($carros->precioProducto, 0, ',', '.')  }} CLP </td>
									    	</tr>
									    </tbody>

									        <thead>
									    	<tr class="list-group-item-light">
										        <th>Subtotal</th>
									    	</tr>
									    </thead>

									    <tbody>
									    	<tr>
												<td>{{'$'.number_format($carros->cantidadProducto*$carros->precioProducto, 0, ',', '.') }} CLP </td>
									    	</tr>
									    </tbody>

									</table>
								</div>
							</div><br>
						@endforeach
					</div>
				</div>
			</div>

			
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="panel list-group-item list-group-item-info ">

							<label><b>Total Compra:</b><label class="lbl-precio-cliente"> {{'$'.number_format($total, 0, ',', '.')}} CLP</label></label><br>

						</div><br>	
					</div>
				</div>
			</div>
			
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">

					
							
							  		<a onclick="window.history.back();"><img src="/ico/boton_volver2.png" class="posicion_volver botonImagenVolver"></a>
								
				 					
								<form action="/carro/iniciarPago" method="post">
									{{csrf_field()}}
									  	<p align="right"><input type="submit" class="botonImagenKhipu" value=" "></input></p>
								</form>	

						</div><br>	
					</div>
				</div>
			</div>

									
@endsection

