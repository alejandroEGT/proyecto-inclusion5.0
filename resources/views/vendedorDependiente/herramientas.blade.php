@extends('vendedorDependiente.master_vendedorDependiente')
@section('content')

	<div class="">
			<div class="row">
				<div class="col-md-12">
					<center>
						<h3 style="color:black"><label>Queremos adaptarnos a ti</label></h3>
						<h4 style="color:black"><label>Nuestro proyecto busca diferenciarse y adaptarse a tu manera de navegar por un sitio web, lo cual te mostramos algunas novedades que podras utilizar.</label></h4>
						<img src="/ico/usersHelp.png" alt="">
					</center>
				</div>
			</div>
		
	</div>
			<div class="row">
				<div class="col-md-offset-2 col-md-8 blanco">
					<div class="row">
						<div class="col-md-2 top">
							<img src="/ico/ear.png" height="70" alt="icono">
						</div>
						<div class="col-md-9">
						<h5 class="h-blue" >Dictador de texto y elementos</h5>
						<h5>Herramienta que permite escuchar el texto plano de la pagina y de las funciones que puedes hacer como usuario, utilizado en caso que no tengas demaciada vision.</h5>
						<!--<label class="onoffbtn"><input type="checkbox"></label>-->
						
						</div>
					</div>
				</div>
			</div>
			<div class="row top">
				<div class="col-md-offset-2 col-md-8 blanco">
					<div class="row">
						<div class="col-md-2 top">
							<img src="/ico/micro.png" height="70" alt="icono">
						</div>
						<div class="col-md-9">
						<h5 class="h-blue" >Acción de voz (por comandos)</h5>
						<h5>Herramienta que permite realizar algunas acciones en el sitio, como lo que puede ser el redireccionamiento de las paginas, sin la necesidad de utilizar el mouse de tu equipo.</h5>
						<!--<label class="onoffbtn"><input type="checkbox"></label>-->
						<br>
						<center><a href="{{ url('userDependiente/descargar_comando') }}" class="btn btn-success btn-sm" >Descargar comandos en PDF </a></center>
						</div>
					</div>
				</div>
			</div>
			<div class="row top">
				<div class="col-md-offset-2 col-md-8 blanco">
					<div class="row">
						<div class="col-md-2 top">
							<img src="https://clipartion.com/wp-content/uploads/2015/10/blind-eyes-clipart-free-clip-art-images.png" height="40" alt=" icono">
						</div>
						<div class="col-md-9">
						<h5 class="h-blue" >Adaptador de texto o fondo</h5>
						<h5>Herramienta que permite adaptarse a un modo mas oscuro del sitio web, activando la opción superior o activando una convinación de teclas.</h5>
						<!--<label class="onoffbtn"><input type="checkbox"></label>-->
						</div>
					</div>
				</div>
			</div>
<br><br>

@endsection