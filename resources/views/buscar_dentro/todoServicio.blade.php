<div class="col-md-offset-2 col-md-8  fondo-blanco">
	<a href="#" onclick="window.history.back();">
		<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i>
	</a>
	@if (count($servicios)>0)
					<div class="row">
						<div class="col-md-12">
							<center>
								<label>Servicios</label> <i class="fa fa-star-o" aria-hidden="true"></i>
							</center>

							<form action="{{ url($ruta.'/filtrarServicio') }}" method="GET"> 
								  <div class="row">
								    <div class="col-md-12">
								      <div class="input-group">
								      	{{ csrf_field() }}
								   <input type="text" class="form-control" placeholder="Buscar servicios" name="buscar"/>
								   <div class="input-group-btn">
								        <button class="btn btn-primary" type="submit">
								        <span class="glyphicon glyphicon-search"></span>
								        </button>
								   </div>
								   </div>
								    </div>
								  </div>
						</form>	
							<hr>
							
							@foreach ($servicios as $servicio)
							<div class="box-producto">
								<center>
									@if ($user != 1 && $user != 2)
										<p><label class="decirContador verde" style="color:#229954" >Diga {{ $contador++ }}</label></p>
									@endif
									<img src="{{ '/'.$servicio->foto }}" class="img-thumbnail img-prod ">
									<p>{{ str_limit($servicio->nombre, 10) }}</p>
									<p><a id="{{$servicio->id }}" href="{{ url($ruta.'/detalleServicio/'.base64_encode($servicio->id)) }}" class="btn btn-primary btn-xs">Ver</a>
									@if ($user == 1 || $user == 2)
									
									<input type="button" @click="eliminarServicio({!! $servicio->id !!});"  class="btn btn-danger btn-xs" value="Eliminar" >
									@endif
									</p>
								</center>

							</div>	
							@endforeach
							<!--<center>{{-- $productos->links() --}}</center>-->
							
						</div>

					</div>

				@endif
				@if (!count($servicios))
					<center><label for="">No Existen Servicios para mostrar</label></center>
				@endif


				<script src="{{asset('js/artyom.js')}}" ></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
				<script type="text/javascript">

					
					var cont = 0;
					var array = {!! json_encode($servicios) !!}; 
					var cantidadServicios = [];


					for(var i =1; i <= array.data.length; i++){

						cantidadServicios[i] = '"'+i+'"';
					}
					
					simuArray = '['+Object.values(cantidadServicios)+']';
				

					var comandos = {

					    indexes: JSON.parse(simuArray) , // Decir alguna de estas palabras activara el comando
					   

					    action:function(i){ // Acción a ejecutar cuando alguna palabra de los indices es reconocida
					        
					        

					        	for(var s =0; s <= array.data.length; s++){
					        		if(s == i){
					        			//alert(array.data[i].id);
					        			document.getElementById(array.data[i].id).click();
					        		}
					        	}
					        	//alert(array.data[0].idProducto);
					        	//alert(i);
					        	//alert(array.data[i].idProducto);
					        	
					        	//setTimeout(function () { window.location = "inicio"; }, 0);
				
					        
					        
					    }
					};

					artyom.addCommands(comandos); // Agregar comando
				</script>
</div>