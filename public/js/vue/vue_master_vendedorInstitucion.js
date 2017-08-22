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
				this.$http.get('/foto-vendedorIns').then(function(response){

					this.fotoPerfil = response.body;
					console.log(response.body);
				})
		}
		
	},

	created (){
		this.traerFoto();
	}
})