@extends('institucion.master_institucion')

@section('content')

	<a href="{{ url('institucion/inicio') }} "><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
		<div class="row">
			<div class="col-md-offset-2 col-md-2">
				<div class="ico-add"></div>
			</div>
			<div class="col-md-6">
				<p class="panel-title-agregar">Generar contraseñas para encargados de área</p>
				<p class="panel-body-mst">
					En esta vista podras generar contraseñas para los encargados que olviden e impida iniciar sus cuentas personales.
				</p>
			</div>
		</div>
		  <div class="row">
	        <div class="col-md-12">
	       
	            <table class="table table-striped" >
	                        <tr>
	                        	<td style="font-size:13px"><strong>Identidad</strong></td>
	                        	<td style="font-size:13px"><strong>Foto</strong></td>
	                            <td style="font-size:13px"><strong>Nombre</strong></td>
	                            <td style="font-size:13px"><strong>Correo</strong></td>
	                            <td style="font-size:13px"><strong>Rol</strong></td>
	                            <td style="font-size:13px"><strong>Área</strong></td>
	                            <td style="font-size:13px"><strong>Acción</strong></td>
	                        </tr>
	                       @if (count($encargados)>0)
	                       	 @foreach ($encargados as $en)
	                       	 	<tr>
		                        	<td style="font-size:12px;"><label>{{$en->id_user}}</label></td>
		                       		<td> <img src="{{'/'.$en->foto}}" class="sizeFP"> </td>
		                            <td style="font-size:12px;">{{$en->nombre.' '.$en->apellido}}</td>
		                            <td style="font-size:12px;">{{$en->email}}</td>
		                            <td style="font-size:12px;">{{$en->nombreRol}}</td>
		                            <td style="font-size:12px;">{{$en->nombreArea}}</td>
		                            <td><input @click="generarClave({{$en->id_user}})" type="submit" class="btn btn-success btn-xs" value="Generar contraseña" name=""></td>
	                        	</tr>
	                       	 @endforeach
	                       @endif
	                       @if (!count($encargados))
	                       	<center><label>No existen encargados</label></center>					
	                       @endif
	            </table>
	         </div>   
    	 </div>


@endsection