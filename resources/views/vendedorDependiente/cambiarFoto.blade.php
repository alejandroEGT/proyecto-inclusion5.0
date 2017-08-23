@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
	
	<div class="container">
		<div class="top-top">
			<div class="papelImagen">
				<div class="cabeza">
					
					<div class="ico-photo"></div>

				</div>
		
				
			    <div class="subir">
			    	<form action="{{ url('userDependiente/guardarFoto') }}" method="post" enctype='multipart/form-data' >
			    		{{ csrf_field() }}
			    		<p><label>Recuerda que tu foto de perfil es publica y obligatoria.</label></p>
				    	<label for="file-input" class="label-foto-link">
				        	Click aquí para cambiar foto de perfil
				    	</label>

				   		 <input style="display: none;" name="fotoP" id="file-input" type="file"/>
				   		 <br/><br/>
				   		 <input type="submit" name="" value="Guardar Imagen" class="btn btn-primary" >
			
					</form>
			    </div>
			</div>
		</div>

	</div>

@endsection