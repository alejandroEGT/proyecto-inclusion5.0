
new Vue({
	el:'#master',
	data:{
		db_institucion:[],
		db_area:[],
		inserarArea:{
		  nombre:"", desc:""
		}, 
		notificacion:'',
		notificacion_prod:'',
		notificacion_serv:'',
		bd_mv:{
			mision:'', vision:''
		},
		getMision:[],
		getVision:[],
		bd_encargadoNombre:'',
		bd_encargadoCorreo:'',
		bd_encargadoId:'',
		bd_encargadoClaveEstado:'',
		existeEncargado : false,
  		txtBuscar:'',
        users: [],
         navChrome:false,
        nombreNav:'',
		
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
						this.db_area = [{ nombre:"no existen areas..", id:0 }]
					}else{
						this.db_area = response.body;
						console.log(response.body);

					}
				})
		},
		aceptarSolicitud($val){
				

				if (confirm("¿Quieres aceptar este alumno?") == true) {
				    

						this.$http.post('/aceptarSolicitudUsuario', $val).then(function(response){
								
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
				
								console.log(response.body);
								this.traerMision();
								
						},
							(error) =>{
								console.log(error);
							}
						)
						.catch((e) => {
					        console.log("Caught", e);
					      }
					    )
		},
		guardar_vision(){

						this.$http.post('/agregar_vision', this.bd_mv ).then(function(response){
								
								console.log(response.body);
								this.traerVision();
						},
							(error) =>{
								console.log(error);
							}
						)
						.catch((e) => {
					        console.log("Caught", e);
					      }
					    )
		},
		traerMision(){
						this.$http.get('/traer_mision').then(function(response){
								this.getMision = response.body;
								console.log(response.body);
								
						},
							(error) =>{
								console.log(error);
							}
						)
						.catch((e) => {
					        console.log("Caught", e);
					      }
					    )
		},
		traerVision(){
						this.$http.get('/traer_vision' ).then(function(response){
								this.getVision = response.body;
								console.log(response.body);
						},
							(error) =>{
								console.log(error);
							}
						)
						.catch((e) => {
					        console.log("Caught", e);
					      }
					    )

		},
		traerEncargado(){

						this.$http.post('/traerEncargado', $('#v_area').text() ).then(function(response){
								
								console.log('consola '+response.body);
								this.bd_encargadoId = response.body[0];
								this.bd_encargadoNombre = response.body[1];
								this.bd_encargadoClaveEstado = response.body[2];
								this.bd_encargadoCorreo = response.body[3];
								this.existeEncargado = true;
								
								
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
		notificar_producto(){
			this.$http.get('/traerNotificaciones_prod').then(function(response){

					console.log(response.body);
					this.notificacion_prod = response.body;

				})
		},
		notificar_servicio(){
			this.$http.get('/traerNotificaciones_serv').then(function(response){

					console.log(response.body);
					this.notificacion_serv = response.body;

				})
		},
		eliminarEncargado($id){
			if (confirm("¿Quieres eliminar este encargado?") == true) {
				    
						this.$http.get('/eliminarEncargado/'+$id).then(function(response){
								
								console.log(response.body);
								alert("Encargado eliminado");
								//this.notificar();
								location.reload();
						})

				} 
				else {
				    alert("Operación cancelada!");
				}
		}
		,
		isEmptyJSON(obj) {
			for(var i in obj) { return false; }
					return true;
		},
		buscarUsuario(){
            url="";
	        if(this.txtBuscar == "") url="user/";
	        else url="institucion/buscarUsuarioParaCambiarPassword/"+this.txtBuscar;
	        
	        this.$http.get(url).then(function(response){
	                this.users = response.body;   
	                console.log(response.body);
	          })
      
        },
        generarClave($id){

        	if (confirm("¿Quieres genera una nueva contraseña para este usuario?") == true) {
				    

						this.$http.get('/generarClave/'+$id).then(function(response){
								
								console.log(response.body);
								alert(response.body);
								//this.notificar();
								//location.reload();
						})

				} 
				else {
				    alert("Operación cancelada!");
				}
        },
		eliminarProducto($this){
			if (confirm("¿Quieres eliminar este producto?") == true) {
				    
				    
						this.$http.get('institucion/eliminar_producto_institucion/'+$this).then(function(response){
								
								console.log(response.body);
								alert("producto eliminado");
								//this.notificar();
								location.reload();
						})

				} 
				else {
				    alert("Operación cancelada!");
				}
		}
		,
		eliminarServicio($this){
			if (confirm("¿Quieres eliminar este servicio?") == true) {
				    
						this.$http.get('institucion/eliminar_servicio_institucion/'+$this).then(function(response){
								
								console.log(response.body);
								alert("servicio eliminado");
								//this.notificar();
								location.reload();
						})

				} 
				else {
				    alert("Operación cancelada!");
				}
		}
		,
		eliminarAlumno($this){//reparar este codigo//////////////////////////////////////////////
				if (confirm("¿Quieres eliminar este alumno?") == true) {
				    
						$('#form_eliminarAlumno').submit();

				} 
				else {
				    alert("Operación cancelada!");
				}
		}
		,
		aceptarProducto($id){
				if (confirm("¿Quieres Aceptar este producto?") == true) {
				    
						this.$http.post('/aceptarSolicitudProducto', $id).then(function(response){
								
								console.log(response.body);
								alert("Producto aceptado");
								this.notificar_producto()
								location.reload();
						})

				} 
				else {
				    alert("Operación cancelada!");
				}
		},
		aceptarServicio($id){
			if (confirm("¿Quieres Aceptar este servicio?") == true) {
				    
						this.$http.post('/aceptarSolicitudServicio', $id).then(function(response){
								
								console.log(response.body);
								alert("Servicio aceptado");
								this.notificar_servicio();
								location.reload();
						})

				} 
				else {
				    alert("Operación cancelada!");
				}
		},
		cambiarGrafico(){
			//alert($('#tipo').val());
			$('#tipo_form').submit();
		},
		browsermobil(){
          // android
        var ua = navigator.userAgent.toLowerCase();
        var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
        if(isAndroid) {
          // Do something!
          // Redirect to Android-site?
          this.nombreNav="Navegando en android";
            //window.location = 'http://android.davidwalsh.name';
        }

        // ipad
        // For use within normal web clients 
        var isiPad = navigator.userAgent.match(/iPad/i) != null;

        // For use within iPad developer UIWebView
        // Thanks to Andrew Hedges!
        var ua = navigator.userAgent;
        var isiPad = /iPad/i.test(ua) || /iPhone OS 3_1_2/i.test(ua) || /iPhone OS 3_2_2/i.test(ua);

        // iphone/ipod
        if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
           if (document.cookie.indexOf("iphone_redirect=false") == -1) this.nombreNav="Navegando en iphone";
        }
      }
	},

	created (){
		if(artyom.recognizingSupported()){
           this.navChrome = true;
        }
    	
      	this.browsermobil();
		this.datosInstituto();
		this.llenarTablaArea();
		this.notificar();
		this.notificar_producto();
		this.notificar_servicio();
		this.traerEncargado();
		this.traerMision();
		this.traerVision();
	}
})




