@extends('encargadoArea.master_encargadoArea')

@section('content')

<div class="row">
			<div class="col-md-12">
			<a href="{{ url('encargadoArea/inicio') }} "><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
				<center><label>Datos del área</label>
				<div class="ico-security" ></div></center>
			</div>
			
</div>
<hr>
<div class="row">
	<div class="col-md-offset-1 col-md-6">
		<p><label><strong>Nombre del área:</strong></label> <small>{{ $datos->nombre}}</small>  </p>
		<p><label><strong>Descripción:</strong></label> <small>{{ $datos->descripcion}}</small>  </p>
		<p><label><strong>fecha de creación:</strong></label> <small>{{ $datos->created_at}}</small> </p>
		<hr>
		<p><label><strong>Actual encargado(a):</strong></label> <small>{{ $datos->nombres.' '.$datos->apellidos}}</small>  </p>
		<p><label><strong>Correo:</strong></label> <small>{{ $datos->email}}</small> <button data-toggle="collapse" data-target="#correo" class="btn btn-info btn-xs">Actualizar</button> </p>
		<div id="correo" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('encargadoArea/actualizar_correo') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Correo</strong> </p>
							  		<p><input class="" type="" name="correo">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>					
								
				</div>
		<p><label><strong>Nª Teléfono:</strong></label> <small>{{ $datos->telefono}}</small> <button data-toggle="collapse" data-target="#telefono" class="btn btn-info btn-xs">Actualizar</button> </p>
		<div id="telefono" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('encargadoArea/actualizar_numero') }}" method="post">
								{{csrf_field()}}
							  		<p><strong>Actualizar Numero</strong> </p>
							  		<p><input class="" type="" name="teléfono" maxlength="9">
									<input type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>					
								
				</div>
		<hr>

		<form action="{{ url('encargadoArea/guardarIcono') }}" method="post" enctype='multipart/form-data'>
		{{ csrf_field() }}
			<div class="row">
				<div class="col-md-3">
					<p><label for="file-input" class="label-foto-link">
					 	<img src="/ico/upload.png" for="file-input" class="label-foto-link">
					 	Agregar logo
					</label></p>
					<input style="display: none;" name="fotoP" id="file-input" type="file"/>
				</div>
				<div class="col-md-8">
					<div class="row" id="divIco" hidden="true" >
					<div class="col-md-4">
						<div id="img_destino" class="porte-ico img-thumbnail" ></div>
					</div>
					<div class="col-md-2">
							<input type="submit" class="btn btn-primary btn-xs" value="guardar">
					</div>
						
					</div>
				</div>
				
			</div>
		</form>	
	</div>
</div>

@endsection

@section('js')
	<script>
            function mostrarImagen(input) {
                if (input.files && input.files[0]) 
                {
                    var reader = new FileReader();
                    reader.onload = function (e) {
    
                        $('#img_destino').attr('style', 'background-image:url('+e.target.result+');');
                        $('#divIco').attr('hidden', false);
   
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
                $("#file-input").change(function(){
                 mostrarImagen(this);
                 
                });
               
        </script>
@endsection