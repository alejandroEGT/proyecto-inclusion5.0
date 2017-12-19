@extends('encargadoArea.master_encargadoArea')

{{--@section('content')--}}

@section('content')
	<form action="{{ url('encargadoArea/guardarProducto') }}" method="post" enctype="multipart/form-data" >
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
						<input type="" class="form-control input" maxlength="50" placeholder="Ingrese nombre del producto" name="nombre">
					</div>
				</div>		
			</div>
			<div class="col-md-2">
				<div id="divFoto" hidden="true" >
						<div id="img_destino" class="porte img-thumbnail" ></div>
					</div>
			</div>
		</div>
		<hr>
			@if ($errors->all())
				<div class="alert alert-info">
					<center>
						<ul>
						@foreach ($errors->all() as $error)
							<i class="fa fa-info-circle" aria-hidden="true"></i> <li>{{$error}}</li>
						@endforeach
						</ul>
					</center>
				</div>
			@endif
			@if (Session::has('registro'))
					<div class="alert alert-info">
						<center><i class="fa fa-check" aria-hidden="true"></i> {{ Session::get('registro') }}</center>
					</div>
			@endif
	
		<div class="row">
			
			<div class="col-md-offset-2 col-md-3">
				<label>Descripción del producto</label>
				<p><input type="text" placeholder="Descripción del producto..." maxlength="250" class="form-control input" name="descripcion"></p>
			</div>
			<div class="col-md-2">
				<label>Cantidad</label>
				<p><input type="numeric" maxlength="4" placeholder="Cantidad..." class="form-control input" name="cantidad"></p>
			</div>
			<div class="col-md-2">
				<label>Categoría</label>
				<p><select name="categoria" class="form-control input" >
					<option value="">Seleccione categoría..</option>
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
				<label>Valor del producto (CLP)</label>
				<input type="numeric" maxlength="7" minlength="2" name="valor" class="form-control input" placeholder="Ingrese valor">
			</div>
			<div class="col-md-3">
				<br>
				<p><label for="file-input" class="label-foto-link">
				 	<img src="/ico/image.png" for="file-input" class="label-foto-link">
				 	Agregar foto..
				</label></p>
				<input style="display: none;" name="foto" id="file-input" type="file"/>
					
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-offset-2 col-md-7">
				<input class="btn btn-primary btn-block" type="submit" name="" value="Registrar">
			</div>
		</div>
	</form>	
		<hr>
		<div class="row">
			<div class="col-md-12">
				@if (count($productos)>0)
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
					@foreach ($productos as $p)

					<tr>
						<td>{{ $p->idProducto }}</td>
						<td><img src="{{ '/'.$p->foto }}" height="70"></td>
						<td><label>{{ $p->nombre }}</label></td>
						<td><label>{{ $p->descripcion }}</label></td>
						<td><label>{{ $p->creado }}</label></td>
						<td>
							<a class="btn btn-primary btn-xs" href="{{ url("encargadoArea/detalleProducto/".base64_encode($p->idProducto)) }}">Ver..</a>
										
							<input type="button" @click="eliminarProducto({!! $p->idProducto  !!})" class="btn btn-warning btn-xs" value="Eliminar"/>
						</td>
					</tr>
				    
				     
				    @endforeach
					  
				</table>
				{{ $productos->links() }}
				@endif
				@if (count($productos)<=0)
					<center><label>No hay productos</label></center>
				@endif

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
{{--@endsection--}}