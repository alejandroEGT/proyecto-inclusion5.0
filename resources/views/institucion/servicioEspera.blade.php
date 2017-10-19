@extends('institucion.master_institucion')

@section('content')
	<div class="">
			<p class="text-center" >Notificacione de Integración de servicios</p>
			<div class="row papel-blanco">
				@if (Session::has('correcto'))
				<div class="alert alert-info">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        {{ Session::get('correcto') }}
			    </div>
			@endif
				<div class="col-md-12">
					@if (count($serv_esp)>0)
						
						<div class="table-responsive">
							<table class="table table-hover">
			  					<tr class="fondo-color-blue">
			  						<td><strong>Foto</strong></td>
			  						<td><strong>Nombre</strong></td>
			  						<td><strong>descripción</strong></td>
			  						<th>Área</th>
			  						<td><strong>Fecha de creación</strong></td>
			  						<td><strong>Estado</strong></td>
			  						<td><strong>Opciones</strong></td>
			  					</tr>
								@foreach ($serv_esp as $es)
									<tr>
										<td><img src="{{'/'.$es->foto}}" height="70" width="90" ></td>
										<td>{{ $es->nombre }}</td>
										<td>{{ $es->descripcion}}</td>
										<td>{{ $es->nombreArea}}</td>
										<td>{{ $es->creado }}</td>
										<td>{{ $es->nombreEstado}}</td>
										<td><a  class="btn btn-success" @click="aceptarServicio({{ $es->id }})" >Aceptar</a> | <input class="btn btn-danger" type="button" value="Cancelar"></td>
									</tr>	
								@endforeach	
							</table>	
						</div>	
					@endif	
					@if (count($serv_esp)==0)
						<center><h5>No hay Notificaciones...</h5></center>
					@endif
				</div>
			</div>
		
	</div>
@endsection