@extends('institucion.master_institucion')

@section('content')
	<div class="body-buscar">
				
			@if ($vendedor)
				<div class="padre-agregar">
				<br><br>
				<p><label class="lbl_titulo" >Personas <i class="fa fa-users" aria-hidden="true"></i></label></p>
				<hr>
					<div class="row">	
						<div class="centro1 col-md-offset-2 col-md-7 panel">
							@foreach ($vendedor as $v)
								<div class="row">
									<div class="col-md-3">
										<img src="{{'/'.$v->foto}}" class="foto-buscar img-thumbnail"> 
									</div>
									<div class="col-md-6 borde-left">
										<p><label><strong class="nombrecss" >{{ $v->nombre}}</strong></label></p>
										<p><label class="correocss" >{{ $v->email }}</label></p>
										<p><label class="rolcss">{{ $v->rol }}</label></p>
									</div>
									<div class="col-md-2">
									@if ($v->idrol == 1)
										<a href="{{ url("institucion/perfil_ven/".base64_encode($v->iduser)."") }}" class="btn btn-default">Ver perfil 1</a>
									@endif
									@if ($v->idrol == 2)
										<a href="{{ url("institucion/perfil_venInst/".base64_encode($v->iduser)."") }}" class="btn btn-default">Ver perfil 2</a>
									@endif
										
									</div>
								</div>
								<hr>
							@endforeach
						</div>
					</div>
				</div>

			@elseif ($institucion)
				<div class="padre-agregar">
				<br><br>
				<p><label class="lbl_titulo" >Instituciones <i class="fa fa-university" aria-hidden="true"></i></label></p>
				<hr>
					<div class="row">
						<div class="centro1 col-md-offset-2 col-md-7 panel">
							@foreach ($institucion as $i)
								<div class="row">
									<div class="col-md-3">
										<img src="{{'/'.$i->logo}}" class="foto-buscar img-thumbnail"> 
									</div>
									<div class="col-md-6 borde-left ">
										<p><label><strong>{{ $i->nombre}}</strong></label></p>
										<p>{{ $i->razonSocial }}</p>
										<p>{{ $i->email }}</p>
										<p>{{ $i->direccion }}</p>
									</div>
									<div class="col-md-2">
										<a class="btn btn-default">Ver perfil</a>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			@else	
				<div class="padre-agregar">
					<center><p class="p-nothing" >nada para mostrar</p></center>
				</div>
			@endif
		

	</div>

@endsection