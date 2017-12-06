@extends('vendedorIndependiente.master_vendedorIndependiente')		

@section('content')

		@if (Session::has('cambio'))
	            <div class="row">
						<div class="alert alert-info">
						    <a href="" class="close" data-dismiss="alert">&times;</a>
						    <center>{{ Session::get('cambio') }}</center>
						</div>
				</div>	
		@endif
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
			<div class="papelImagen">
				<div class="cabeza">
					
					<div class="ico-photo"></div>

				</div>
		
				
			    <div class="subir">
			    	<form action="{{ url('userIndependiente/guardarFoto') }}" method="post" enctype='multipart/form-data' >
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

@endsection