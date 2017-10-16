@extends('institucion.master_institucion')

@section('content')
	<div class="">
			<p class="text-center" >Notificacione de Integración de productos</p>
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
									<td>{{ $esp->creado }}</td>
									<td>{{ $esp->nombreEstado}}</td>
									<td><a  class="btn btn-success" @click="aceptarProducto({{ $esp->idProducto }})" >Aceptar</a> | <input class="btn btn-danger" type="button" value="Cancelar"></td>
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