<br>
<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
<center><label class="titulodearea" >Área o especialidad de la institución {{ $institucion->nombre }}</label></center>

<div class="row">
	<div class="col-md-offset-1 col-md-3">
			<div class="row">
				<div class="col-md-12 well blanco">
					@if ($area->logo != null)
					<center>
						<img src="{{'/'.$area->logo}}" class="img-logo">
						<br><br>
						<p><label>{{ $area->nombre }}</label></p>
					</center>			
				
					@endif
					@if ($area->logo == null)
						<center><label>(No existe logo)</label>
						<br><br>
						<p><label>{{ $area->nombre }}</label></p>
						</center>
					@endif
					<hr>
					<center>
						<label><p>{{ $area->descripcion }}</p></label>
					</center>
				</div>
			</div>
			@if (!empty($encargado))
			<div class="row">
				<div class="col-md-12 well blanco">
					<label>Encargado(a):</label><hr>
					<div class="row">
						<div class="col-md-4">
							<img src="{{'/'.$encargado->foto}}" class="sizeLogo img-circle"> 
						</div>
						<div class="col-md-8">
							<label class="letra-pequenia">{{$encargado->nombres.' '.$encargado->apellidos}}</label>
						</div>
					</div>
				</div>
			</div>
			@endif
			@if (empty($encargado))
				<div class="row">
					<div class="col-md-12 well blanco">
						<label>No existe encargado(a)..</label>
					</div>
				</div>
			@endif
			@if (count($alumnos)>0)

				<div class="row">
					<div class="col-md-12 well blanco">
						<label>Alumnos:</label>
						<hr>
						@foreach ($alumnos as $a)
							<a href="{{ url($ruta.'/perfil_venInst/'.base64_encode($a->id_user)) }}" ><img src="{{'/'.$a->foto}}" class="sizeFP "> </a>
						@endforeach
					</div>
				</div>
			@endif

	</div>
	<div class="col-md-7">
		<div class="row">
			<div class="col-md-12  well blanco">
					<p><img src="{{ '/'.$institucion->logo }}" class="sizeLogoMin" ></p>
					<p><label><strong>Institución: </strong> {{$institucion->nombre}} </label></p>
					<hr>
					<p><label><strong>Razón social: </strong> {{$institucion->razonSocial}} </label></p>
			</div>
		</div>
	</div>
</div>