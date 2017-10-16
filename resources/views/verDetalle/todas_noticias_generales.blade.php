<div class="row">
	<div class="col-md-12 well">
		<div class="row">
			@if (count($noticias_generales))
				@foreach ($noticias_generales as $ng)
					<div class="col-md-offset-1 col-md-10  fondo-blanco top">
						<div class="row">
							<div class="col-md-4">
								<p><img src="{{'/'.$ng->logoInstitucion}}" class="img-thumbnail img-circle img-logo_noticia " > <label><small class="color-blue" >{{$ng->nombreInstitucion.' ('.$ng->creado.')'}}</small></label></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-offset-1 col-md-10">
								<p><label>{{ $ng->texto }}</label></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-offset-1 col-md-10">
								<img src="{{ '/'.$ng->foto }}" class="img-thumbnail foto-noticia">
							</div>
						</div>
						<hr>
					</div>

				@endforeach
			@endif
		</div>
	</div>
</div>