@extends('institucion.master_institucion')

@section('content')
	<div class="">
			<p class="text-center" ><label>Notificacione de Integración de productos</label></p>
			<center><label><small>Antes de aceptar un producto debes verificar que su información sea correcta y cuidadosa.</small></label></center>
			<div class="row papel-blanco">
				@if (Session::has('correcto'))
				<div class="alert alert-info">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        {{ Session::get('correcto') }}
			    </div>
			@endif
				<div class="col-md-12">
					@if (count($prod_esp)>0)
						
						<div class="table-responsive">
							<table class="table table-hover">
			  					<tr class="fondo-color-blue">
			  						<td><strong>Foto</strong></td>
			  						<td><strong>Nombre</strong></td>
			  						<td><strong>descripción</strong></td>
			  						
			  						<td><strong>Área o especialdiad</strong></td>
			  						<td><strong>Fecha de creación</strong></td>
			  						<td><strong>Estado</strong></td>
			  						<td><strong>Opciones</strong></td>
			  					</tr>
								@foreach ($prod_esp as $esp)
									<tr>
										<td>
											<img src="{{ '/'.$esp->foto}}" height="60" width="75">
										</td>
										<td>{{ $esp->nombre }}</td>
										<td>{{ $esp->descripcion }}</td>
										
										<td>{{ $esp->nombreArea }}</td>
										<td>{{ date('h:i:s - d/m/Y', strtotime($esp->creado)) }}</td>
										<td>{{ $esp->nombreEstado}}</td>
										<td><p><a class="btn btn-primary btn-xs" href="{{ url("institucion/detalleProducto/".base64_encode($esp->idProducto)) }}">Ver (recomendado)</a></p><p><a  class="btn btn-success btn-xs" @click="aceptarProducto({{ $esp->idProducto }})" >Aceptar</a></p><p> <a class="btn btn-danger btn-xs" @click="eliminarProductoEspera({{ $esp->idProducto }})" >Cancelar</a></td>
									</tr>
								@endforeach		
							</table>	
						</div>	
					@endif	
					@if (count($prod_esp)==0)
						<center><h5>No hay Notificaciones...</h5></center>
					@endif
				</div>
			</div>
		
	</div>
@endsection