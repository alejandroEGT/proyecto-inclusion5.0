var app = new Vue({
  el: '#master_invitado',
  data: {
  		
	    formCliente:{
	    	rut:"", nombre:"", razonSocial:"", telefono1:"", telefono2:"", direccion:"", logo:"", correo:"", clave:""
	    },
      id_area:[],
      navChrome:false,
      nombreNav:'',
	    
	},
    http: { 
            root: 'https://exod.cl/',
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
		  },
      navegador(){
        var agente = window.navigator.userAgent;
        var navegadores = ["Chrome", "Firefox", "Safari", "Opera", "Trident", "MSIE", "Edge"];
        for(var i in navegadores){
            if(agente.indexOf( navegadores[i]) != -1 ){
                return navegadores[i];
            }
        }
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
      ,
      clickLupa(){
               
                $("a, p, h1, h2, h3, h4, h5, input").toggleClass('zoom');
      }
      
    },
    created(){
      if(artyom.recognizingSupported()){
       this.navChrome = true;
      }
    	
      this.browsermobil();
    }
  
})