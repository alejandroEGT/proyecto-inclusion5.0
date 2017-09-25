@extends('institucion.master_institucion')

@section('content')

<div class="margen">
	<a href="{{ url('institucion/inicio') }} "><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
		<div class="row">
			<div class="col-md-offset-2 col-md-2">
				<div class="ico-add"></div>
			</div>
			<div class="col-md-6">
				<p class="panel-title-agregar">Generar contraseñas</p>
				<p class="panel-body-mst">
					En esta vista podras generar contraseñas para los alumnos o encargados que olviden e impida iniciar sus cuentas personales.
				</p>
			</div>
		</div>
		  <div class="row">
	        <div class="col-md-12">
	         <input type="text" class="form-control" v-model="txtBuscar" @keyup="buscarUsuario()" placeholder="Ingrese el nombre de la persona a buscar">
	            <table class="table table-striped" v-if="txtBuscar != ''" >
	                        <tr>
	                        	<td style="font-size:13px"><strong>Foto</strong></td>
	                            <td style="font-size:13px"><strong>Nombre</strong></td>
	                            <td style="font-size:13px"><strong>Correo</strong></td>
	                            <td style="font-size:13px"><strong>Rol</strong></td>
	                            <td style="font-size:13px"><strong>Área</strong></td>
	                            <td style="font-size:13px"><strong>Acción</strong></td>
	                        </tr>
	                        <tr v-for="d in users" >
	                       		<td> <img :src="'/'+d.foto" height="50"> </td>
	                            <td style="font-size:12px;">@{{d.nombres+' '+d.apellidos}}</td>
	                            <td style="font-size:12px;">@{{d.email}}</td>
	                            <td style="font-size:12px;">@{{d.nombreRol}}</td>
	                            <td style="font-size:12px;">@{{d.nombreArea}}</td>
	                            <td><input type="submit" class="btn btn-success btn-xs" value="Generar contraseña" name=""></td>
	                        </tr>
	            </table>
	         </div>   
    	 </div>
</div>

@endsection