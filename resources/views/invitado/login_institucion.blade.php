@extends('invitado.master_invitado')

@section('content')
		<div class="padding color-verde">
			<div class="row">
					<div class="col-md-offset-3 col-md-6">
					<h3>Login de Institución</h3>
					<h4>Bienvenido a nuestro proyecto</h4>
					<div class="ico-institution"></div>
					</div>
			</div>
		</div>
		<div class="container">
			<form action="/login_institucion" method="post">
				<div class="padding container animated fadeInUp">
						<div class="row">
							<div class="col-md-offset-4 col-md-4">
								{{ csrf_field() }}
								<label for="">Correo</label>
								<input class="form-control input " type="text" name="correo" >
								<label for="">Clave</label>
								<input class="form-control input" type="password" name="clave">
							</div>
						</div>
						<div class="row top">
							<div class="col-md-offset-4 col-md-4">
								<input class="btn btn-info input-btn" type="submit" value="Iniciar">
							</div>
						</div>
				</div>		
			</form>
		</div>			
		
			
@endsection











	






