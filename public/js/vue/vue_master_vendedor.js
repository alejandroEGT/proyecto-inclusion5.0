new Vue({
	el:'#vendedor',
	data:{

	}
	,
	 http: { 
            root: 'http://localhost:8000/',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
    },
    methods:{
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
    }
})