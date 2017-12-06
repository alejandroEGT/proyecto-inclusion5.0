@extends('vendedorIndependiente.master_vendedorIndependiente')

@section('content')
	<div class="body-buscar">
				
			@if ($vendedor)
				<div class="padre-agregar">
				<br><br><br><br>
				<p><label class="lbl_titulo" >Personas <i class="fa fa-users" aria-hidden="true"></i></label></p>
				<hr>
					<div class="row">	
						<div class="centro1 col-md-offset-1 col-md-8 panel">
							@foreach ($vendedor as $v)
								<div class="row">
									<div class="col-md-3">
										<img src="{{'/'.$v->foto}}" class="foto-buscar img-thumbnail"> 
									</div>
									<div class="col-md-6">
										<p><label><strong>{{ $v->nombre}}</strong></label></p>
										<p>{{ $v->email }}</p>
										<p>{{ $v->rol }}</p>
									</div>
									<div class="col-md-2">
										<input type="button" class="btn"  value="Ver perfil" name="">
									</div>
								</div>
								<hr>
							@endforeach
						</div>
					</div>
				</div>

			@elseif ($institucion)
				<div class="padre-agregar">
				<br><br><br><br>
				<p><label class="lbl_titulo" >Instituciones <i class="fa fa-university" aria-hidden="true"></i></label></p>
				<hr>
					<div class="row">
						<div class="centro1 col-md-offset-2 col-md-7 panel">
							@foreach ($institucion as $i)
								<div class="row">
									<div class="col-md-3">
										<img src="{{'/'.$i->logo}}" class="foto-buscar img-thumbnail"> 
									</div>
									<div class="col-md-6">
										<p><label><strong>{{ $i->nombre}}</strong></label></p>
										<p>{{ $i->razonSocial }}</p>
										<p>{{ $i->email }}</p>
										<p>{{ $i->direccion }}</p>
									</div>
									<div class="col-md-2">
										<input type="button" class="btn"  value="Ver perfil" name="">
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