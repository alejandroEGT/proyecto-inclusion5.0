new Vue({
	el:'#master-encargado',
	data:{
		
		fotoPerfil :'',
		nombre:'',
		estadoPassword:'',
		
	},
	 http: { 
            root: 'http://localhost:8000/',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
    },
	methods:{
		
		traerFoto(){
				this.$http.get('/foto-encargado').then(function(response){

					this.fotoPerfil = response.body;
					console.log(response.body);
				})
		},
		traerNombre(){
				this.$http.get('/traerNombre').then(function(response){

					this.nombre = response.body;
					console.log(response.body);
				})
		}
		,
		estadoClave(){
			  this.$http.get('/estadoClaveEncargado').then(function(response){

					this.estadoPassword = response.body;
					console.log(response.body);
				})
		},
		eliminarProducto($this){
			if (confirm("¿Quieres eliminar este producto?") == true) {
				    
				    
						this.$http.get('encargadoArea/eliminar_producto_institucion/'+$this).then(function(response){
								
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
		eliminarProductoEspera($this){
			if (confirm("¿Quieres cancelar este producto?") == true) {
				    
				    
						this.$http.get('/eliminar_producto_espera/'+$this).then(function(response){
								
								console.log(response.body);
								alert("producto cancelado");
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
				    
						this.$http.get('encargadoArea/eliminar_servicio_institucion/'+$this).then(function(response){
								
								console.log(response.body);
								alert("servicio eliminado");
								//this.notificar();
								location.reload();
						})

				} 
				else {
				    alert("Operación cancelada!");
				}
		},
		eliminarServicioEspera($this){
			if (confirm("¿Quieres cancelar este servicio?") == true) {
				    
						this.$http.get('/eliminar_servicio_espera/'+$this).then(function(response){
								
								console.log(response.body);
								alert("servicio cancelado");
								//this.notificar();
								location.reload();
						})

				} 
				else {
				    alert("Operación cancelada!");
				}
		}
		,
		eliminarAlumno($id_alumno){//reparar este codigo//////////////////////////////////////////////
				if (confirm("¿Quieres eliminar este alumno?") == true) {
				    	
				    	//alert($id_alugetmno);
						//$('#form_eliminarAlumno').submit();
						this.$http.get('/eliminar_alumno/'+$id_alumno).then(function(response){
								
								console.log(response.body);
								alert("Alumno eliminado");
								//this.notificar();
								location.reload();
						})

				} 
				else {
				    alert("Operación cancelada!");
				}
		}
		,
		
	},

	created (){
		this.traerFoto();
		this.traerNombre();
		this.estadoClave();
	}
})