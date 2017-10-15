<div class="row">
			<div class="col-md-offset-1 col-md-2">
				<div class="ico-news"></div>
			</div>
			<div class="col-md-5">
				<p class="panel-title-agregar-mv"><label>¿Tienes algo para contar en la comunidad?</label></p>
				<p class="panel-body-mst"><label>
					En este formulario de manera opcional puedes publicar noticias respecto a las actividades internas y externas de la institución.</label>
				</p>
			</div>
			<div class="col-md-2">
				<div id="divFoto" hidden="true" >
						<div id="img_destino" class="porte img-thumbnail" ></div>
				</div>
			</div>
		</div>
		@if (count($errors))
				<div class="row">
					<div class="col-md-offset-2 col-md-7">
						<div class="alert alert-danger">
						    <a href="" class="close" data-dismiss="alert">&times;</a>
						    @foreach ($errors->all() as $e)
								<ul>
									<li>{{ $e }}</li>
								</ul>
							@endforeach
						</div>
					</div>
				</div>	
			@endif

			@if (Session::has('correcto'))
								<div class="row">
									<div class="col-md-offset-2 col-md-7">
										<div class="alert alert-info">
										    <a href="" class="close" data-dismiss="alert">&times;</a>
										     {{ Session::get('correcto') }}
										</div>
									</div>
								</div>	
								
							@endif
		<hr>
		<form action="{{ url($ruta.'/publicarNoticia') }}" method="POST" enctype="multipart/form-data" >
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-offset-1 col-md-3">
					<p><label>Titulo</label></p>
					<input type="text" name="titulo" class="form-control">
				</div>
				<div class="col-md-2">
					<p><label>Tipo de noticia</label></p>
					<select name="estado" class="form-control" >
						@foreach ($estado_noticia as $es)
							<option value="{{ $es->id }}" >{{ $es->nombre }}</option>
						@endforeach
					</select>
				</div>
			
			</div>
			<br>
			<div class="row">
				<div class="col-md-offset-1 col-md-3">
					<p><label>Texto</label></p>
					<textarea name="texto" class="form-control" ></textarea>
				</div>
				<div class="col-md-2">
					<br><br>
					<p><label for="file-input" class="label-foto-link">
				 	<img src="/ico/image.png" for="file-input" class="label-foto-link">
				 	Agregar foto..
					</label></p>
					<input style="display: none;" name="foto" id="file-input" type="file"/>
				</div>
			</div>
			<hr>
			<div class="row">
				
				<div class="col-md-offset-1 col-md-2">
					<input type="submit" name="" value="Registrar" class="btn btn-success">
				</div>
			</div>

		</form>