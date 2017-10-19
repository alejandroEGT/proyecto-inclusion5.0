@extends('vendedorIndependiente.master_vendedorIndependiente')

@section('content')

<form action="" method="" enctype="multipart/form-data" >
	<div class="row">
		<div class="col-md-offset-2 col-md-2">
			<a href="{{ url('institucion/inicio') }} "><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
			<div class="ico-speaker"></div>
		</div>

		<div class="col-md-6">
			<p class="panel-title-agregar-mv"><label>¿Que estas ofreciendo?</label></p>
			<p class="panel-body-mst"><label>
				En este formulario puedes publicar productos.</label>
			</p>
			<div class="row">
				<div class="col-md-10">
					<input type="" class="form-control input" maxlength="50" placeholder="Ingrese nombre del producto" name="nombre">
				</div>
			</div>		
		</div>
	</div>
	<hr>

		<div class="row">
			
			<div class="col-md-offset-2 col-md-3">
				<p><input type="text" placeholder="Descripción del producto..." maxlength="250" class="form-control input" name="descripcion"></p>
			</div>
			<div class="col-md-2">
				<p><input type="numeric" maxlength="4" placeholder="Cantidad..." class="form-control input" name="cantidad"></p>
			</div>
			<div class="col-md-2">
				<p><select name="categoria" class="form-control input" >
					<option value="" >Seleccione categoría..</option>
				
						<option value=""></option>
			
					
				</select></p>
			</div>
		</div>
		<hr>

		<div class="row">
		{{ csrf_field() }}
			<div class="col-md-offset-2 col-md-2">
				<input type="numeric" maxlength="7" minlength="2" name="valor" class="form-control input" placeholder="Ingrese valor">
			</div>

			<div class="col-md-2">			
				<p><label for="file-input" class="label-foto-link">
				 	<img src="/ico/image.png" for="file-input" class="label-foto-link">
				 	Agregar foto..
				</label></p>
				<input style="display: none;" name="fotoP1" id="file-input" type="file"/>

					<div id="divFoto" hidden="true" >
						<div id="img_destino" class="porte img-thumbnail" ></div>
					</div>	
			</div>

			<div class="col-md-offset-1 col-md-2">
				<input class="btn" type="submit" name="" value="Registrar">
			</div>

		</div>
	</div>
</form>



<hr>
		<div class="row">
			<div class="col-md-12">

					<center><label>Productos</label></center>
							
				<table class="table table-responsive">
					 <tr class="head-color" >
					 	<th>Id</th>
					    <th>Foto</th>
					    <th>Nombre</th> 
					    <th>Descripcion</th>
					    <th>creado</th>
					    <th>Opción</th>
					 </tr>
				
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>
							<a class="btn btn-primary btn-xs" href="">Ver..</a>
						<form id="eliminar" action="" method="post">
							{{ csrf_field() }}
							<input type="hidden" value="" name="idProducto">	
							<br>
							<input type="button"  class="btn btn-warning btn-xs" value="Eliminar" >
						</form>	
						</td>
					</tr>
				    
		>
					  
				</table>
				<center></center>
			
					<center><label>No hay productos</label></center>

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