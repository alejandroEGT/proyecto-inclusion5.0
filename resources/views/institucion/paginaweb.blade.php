@extends('institucion.master_institucion')
@section('content')
		<div class="row">
			<div class="col-md-offset-3 col-md-5">
				<div class="papelImagen">
			<div class="cabeza">
									
				<div class="ico-internet"></div>
				<a href="{{ URL::previous() }} "><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a>
			</div>

		<div class="subir">
					<form action="{{ url('institucion/ingresar_pagweb') }}" method="post" enctype='multipart/form-data' >
					    		{{ csrf_field() }}
					    	
								
					@if (count($errors))
						<div class="row">
							<div class="col-md-offset-3 col-md-6">
								<div class="alert alert-danger">
								    <a href="" class="close" data-dismiss="alert">&times;</a>
								    @foreach ($errors->all() as $e)
										<ul>
											<li>{{$e}}</li>
										</ul>
									@endforeach
								</div>
							</div>
						</div>	
					@endif
					@if (Session::has('web'))
						<div class="alert alert-info">{{ Session::get('web') }}</div>
					@endif
					
				    	<label>Ingresa sitio web oficial <small>(Ej: www.ejemplo.com)</small></label>
						<p><input class="mi-input" type="text" name="paginaWeb" placeholder="Sitio Web"></p>
						

				   		 <input type="submit" name="" value="guardar" class="btn btn-primary" >
						 <br>
					</form>
			    </div>
		</div>
			</div>
		</div>
@endsection