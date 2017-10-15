@extends('encargadoArea.master_encargadoArea')


@section('content')
<form action="{{ url('encargadoArea/publicarServicio') }}" method="post" enctype="multipart/form-data" >
		<div class="row">
			<div class="col-md-offset-2 col-md-2">
			<a href="{{ url('institucion/inicio') }} "><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
				<div class="ico-servicio"></div>
			</div>
			<div class="col-md-6">
				<p class="panel-title-agregar-mv"><label>¿Que estas ofreciendo?</label></p>
				<p class="panel-body-mst"><label>
					En este formulario puedes publicar servicios que ofresca la institución.</label>
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
				@if (count($servicios)>0)
					<center><label>Servicios</label></center>
				
			
				<table class="table table-responsive">
					 <tr class="head-color" >
					 	<th>Id</th>
					    <th>Foto</th>
					    <th>Nombre</th> 
					    <th>Descripcion</th>
					    <th>Opción</th>
					  </tr>
					@foreach ($servicios as $s)

					<tr>
						<td>{{ $s->id }}</td>
						<td><img src="{{ '/'.$s->foto }}" height="70" width="90"></td>
						<td>{{ $s->nombre }}</td>
						<td>{{ $s->descripcion }}</td>
						
						<td>
							<form id="form_eliminarAlumno" action="{{ url('institucion/eliminar_alumno') }}" method="post" >
												{{csrf_field()}}
												<a class="btn btn-primary btn-xs" href="{{ url("institucion/verDetalleAlumno/".base64_encode($s->id)) }}">Ver..</a>

												<input type="hidden" name="id_servicio" value="{{ $s->id }}" >
												<input  type="button" value="Eliminar" class="btn btn-danger btn-xs" name="">
											</form>
						</td>
					</tr>
				    
				     
				    @endforeach
					  
				</table>
				<center>{{ $servicios->links() }}</center>
				@endif
				@if (count($servicios)<=0)
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
