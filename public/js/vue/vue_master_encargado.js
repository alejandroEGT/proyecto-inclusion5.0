new Vue({
	el:'#master-encargado',
	data:{
		
		fotoPerfil :'',
		nombre:'',
		
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
		
	},

	created (){
		this.traerFoto();
		this.traerNombre();
	}
})