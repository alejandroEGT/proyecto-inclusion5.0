new Vue({
	el:'#master-vendedorIndependiente',
	data:{
		
		fotoPerfil :''
		
	},
	 http: { 
            root: 'https://exod.cl/',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
    },
	methods:
	{
				
		traerFoto()
		{
				this.$http.get('/foto-vendedor').then(function(response){

					this.fotoPerfil = response.body;
					console.log(response.body);
				})
		},
		eliminarProducto($this)
		{
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
	
		
		},

		eliminarServicio($this){
				if (confirm("¿Quieres eliminar este servicio?") == true) {
					    
					    
							this.$http.get('userIndependiente/eliminar_servicio_vendedor/'+$this).then(function(response){
									
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
		
	},

	created (){
		this.traerFoto();
	}
})