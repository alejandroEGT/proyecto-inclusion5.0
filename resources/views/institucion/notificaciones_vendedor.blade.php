@extends('institucion.master_institucion')

@section('content')
	
	<div class="">
			<p class="text-center" >Notificacione de Alumnos</p>
			<div class="row papel-blanco">
				<div class="col-md-12">
					@if (count($userEsperando)>0)
						
						<div class="table-responsive">
							<table class="table table-hover">
			  					<tr>
			  						<td><strong>Nombre</strong></td>
			  						<td><strong>Correo</strong></td>
			  						<td><strong>Telefono</strong></td>
			  						<td><strong>Día de solicitud</strong></td>
			  						<td><strong>Area Solicitada</strong></td>
			  						<td><strong>Opciones</strong></td>
			  					</tr>
								@foreach ($userEsperando as $esp)
								<tr>
									<td>{{ $esp->nombres.' '.$esp->apellidos }}</td>
									<td>{{ $esp->email }}</td>
									<td>{{ $esp->telefono }}</td>
									<td>{{ $esp->created_at }}</td>
									<td>{{ $esp->nombre }}</td>
									<td><a  class="btn btn-success" @click="aceptarSolicitud({{ $esp->id_user }})" >Aceptar</a> | <input class="btn btn-danger" type="button" value="Cancelar"></td>
								</tr>
								@endforeach		
							</table>	
						</div>	
					@endif	
					@if (count($userEsperando)==0)
						<center><h5>No hay Notificaciones...</h5></center>
					@endif
				</div>
			</div>
		
	</div>

@endsection