var app = new Vue({
  el: '#master_invitado',
  data: {
  		
	    formCliente:{
	    	rut:"", nombre:"", razonSocial:"", telefono1:"", telefono2:"", direccion:"", logo:"", correo:"", clave:""
	    },
      id_area:[]
	    
	},
    http: { 
            root: 'http://localhost:8000/',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
    },
    methods: {
    	filtraArea(e){
        this.$http.get('/filtrarArea/'+e.target.value).then(function(response){
              console.log(response.body);
              this.id_area = response.body;
        })
      },
			insertar(e) {
			e.preventDefault();
           this.$http.post('/guardarInstitucion', this.formCliente).then(function(response){
	      			console.log(response.body);

	      			alert("guardado con exito!");
	      			
	  			})
		}
    },
    created(){
    	
    }
  
})