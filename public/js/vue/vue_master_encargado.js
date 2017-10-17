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
		}
		,
		
	},

	created (){
		this.traerFoto();
		this.traerNombre();
		this.estadoClave();
	}
})