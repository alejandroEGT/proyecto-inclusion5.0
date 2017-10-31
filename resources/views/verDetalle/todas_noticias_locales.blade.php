
<div class="row">
	<div class="col-md-12 well">		
		<center>
			<p><label><h3 class="th3">Noticias Generales</h3> <img src="/ico/news.png" height="40"></label></p>
		</center>

		<div class="row">
			@if (Session::has('correcto'))
										<center><div class="row">
											
												<div class="alert alert-info">
												    <a href="" class="close" data-dismiss="alert">&times;</a>
												     {{ Session::get('correcto') }}
												</div>
											
										</div>	</center>
										
									@endif
			
				
				@foreach ($noticias_locales as $nl)
			<div class="col-md-offset-2 col-md-8 fondo-blanco top">
					<div class="row">
						<div class="col-md-offset-1 col-md-10">
							<img src="{{ '/'.$nl->foto }}" class="img-thumbnail" >
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<center>
								<label>{{ $nl->titulo }}</label> 
								@if($user == 1 || $user == 2) 
								<a data-toggle="collapse" data-target="#titulo{{$nl->id}}" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
								@endif
								<p><label><small>{{ $nl->nombreEstado }} 
									@if($user == 1 || $user == 2) 
										<a data-toggle="collapse" data-target="#estado{{$nl->id}}" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a> 
									@endif 
								</small></label>
								</p>
							</center>
							@if($user == 1 || $user == 2) 
							<div id="estado{{$nl->id}}" class="collapse">
									<div class="alert alert-info" role="alert">
										<form action="{{ url($ruta.'/actualizar_estado_noticia') }}" method="post">
										{{csrf_field()}}
									  		<p><strong>Actualizar Estado</strong> </p>
									  		<input type="hidden" name="noticia" value="{{$nl->id}}">
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
							@endif
							@if($user == 1 || $user == 2) 
							<div id="titulo{{$nl->id}}" class="collapse">
									<div class="alert alert-info" role="alert">
										<form action="{{ url($ruta.'/actualizar_titulo_noticia') }}" method="post">
										{{csrf_field()}}
									  		<p><strong>Actualizar Título</strong> </p>
									  		<input type="hidden" name="noticia" value="{{$nl->id}}">
									  		<p><input class="" type="text" maxlength="150" name="titulo">
											<input class="btn btn-primary btn-xs" type="submit" value="Guardar"></p>	
										</form>	
									</div>
							</div>	
							@endif
							<p><label>{{$nl->texto}}</label> 
								@if($user == 1 || $user == 2) 
								<a data-toggle="collapse" data-target="#texto{{$nl->id}}" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
								@endif
							</p>
							@if($user == 1 || $user == 2) 	
							<div id="texto{{$nl->id}}" class="collapse">
									<div class="alert alert-info" role="alert">
										<form action="{{ url($ruta.'/actualizar_texto_noticia') }}" method="post">
										{{csrf_field()}}
									  		<p><strong>Actualizar Texto</strong> </p>
									  		<input type="hidden" name="noticia" value="{{$nl->id}}">
									  		<p><textarea class="form-control" maxlength="3500" name="texto"></textarea><br>
											<input class="btn btn-primary btn-xs" type="submit" value="Guardar"></p>	
										</form>	
									</div>
							</div>	
							@endif		
						</div>
					</div>
				</div>	
				@endforeach

				<center>{{ $noticias_locales->links() }}</center>
			

		</div>
	</div>
</div>		