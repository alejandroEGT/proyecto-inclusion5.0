@extends('vendedorIndependiente.master_vendedorIndependiente')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">

				<div class="col-md-offset-2 col-md-7">
					<img src="{{'/'.$foto}}" height="100" width="110" ><br>
					<a href="/userIndependiente/cambiarFoto"><label>Actualizar foto de perfil</label></a>

				<hr>
					<label><strong>Nombres </strong></label><small> {{Auth::user()->nombres}}</small>
					<button data-toggle="collapse" data-target="#nombre" class="btn btn-xs btn-success" >Editar</button>

					<div id="nombre" class="collapse">
						<div class="alert alert-info" role="alert">
							<form action="" method="">
							 {{csrf_field()}}
						  		<p><strong>Actualizar Nombres</strong> </p>
						  		<p><input class="" type="" name="nombre">
								<input type="submit" value="Guardar" name=""></p>	
							</form>	
						</div>							
					</div>
				<hr>
					<label><strong>Apellidos </strong></label><small> {{Auth::user()->apellidos}}</small>
					<button data-toggle="collapse" data-target="#rs" class="btn btn-xs btn-success" >Editar</button>

					<div id="rs" class="collapse">
						<div class="alert alert-info" role="alert">
							<form action="" method="">
							{{csrf_field()}}
						  		<p><strong>Actualizar Apellidos</strong> </p>
						  		<p><input class="" type="" name="apellido">
								<input type="submit" value="Guardar" name=""></p>	
							</form>	
						</div>														
					</div>
				<hr>


				<label><strong>N° Teléfono </strong></label><small>133</small>
					<button data-toggle="collapse" data-target="#telefono" class="btn btn-xs btn-success" >Editar</button>

					<div id="telefono" class="collapse">
						<div class="alert alert-info" role="alert">
							<form action="" method="">
							{{csrf_field()}}
						  		<p><strong>Actualizar Teléfono</strong> </p>
						  		<p><input class="" type="" name="telefono">
								<input type="submit" value="Guardar" name=""></p>	
							</form>	
						</div>														
					</div>
				<hr>

				<label><strong>Fecha de nacimiento </strong></label><small>1 de noviembre</small>
					<button data-toggle="collapse" data-target="#fNacimiento" class="btn btn-xs btn-success" >Editar</button>

					<div id="fNacimiento" class="collapse">
						<div class="alert alert-info" role="alert">
							<form action="" method="">
							{{csrf_field()}}
						  		<p><strong>Actualizar fecha de nacimiento</strong> </p>
						  		<p><input class="" type="" name="fNacimiento">
								<input type="submit" value="Guardar" name=""></p>	
							</form>	
						</div>														
					</div>
				<hr>

				<label><strong>Correo </strong></label><small> {{Auth::user()->email}}</small>
				<button data-toggle="collapse" data-target="#correo" class="btn btn-xs btn-success" >Editar</button>

					<div id="correo" class="collapse">
						<div class="alert alert-info" role="alert">
							<form action="" method="">
							{{csrf_field()}}
						  		<p><strong>Actualizar Correo</strong> </p>
						  		<p><input class="" type="" name="correo">
								<input type="submit" value="Guardar" name=""></p>	
							</form>	
						</div>
					</div>					
				<hr>

				<label><strong>Contraseña </strong></label><small> (No visible) </small>
				<button data-toggle="collapse" data-target="#clave" class="btn btn-xs btn-success" >Editar</button>

					<div id="clave" class="collapse">
						<div class="alert alert-info" role="alert">
							<form action="" method="">
							{{ csrf_field() }}
						  		<p><strong>Actualizar Contraseña</strong> </p>
						  		<p><small>Contraseña actual </small><input class="" type="password" name="clave_actual">
						  		<p><small>Contraseña Nueva </small><input class="" type="password" name="clave_nueva">
						  		<p><small>Repetir Contraseña Nueva </small><input class="" type="password" name="confirm_clave_nueva">
								<input type="submit" value="Guardar" name=""></p>	
							</form>	
						</div>
					</div>
				<hr>


			</div>
		</div>
	</div>
</div>
@endsection