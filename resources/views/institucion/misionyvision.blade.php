@extends('institucion.master_institucion')

@section('content')
	<div class="padre-agregar">
		<div class="row">
			<div class="col-md-offset-2 col-md-2">
				<div class="ico-mundo"></div>
			</div>
			<div class="col-md-6">
				<p class="panel-title-agregar-mv"><label>¿Cual es la misión y visión de la institución?</label></p>
				<p class="panel-body-mst"><label>
					En este formulario de manera opcional puedes definir la misión y visión de la institución, se le informa que esta información es publica.</label>
				</p>
			</div>
		</div>

			<div class="row">
				<div class="col-md-offset-2 col-md-4">
					<form method="post" @submit.prevent="guardar_mision" >
							<center><p><label>Misión</label></p></center>
							<textarea v-model="bd_mv.mision" name="mision" class="form-control input" cols="13" rows="6">
							</textarea>
							<input class="btn btn-success input-btn" type="submit" value="Registrar">
					</form>		
				</div>
				<div class="col-md-4">
					<form method="post" @submit.prevent="guardar_vision" >
							<center><p><label>Visión</label></p></center>
							<textarea v-model="bd_mv.vision" name="vision" class="form-control input" cols="13" rows="6">
							</textarea>
							<input class="btn btn-success input-btn" type="submit" value="Registrar">
					</form>		
				</div>
			</div>
	</div>
@endsection