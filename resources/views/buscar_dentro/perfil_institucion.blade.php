<div class=" well color-sky">
		<div class="row">
			<div class="col-md-offset-1 col-md-3">
				<center><img src="{{ '/'.$institucion->logo }}" class="img img-thumbnail tamanio-inst" ></center>
			</div>
			<div class="col-md-3">
				<p><strong class="nombreblue" ><i class="fa fa-user" aria-hidden="true"></i> {{$institucion->nombre}}</strong></p>
				<p><strong class="correo" ><i class="fa fa-envelope" aria-hidden="true"></i> {{$institucion->email}}</strong></p>
				<p><strong class="numero" ><label><i class="fa fa-phone" aria-hidden="true"></i> {{ $institucion->telefono1 }}</label></strong></p>
				<p><strong class="numero" ><label><i class="fa fa-phone" aria-hidden="true"></i> {{ $institucion->telefono2 }}</label></strong></p>

				@if (!empty($institucion->sitioWeb))
					<p><strong class="numero" ><label><i class="fa fa-globe" aria-hidden="true"></i> <a href="{{ url($institucion->sitioWeb) }}">{{ $institucion->sitioWeb }}</a></label></strong></p>
				@endif
			</div>
			<div class="col-md-4">
				@if (!empty($institucion->mision))
					<p><strong><label>Misión</label></strong></p>
					<p>{{ $institucion->mision }}</p>
				@endif
				@if (!empty($institucion->vision))
					<p><strong><label>Visión</label></strong></p>
					<p>{{ $institucion->vision }}</p>
				@endif
			</div>
		</div>
	
	</div>