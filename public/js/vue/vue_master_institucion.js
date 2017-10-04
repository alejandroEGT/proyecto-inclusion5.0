
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
				

				if (confirm("¿Quieres aceptar este vendedor?") == true) {
				    

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
        eliminarProducto($id){
			if (confirm("¿Quieres eliminar este producto?") == true) {
				    
						$('#eliminar').submit();

				} 
				else {
				    alert("Operación cancelada!");
				}
		}
		,
		eliminarAlumno(){
				if (confirm("¿Quieres eliminar este producto?") == true) {
				    
						$('#form_eliminarAlumno').submit();

				} 
				else {
				    alert("Operación cancelada!");
				}
		}
		,
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
		this.traerEncargado();
		this.traerMision();
		this.traerVision();
	}
})




