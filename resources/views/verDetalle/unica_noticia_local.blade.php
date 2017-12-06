<div class="row">
	@if (Session::has('correcto'))
								<center><div class="row">
									
										<div class="alert alert-info">
										    <a href="" class="close" data-dismiss="alert">&times;</a>
										     {{ Session::get('correcto') }}
										</div>
									
								</div>	</center>
								
							@endif
	<div class="col-md-12 well">
		<center>
			<p><label><h3 class="th3">Noticia Local</h3> <img src="/ico/news.png" height="40"></label></p>
		</center>
		<div class="row">						
			<div class="col-md-offset-2 col-md-8 fondo-blanco top">
				
					<div class="row">
						<div class="col-md-offset-1 col-md-10 well">
							<img src="{{ '/'.$noticia->foto }}" class="img-thumbnail" >
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<center>
								<label>{{ $noticia->titulo }}</label> <a data-toggle="collapse" data-target="#titulo{{$noticia->id}}" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
								<p><label><small>{{ $noticia->nombreEstado }} <a data-toggle="collapse" data-target="#estado{{$noticia->id}}" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a></small></label></p>
							</center>
							<div id="estado{{$noticia->id}}" class="collapse">
									<div class="alert alert-info" role="alert">
										<form action="{{ url($ruta.'/actualizar_estado_noticia') }}" method="post">
										{{csrf_field()}}
									  		<p><strong>Actualizar Estado</strong> </p>
									  		<input type="hidden" name="noticia" value="{{$noticia->id}}">
									  		<p>
									  			<select name="estado">
									  				@foreach ($estado_noticia as $en)
									  					<option value="{{ $en->id }}">{{ $en->nombre }}</option>
									  				@endforeach
									  			</select>
											<input class="btn btn-primary btn-xs" type="submit" value="Guardar"></p>	
										</form>	
									</div>
							</div>	
							<div id="titulo{{$noticia->id}}" class="collapse">
									<div class="alert alert-info" role="alert">
										<form action="{{ url($ruta.'/actualizar_titulo_noticia') }}" method="post">
										{{csrf_field()}}
									  		<p><strong>Actualizar Título</strong> </p>
									  		<input type="hidden" name="noticia" value="{{$noticia->id}}">
									  		<p><input class="" type="text" maxlength="150" name="titulo">
											<input class="btn btn-primary btn-xs" type="submit" value="Guardar"></p>	
										</form>	
									</div>
							</div>	
							<p><label>{{$noticia->texto}}</label> <a data-toggle="collapse" data-target="#texto{{$noticia->id}}" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a></p>	
							<div id="texto{{$noticia->id}}" class="collapse">
									<div class="alert alert-info" role="alert">
										<form action="{{ url($ruta.'/actualizar_texto_noticia') }}" method="post">
										{{csrf_field()}}
									  		<p><strong>Actualizar Texto</strong> </p>
									  		<input type="hidden" name="noticia" value="{{$noticia->id}}">
									  		<p><textarea class="form-control" maxlength="3500" name="texto"></textarea><br>
											<input class="btn btn-primary btn-xs" type="submit" value="Guardar"></p>	
										</form>	
									</div>
							</div>			
						</div>
					</div>
			</div>
		</div>
	</div>		
</div>