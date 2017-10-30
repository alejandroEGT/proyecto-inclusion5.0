<div class="row">
	<div class="col-md-12 well">
		<center>
			<p><label><h3 class="th3">Noticias Generales</h3> <img src="/ico/news.png" height="40"></label></p>
		</center>
		<div class="row">
			@if (count($noticias_generales))
				@foreach ($noticias_generales as $ng)
					<div class="col-md-offset-1 col-md-10  fondo-blanco top">
						<div class="row">
							<div class="col-md-4">
								<p><img src="{{'/'.$ng->logoInstitucion}}" class="img-thumbnail img-circle img-logo_noticia " > <label><small class="color-blue" >{{$ng->nombreInstitucion.' ('.date('h:i:s - d/m/Y',strtotime($ng->creado)).')'}}</small></label></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-offset-1 col-md-10">
								<center><label><h4 style="color:black;" >{{ $ng->titulo }}</h4></label></center>
								<hr>
							</div>
						</div>
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<p><label>{{ $ng->texto }}</label></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-offset-1 col-md-10">
								<center><img src="{{ '/'.$ng->foto }}" class="img-thumbnail foto-noticia"></center>
							</div>
						</div>
						<hr>
					</div>

				@endforeach
			@endif
		</div>
	</div>
	<center>{{ $noticias_generales->links() }}</center>
</div>