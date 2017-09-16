@extends('encargadoArea.master_encargadoArea')

@section('content')

@section('content')
	
		<div class="row">
			<div class="col-md-offset-2 col-md-2">
			<a href="{{ URL::previous() }} "><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
				<div class="ico-speaker"></div>
			</div>
			<div class="col-md-6">
				<p class="panel-title-agregar-mv"><label>¿Que estas ofreciendo?</label></p>
				<p class="panel-body-mst"><label>
					En este formulario puedes publicar productos de un área de la institución.</label>
				</p>
				<div class="row">
					<div class="col-md-10">
						<input type="" class="form-control input" placeholder="Ingrese nombre del producto" name="">
					</div>
				</div>		
			</div>
		</div>
		<hr>
		<div class="row">
			
			<div class="col-md-offset-2 col-md-3">
				<p><input type="text" placeholder="Descripción del producto..." class="form-control input" name=""></p>
			</div>
			<div class="col-md-2">
				<p><input type="numeric" placeholder="Cantidad..." class="form-control input" name=""></p>
			</div>
			<div class="col-md-2">
				<p><select class="form-control input" >
					<option>Seleccione categoria..</option>
				</select></p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-offset-3 col-md-3">
				<p><label for="file-input" class="label-foto-link">
				 	<img src="/ico/image.png" for="file-input" class="label-foto-link">
				 	Agregar foto..
				</label></p>
				<input style="display: none;" name="fotoP" id="file-input" type="file"/>

					<div id="divFoto" hidden="true" >
						<div id="img_destino" class="porte img-thumbnail" ></div>
					</div>
			</div>
			<div class="col-md-3">
				<p><label for="file-input2" class="label-foto-link">
				 	<img src="/ico/image.png" for="file-input" class="label-foto-link">
				 	Agregar foto..
				</label></p>
				<input style="display: none;" name="fotoP" id="file-input2" type="file"/>
				<div id="divFoto2" hidden="true" >
						<div id="img_destino2" class="porte img-thumbnail" ></div>
					</div>
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
                        $('#divFoto').attr('hidden', false);
   
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            function mostrarImagen2(input) {
                if (input.files && input.files[0]) 
                {
                    var reader = new FileReader();
                    reader.onload = function (e) {
    
                        $('#img_destino2').attr('style', 'background-image:url('+e.target.result+');');
                        $('#divFoto2').attr('hidden', false);
   
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
 
                $("#file-input").change(function(){
                 mostrarImagen(this);
                 
                });
                $("#file-input2").change(function(){
                 mostrarImagen2(this);
                 
                });
        </script>
@endsection
@endsection