@extends('institucion.master_institucion')


@section('content')
	<form action="{{ url('institucion/publicarProducto') }}" method="post" enctype="multipart/form-data" >
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
						<input type="" class="form-control input" placeholder="Ingrese nombre del producto" name="nombre">
					</div>
				</div>		
			</div>
		</div>
		<hr>
			@if ($errors->all())
				<div class="alert alert-info">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif
			@if (Session::has('registro'))
								<div class="alert alert-info">{{ Session::get('registro') }}</div>
							@endif
	
		<div class="row">
			
			<div class="col-md-offset-2 col-md-3">
				<p><input type="text" placeholder="Descripción del producto..." class="form-control input" name="descripcion"></p>
			</div>
			<div class="col-md-2">
				<p><input type="numeric" placeholder="Cantidad..." class="form-control input" name="cantidad"></p>
			</div>
			<div class="col-md-2">
				<p><select name="categoria" class="form-control input" >
					<option>Seleccione categoría..</option>
					@foreach ($categoria_pro as $categoria)
						<option value="{{$categoria->id }}">{{$categoria->nombre }}</option>
					@endforeach
					
				</select></p>
			</div>
		</div>
		<hr>
		<div class="row">
		{{ csrf_field() }}
			<div class="col-md-offset-2 col-md-3">
				<input type="text" name="valor" class="form-control input" placeholder="Ingrese valor">
			</div>
			<div class="col-md-3">
				
				<p><label for="file-input" class="label-foto-link">
				 	<img src="/ico/image.png" for="file-input" class="label-foto-link">
				 	Agregar foto..
				</label></p>
				<input style="display: none;" name="fotoP1" id="file-input" type="file"/>

					<div id="divFoto" hidden="true" >
						<div id="img_destino" class="porte img-thumbnail" ></div>
					</div>
					
			</div>
			<div class="col-md-2">
				<input class="btn" type="submit" name="" value="Registrar">
			</div>
			
		</div>
	</form>
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
