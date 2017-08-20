new Vue({
	el:'#master',
	data:{
		db_institucion:[],
		db_area:[],
		inserarArea:{
		  nombre:"", desc:""
		}, 
		notificacion:'',
		bd_mv:{
			mision:'', vision:''
		},
		bd_encargado:'',
		
	},
	 http: { 
            root: 'http://localhost:8000/',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
    },
	methods:{
		datosInstituto(){
				this.$http.get('/traerDatosInstitucion').then(function(response){
	      			console.log(response.body);
	      			this.db_institucion = response.body;
	      			//alert("guardado con exito!");
	      			
	  			})
		},
		formArea(){
			
			this.$http.post('/insertarDatosAreas', this.inserarArea ).then(function(response){

	      			console.log(response.body);
	      			this.db_area = response.body;
	      			this.inserarArea.nombre = "";
	      			this.inserarArea.desc = "";
	      			this.llenarTablaArea();
	  			})
		},
		llenarTablaArea(){
				this.$http.get('/mostrarAreas').then(function(response){

					if(this.isEmptyJSON(response.body)){
						this.db_area = [{ nombre:"no existen areas.." }]
					}else{
						this.db_area = response.body;
						console.log(response.body);

					}
				})
		},
		aceptarSolicitud($val){
				

				if (confirm("¿Quieres aceptar este vendedor?") == true) {
				    

						this.$http.post('/aceptarSolicitudUsuario', $val).then(function(response){
								//$('div#contenidoAjax').html('<p><img src="https://s-media-cache-ak0.pinimg.com/originals/0c/44/da/0c44dacf1b038014a6f941131c5e8aa2.gif" /></p>');
								console.log(response.body);
								this.notificar();
								location.reload();
						})

				} 
				else {
				    alert("Operación cancelada!");
				}

		}
		,
		guardar_mision(){

						this.$http.post('/agregar_mision', this.bd_mv ).then(function(response){
								//$('div#contenidoAjax').html('<p><img src="https://s-media-cache-ak0.pinimg.com/originals/0c/44/da/0c44dacf1b038014a6f941131c5e8aa2.gif" /></p>');
								console.log(response.body);
								//this.notificar();
								//location.reload();
						},
							(error) =>{
								alert(error);
							}
						)
						.catch((e) => {
					        console.log("Caught", e);
					      }
					    )
		},
		guardar_vision(){

						this.$http.post('/agregar_vision', this.bd_mv ).then(function(response){
								//$('div#contenidoAjax').html('<p><img src="https://s-media-cache-ak0.pinimg.com/originals/0c/44/da/0c44dacf1b038014a6f941131c5e8aa2.gif" /></p>');
								console.log(response.body);
								//this.notificar();
								//location.reload();
						},
							(error) =>{
								alert(error);
							}
						)
						.catch((e) => {
					        console.log("Caught", e);
					      }
					    )
		},
		traerEncargado(){

						this.$http.post('/tarerEncargado', $('#v_area').text() ).then(function(response){
								
								console.log(response.body);
								this.bd_encargado = response.body;
								//this.traerEncargado();
								
						},
							(error) =>{
								this.bd_encargado = "No existe encargado(a).";
							}
						)
						.catch((e) => {
					        alert("excepcion errores", e);
					      }
					    )
		},
		
		notificar(){
				
				this.$http.get('/traerNotificaciones').then(function(response){

					console.log(response.body);
					this.notificacion = response.body;

				})
		},
		isEmptyJSON(obj) {
			for(var i in obj) { return false; }
					return true;
		}
	},

	created (){
		this.datosInstituto();
		this.llenarTablaArea();
		this.notificar();
		this.traerEncargado();
		
	}
})