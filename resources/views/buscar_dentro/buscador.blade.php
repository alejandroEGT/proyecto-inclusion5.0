<div class="body-buscar">
	<br>
				<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
			@if ($vendedor)

				<div class="">

				<p><label class="lbl_titulo" >Personas <i class="fa fa-users" aria-hidden="true"></i></label></p>
				<hr>
					<div class="row">	
						<div class="centro1 col-md-offset-2 col-md-7 panel">
							@foreach ($vendedor as $v)
								<div class="row">
									<div class="col-md-3">
										<img src="{{'/'.$v->foto}}" alt="foto de {{ $v->nombre }}" class="foto-buscar img-responsive img-circle"> 
									</div>
									<div class="col-md-6 borde-left">
										<p><label><strong class="nombrecss" >{{ $v->nombre}}</strong></label></p>
										<p><label class="correocss" >{{ $v->email }}</label></p>
										<p><label class="rolcss">{{ $v->rol }}</label></p>
									</div>
									<div class="col-md-2">
									@if ($v->idrol == 1)
										<a href="{{ url($ruta."/perfil_ven/".base64_encode($v->iduser)."") }}" class="btn btn-success">Ver perfil </a>
									@endif
									@if ($v->idrol == 2)
										<a href="{{ url($ruta."/perfil_venInst/".base64_encode($v->iduser)."") }}" class="btn btn-primary">Ver perfil </a>
									@endif
										
									</div>
								</div>
								<hr>
							@endforeach
						</div>
					</div>
				</div>

			@elseif ($institucion)
				<div class="">
				<br><br>
				<p><label class="lbl_titulo" >Instituciones <i class="fa fa-university" aria-hidden="true"></i></label></p>
				<hr>
					<div class="row">
						<div class="centro1 col-md-offset-1 col-md-10 panel">
							@foreach ($institucion as $i)
								<div class="row">
									<div class="col-md-3">
										<img src="{{'/'.$i->logo}}" alt="foto de {{ $i->nombre }}" class="foto-buscar img-responsive img-thumbnail"> 
									</div>
									<div class="col-md-6 borde-left ">
										<p><label><strong>{{ $i->nombre}}</strong></label></p>
										<p><label>{{ $i->razonSocial }}</label></p>
										<p><label>{{ $i->email }}</label></p>
										<p><label>{{ $i->direccion }}</label></p>
									</div>
									<div class="col-md-2">
										<a href="{{ url($ruta."/perfil_institucion/".base64_encode($i->id)."") }}" class="btn btn-primary">Ver perfil</a>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			@else	
				<div class="">
					<center>
						<p class="p-nothing" >nada para mostrar</p>
						<img src="/ico/sad.png">
					</center>
				</div>
			@endif
		
	</div>