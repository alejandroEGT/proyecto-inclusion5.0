@extends('institucion.master_institucion')

@section('content')
<label id="v_area" hidden="true" >{{ $area->id }}</label>
	<div class="container ">
		<div class="row panel">
			<div class="col-md-offset-1 col-md-4">
			<a href="#" onclick="window.history.back();">
				<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
			</a>
				<p style="text-align: center" class="panel-title-agregar-mv"><label>{{ $area->nombre}}</label>
				<a data-toggle="collapse" data-target="#campo1" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
				<div id="campo1" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_nombreArea') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Nombre del Área</strong></label> </p>
							  		<input type="hidden" name="idArea" value="{{ $area->id  }}" >
							  		<p><input class="" type="text" name="nombreDeArea" placeholder="Nombre de área o especialidad">
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
				</div>
				</p>
				<p style="text-align: center" class="panel-body-mst"><label>{{ $area->descripcion }}</label>
				<a data-toggle="collapse" data-target="#campo2"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>
				<div id="campo2" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_descripcionArea') }}" method="post">
								{{csrf_field()}}
							  		<p><label><strong>Actualizar Descripcion del área</strong></label> </p>
							  		<input type="hidden" name="idArea" value="{{ $area->id }}" >
							  		<p>
							  		<TEXTAREA placeholder="Descripción" rows="4" cols="30" name="descripcion" ></TEXTAREA><br>
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
				</div>
				</p>
				<hr>
				@if ($area->logo != "")
					<center>
						<img class="img-logo" src="{{ '/'.$area->logo }}" alt="Logo">
						<a data-toggle="collapse" data-target="#logo"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>
					</center>
					<div id="logo" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_logo_area') }}" method="post" enctype="multipart/form-data" >
									{{csrf_field()}}
							  		<p><label><strong>Actualizar Logo del área</strong></label> </p>
							  		<input type="hidden" name="idArea" value="{{ $area->id }}" >
							  		<p>
							  		<input placeholder="un logo" type="file" name="logo"><br>
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
				</div>
				@endif
				@if ($area->logo == "")
					<center><label>(No hay un logo..) </label> <a data-toggle="collapse" data-target="#logosin"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a></center>

					<div id="logosin" class="collapse">
							<div class="alert alert-info" role="alert">
								<form action="{{ url('institucion/actualizar_logo_area') }}" method="post" enctype="multipart/form-data" >
									{{csrf_field()}}
							  		<p><label><strong>Actualizar Logo del área</strong></label> </p>
							  		<input type="hidden" name="idArea" value="{{ $area->id }}" >
							  		<p>
							  		<input type="file" name="logo"><br>
									<input class="btn btn-primary btn-xs" type="submit" value="Guardar" name=""></p>	
								</form>	
							</div>
				</div>

				@endif
			</div>
			<div class="col-md-6">
			<p><label>Agregar encargado</label></p>
			<small><label>Al registrar un encargado la contraseña temporal se le enviará a su correo, Una vez añadido un encargado podrás visualizar las actividades de esta área</label></small>
			<hr>
			@if (count($errors))
			<div class="row alert alert-danger">
					<div class="col-md-offset-1 col-md-10">
						<a href="" class="close" data-dismiss="alert">&times;</a>
							@foreach ($errors->all() as $error)
								<ul>
									<li class="validacionRequest"><label>{{ $error }}</label></li>
								</ul>
							@endforeach
					</div>				
			</div>
			@endif
			@if (Session::has('ingreso'))
								<a href="" class="close" data-dismiss="alert">&times;</a>
								<div class="alert alert-info"><label>{{ Session::get('ingreso') }}</label></div>
			@endif
				<form action="{{ url('institucion/agregarUsuario') }}" method="post"  >
					<div class="row">
						<div class="col-md-6">
							{{ csrf_field() }}
							<input name="area" type="hidden" value="{{ $area->id }}">
							<label>Nombres</label>
							<input placeholder="Nombre" type="text" name="nombres" class="form-control" value="{{ old('nombres') }}" >
							<label>Apellidos</label>
							<input placeholder="Apellido" type="text" name="apellidos" class="form-control " value="{{ old('apellidos') }}" >
							<label>Correo</label>
							<input placeholder="Correo electrónico" name="correo" type="email"  class="form-control " value="{{ old('correo') }}">
						</div>
						<div class="col-md-6">
							<label>Nª Teléfono</label>
							<input placeholder="Número telefónico" type="numeric" name="telefono" class="form-control" value="{{ old('telefono') }}">
							<p class="p-form"><label>Sexo</label></p>
							<select name="id_sexo"  class="form-control input" name="" id="">
								<option value="">Seleccione...</option>
								@foreach ($sexo as $sex)
									<option value="{{$sex->id}}">{{ $sex->nombre }}</option>
								@endforeach
							</select>
							<br clear="brcss" >
							<input class="btn btn-block btn-success top-btn" type="submit" value="registrar">
						</div>
					</div>
				</form>	
			</div>
		</div>	

		<div class="row panel">
			<div class="col-md-1">
				<button data-toggle="collapse" data-target="#demo" class="btn btn-info btn-xs ">Personas ({{ $contarP }})</button>
			</div>
			<div class="col-md-1">
				<button data-toggle="collapse" data-target="#demo2" class="btn btn-danger btn-xs">Productos ({{ $contarProd }})</button>
			</div>
			{{--<div class="col-md-1">
				<button data-toggle="collapse" data-target="#demo3" class="btn btn-success btn-xs badge1" data-badge="{{$contarS}}">Servicio</button>
			</div>--}}
			<div class="col-md-offset-1 col-md-5 ">
				<div v-if="this.existeEncargado == true">
					<p><label>Encargado(a):</label>@{{ bd_encargadoNombre }} <button @click="eliminarEncargado(bd_encargadoId)" class="btn btn-primary btn-xs">Eliminar</button>
					<a data-toggle="collapse" data-target="#ver"> | <i class="fa fa-eye" aria-hidden="true"></i></a>
					<br>
					<div id="ver" class="collapse">
							<div class="alert alert-success" role="alert">
									<p><strong>Correo: </strong>
									@{{ bd_encargadoCorreo }}
									</p>
							  		<p><strong>Estado de contraseña: </strong>
							  		@{{ bd_encargadoClaveEstado }}	</p>
								
							</div>
				    </div>
				</div>
				<div v-if="this.existeEncargado == false">
					<p><label>No existe encargado(a)</label> 
				</div>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="demo" class="collapse">
						@if (!is_null($venInstitucion))
							<a class="btn btn-success btn-sm" href="{{ url('institucion/descargarpdf_alumnos/'.$id_area) }}"> Exportar alumnos a PDF</a>
							<table class="table table-responsive">
								<tr class="tr-estilo">
									<td><label>Foto</label></td>
									<td><label>Nombre</label></td>
									<td><label>Correo</label></td>
									<td><label>Estado contraseña</label></td>
									<td><label>Opciones</label></td>
								</tr>							
								@foreach ($venInstitucion as $ven)
									<tr>
										<td><img class="sizeLogoMin" src="{{'/'.$ven->foto}}" alt="$ven->nombres"></td>
										<td><label>{{$ven->nombres.' '.$ven->apellidos}}</label></td>
										<td><label>{{$ven->email}}</label></td>
										<td><label>{{$ven->nombre}}</label></td>
										<td>
											<form>
												{{csrf_field()}}
												<a class="btn btn-primary btn-xs" href="{{ url("institucion/verDetalleAlumno/".base64_encode($ven->id)) }}">Ver..</a>

												<input type="hidden" name="id_alumno" value="{{ $ven->id }}" >
												<input @click="eliminarAlumno({{ $ven->id }})" type="button" value="Eliminar" class="btn btn-danger btn-xs" name="">
											</form>
										</td>
									</tr>
								@endforeach
							</table>

						@endif
						@if (is_null($venInstitucion))
							<p><label>no existen registros de usuarios..</label></p>
						@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="demo2" class="collapse">
						@if (!is_null($productos))
							<div class="row">
								<div class="col-md-3">
									<a href="{{ url('institucion/descargarpdf_productos/'.$id_area) }}" class="btn btn-success btn-sm" >Exportar productos a PDF</a>
								</div>
							</div>
							<table class="table table-responsive">
								<tr class="tr-estilo">
									<td><label>Foto</label></td>
									<td><label>Nombre</label></td>
									<td><label>Descripción</label></td>
									<td><label>cantidad</label></td>
									<td><label>Opciones</label></td>
								</tr>							
								@foreach ($productos as $p)
									<tr>
										<td><img class="sizeLogoMin" src="{{'/'.$p->foto}}" alt="{{ $p->nombre }}"></td>
										<td><label>{{$p->nombre}}</label></td>
										<td><label>{{$p->descripcion}}</label></td>
										<td><label>{{$p->cantidad}}</label></td>
										<td>
											<form>
												{{csrf_field()}}
												<a class="btn btn-primary btn-xs" href="{{ url("institucion/detalleProducto/".base64_encode($p->id_producto)) }}">Ver..</a>

												<input type="hidden" name="id_alumno" value="{{ $p->id_producto }}" >
												<input @click="eliminarProducto({{ $p->id_producto }})" type="button" value="Eliminar" class="btn btn-danger btn-xs" name="">
											</form>
										</td>
									</tr>
								@endforeach
							</table>

						@endif
						@if (is_null($productos))
							<p><label>no existen productos en el área</label></p>
						@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="demo3" class="collapse">
						
						@if (count($servicios)>0)
							
							<table class="table table-responsive">
								<tr class="tr-estilo">
									<td><label>Foto</label></td>
									<td><label>Nombre</label></td>
									<td><label>Descripción</label></td>
									<td><label>Opciones</label></td>
								</tr>							
								@foreach ($servicios as $s)
									<tr>
										<td><img class="sizeLogoMin" src="{{'/'.$s->foto}}" alt="{{ $s->nombre }}"></td>
										<td><label>{{$s->nombre}}</label></td>
										<td><label>{{$s->descripcion}}</label></td>
										<td>
											<form>
												{{csrf_field()}}
												<a class="btn btn-primary btn-xs" href="{{ url("institucion/detalleServicio/".base64_encode($s->id_servicio)) }}">Ver..</a>

												<input type="hidden" name="id_alumno" value="{{ $s->id_servicio }}" >
												<input @click="eliminarServicio({{ $s->id_servicio }})" type="button" value="Eliminar" class="btn btn-danger btn-xs" name="">
											</form>
										</td>
									</tr>
								@endforeach
							</table>

						@endif
						@if (!count($servicios))
							<p>no existen servicios en el área</p>
						@endif
				</div>
			</div>
		</div>
	</div>
@endsection