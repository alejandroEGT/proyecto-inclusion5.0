new Vue({
	el:'#master-vendedorDependiente',
	data:{
		
		fotoPerfil :'',
		estadoPassword:''
		
	},
	 http: { 
            root: 'https://exod.cl/',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
    },
	methods:{
		
		traerFoto(){
				this.$http.get('/foto-vendedorIns').then(function(response){

					this.fotoPerfil = response.body;
					console.log(response.body);
				})
		}
		,
		estadoClave(){
			  this.$http.get('/estadoClaveAlumno').then(function(response){

					this.estadoPassword = response.body;
					console.log(response.body);
				})
		},
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
		
	},

	created (){
		this.traerFoto();
		this.estadoClave();
	}
})