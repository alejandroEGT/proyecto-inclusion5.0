new Vue({
	el:'#master-vendedorIndependiente',
	data:{
		
		fotoPerfil :''
		
	},
	 http: { 
            root: 'http://localhost:8000/',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
    },
	methods:{
		
		traerFoto(){
				this.$http.get('/foto-vendedor').then(function(response){

					this.fotoPerfil = response.body;
					console.log(response.body);
				})
		},
		eliminarProducto($this){
			if (confirm("¿Quieres eliminar este producto?") == true) {
				    
				    
						this.$http.get('userIndependiente/eliminar_producto_vendedor/'+$this).then(function(response){
								
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
		
	},

	created (){
		this.traerFoto();
	}
})