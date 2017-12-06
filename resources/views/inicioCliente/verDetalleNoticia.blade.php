@extends('inicioCliente.clienteMaster')
@section('content')


<div class="container">
	<div class="row">
	<div class="col-md-12 well">
		<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
		<center>
			<p><label><h3 class="th3">Noticia General</h3> <img src="/ico/news.png" height="40"></label></p>
		</center>
		<div class="row">
			
					<div class="col-md-offset-1 col-md-12  linea-gris fondo-blanco top">
						<div class="row">
							<div class="col-md-4"><br>
								<p><img src="{{'/'.$noticia->logoInstitucion}}" class="img-thumbnail img-circle img-logo_noticia " > <label><small class="color-blue" >{{$noticia->nombreInstitucion.' ('.$noticia->creado.')'}}</small></label></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-offset-1 col-md-10">
								<center><label class="lbl-titulo" >{{ $noticia->titulo }}</label></center>
							</div>
						</div><hr>
						<div class="row">
							<div class="col-md-offset-1 col-md-10">
								<p><label>{{ $noticia->texto }}</label></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-offset-1 col-md-10">
								<center><img src="{{ '/'.$noticia->foto }}" class="img-thumbnail foto-noticia"></center>
							</div>
						</div>
						<br><hr>
					</div>

		</div>
	</div>
</div>

</div>
@endsection