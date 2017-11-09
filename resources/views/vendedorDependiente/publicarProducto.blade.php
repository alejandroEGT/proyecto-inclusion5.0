@extends('vendedorDependiente.master_vendedorDependiente')

@section('content')
	<form action="{{ url('userDependiente/guardarProducto') }}" method="post" enctype="multipart/form-data" >
		<div class="row">
			<div class="col-md-offset-2 col-md-2">
			<a href="javascript:history.back()"><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
				<div class="ico-speaker"></div>
			</div>
			<div class="col-md-6">
				<p class="panel-title-agregar-mv"><label>¿Que estás ofreciendo?</label></p>
				<p class="panel-body-mst"><label>
					En este formulario puedes publicar productos de un área de la institución.</label>
				</p>
				<div class="row">
					<div class="col-md-10">
						<label>Nombre del producto</label>
						<input autofocus type="text" class="form-control input" maxlength="50" placeholder="Nombre del producto" name="nombre">
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
				 <div class="alert alert-danger">
			    <a href="" class="close" data-dismiss="alert">&times;</a>
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li class="validacionRequest"><label>{{ $error }}</label></li>
				            @endforeach
				        </ul>
			    </div>
			@endif
			@if (Session::has('registro'))
								<div class="alert alert-info">{{ Session::get('registro') }}</div>
							@endif
	
		<div class="row">
			
			<div class="col-md-offset-2 col-md-3">
				<label>Descripción</label>
				<p><input type="text" placeholder="Descripción del producto" maxlength="250" class="form-control input" name="descripcion"></p>
			</div>
			<div class="col-md-2">
				<label>Cantidad</label>
				<p><input type="numeric" maxlength="4" placeholder="Cantidad" class="form-control input" name="cantidad"></p>
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
				<label>Precio $ (CLP)</label>
				<input type="numeric" maxlength="7" minlength="2" name="valor" class="form-control input" placeholder="Precio">
			</div>
			<div class="col-md-3">
				<br>
				<p><label for="file-input" class="label-foto-link">
				 	<img src="/ico/image.png" class="sizeLogo" for="file-input" class="label-foto-link">
				 	Agregar foto..
				</label></p>
				<input style="display: none;" name="foto" id="file-input" type="file"/>

					
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-offset-2 col-md-7">
				<input class="btn btn-block" type="submit" name="" value="Registrar">
			</div>
		</div>
	</form>	
		<hr>
		<div class="row">
			<div class="col-md-12">
				@if (count($productos)>0)
					<center><label>Productos</label></center>
				
			
				<table class="table table-responsive">
					 <tr class="fondo-color-blue" >
					 	<th><label>Id</label></th>
					    <th><label>Foto</label></th>
					    <th><label>Nombre</label></th> 
					    <th><label>Descripcion</label></th>
					    <th><label>creado</label></th>
					    <th><label>Opción</label></th>
					  </tr>
					@foreach ($productos as $p)

					<tr>
						<td><label>{{ $p->idProducto }}</label></td>
						<td><img src="{{ '/'.$p->foto }}" class="sizeLogo" alt="foto de {{ $p->nombre }}"></td>
						<td><label>{{ $p->nombre }}</label></td>
						<td><label>{{ $p->descripcion }}</label></td>
						<td><label>{{ date('h:i:s - d-m-Y', strtotime($p->creado)) }}</label></td>
						<td>
							<a class="btn btn-primary btn-xs" href="{{ url("userDependiente/detalleProducto/".base64_encode($p->idProducto)) }}">Ver..</a>
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