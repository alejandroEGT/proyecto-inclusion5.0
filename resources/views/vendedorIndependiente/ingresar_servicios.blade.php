@extends('vendedorIndependiente.master_vendedorIndependiente')

@section('content')

<form action="{{ url('userIndependiente/publicarServicio') }}" method="post" enctype="multipart/form-data" >
		<div class="row">
			<div class="col-md-offset-2 col-md-2">
			<a href="{{ url('userIndependiente/inicio') }} "><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
				<div class="ico-servicio"></div>
			</div>
			<div class="col-md-6">
				<p class="panel-title-agregar-mv"><label>¿Que estas ofreciendo?</label></p>
				<p class="panel-body-mst"><label>
					En este formulario puedes publicar servicios.</label>
				</p>
				<div class="row">
					<div class="col-md-10">
						<input type="" class="form-control input" maxlength="50" placeholder="Ingrese nombre del servicio" name="nombre">
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
				<p><input type="text" placeholder="Descripción del servicio..." maxlength="250" class="form-control input" name="descripcion"></p>
			</div>
		
			<div class="col-md-2">
				<p><select name="categoria" class="form-control input" >
					<option value="" >Seleccione categoría..</option>
					@foreach ($categoria_serv as $categoria)
						<option value="{{$categoria->id }}">{{$categoria->nombre }}</option>
					@endforeach
					
				</select></p>
			</div>
			<div class="col-md-2">
				
				<p><label for="file-input" class="label-foto-link">
				 	<img src="/ico/image.png" for="file-input" class="label-foto-link">
				 	Agregar foto..
				</label></p>
				<input style="display: none;" name="fotoP1" id="file-input" type="file"/>
			</div>
			
			
		</div>
		<hr>
		<div class="row">
		{{ csrf_field() }}
			
			
			<div class="col-md-12">
				<center><input class="btn" type="submit" name="" value="Registrar"></center>
			</div>
			
		</div>
		
	</form>

	<hr>
		<div class="row">
			<div class="col-md-12">
				@if (count($servicio)>0)
					<center><label>Servicio</label></center>
				
			
				<table class="table table-responsive">
					 <tr class="head-color" >
					 	<th>Id</th>
					    <th>Foto</th>
					    <th>Nombre</th> 
					    <th>Descripcion</th>
					    <th>creado</th>
					    <th>Opción</th>
					  </tr>
					@foreach ($servicio as $s)

					<tr>
						<td>{{ $s->idServicio }}</td>
						<td><img src="{{ '/'.$s->foto }}" height="70" width="90"></td>
						<td>{{ $s->nombreServicio }}</td>
						<td>{{ $s->descripcion }}</td>
						<td>{{ $s->creado }}</td>			
						<td>
							<a class="btn btn-primary btn-xs" href="{{ url('userIndependiente/detalleServicio/'.base64_encode($s->idServicio)) }}">Ver..</a>
							<input type="button" @click="eliminarServicio({!! $s->idServicio  !!})" class="btn btn-warning btn-xs" value="Eliminar"/>
						</td>
					</tr>
				    
				     
				    @endforeach
					  
				</table>
				<center>{{ $servicio->links() }}</center>
				@endif
				@if (count($servicio)<=0)
					<center><label>No hay servicios</label></center>
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