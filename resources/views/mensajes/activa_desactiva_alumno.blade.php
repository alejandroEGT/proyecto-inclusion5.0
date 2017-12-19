		<script src="{{asset('js/jquery.easing.min.js')}}"></script> 
         <script src="{{asset('js/jquery.scrollTo.js')}}"></script>
         <script src="{{asset('js/wow.min.js')}}"></script>
        <script src="{{ asset('js/artyomCommands.js') }}" ></script>
         

<script>

	$(".decirContador").hide();
	var scrolldelay;
	var fun_p= function(){}
	var fun_h= function(){}
	var fun_img= function(){}
	var fun_inputBtn = function(){}
	var fun_inputTxt = function(){}
	var fun_a = function(){}
	/*zom*/


	var dictar = function(e){
		hablar( $(e).text() );
	}

	function estaPulsadoShift(event){
		if (event.shiftKey==1)
			//alert("esta ok");
		    $("a, h1, button, h2, h3, h4, h5, input, label, select, img").addClass('zoom');
		else
			//alert("no ok");
		    $("a, h1, button, h2, h3, h4, h5, input, label, select, img").removeClass('zoom');
	}


	@if (Session::has('activarMicro'))		 
		iniciar(); 
		$(".decirContador").show();
	      //alert("holii teni pololi");                	   
	@endif
	@if (Session::has('activarText'))

					fun_p = function(e){
						dictar(e);
					}
					fun_h = function(e){
						dictar(e);
					}	
					fun_a = function(e){
						hablar('ir a '+$(e).text());
					}	
					fun_inputTxt = function(e){
				  		hablar( $(e).attr("placeholder") );
					}
					fun_inputBtn = function(e){

				  					hablar("Botón "+ $(event.target).val());
					}

					$( "label, h3" ).mouseover(function(event) {
				  				//var p = $(this).text();
				  					hablar($(event.target).text());
							 	//hablar($(event.target).text());
							});
	                $( "label, h3" ).mouseout(function(event) {
				  				//var p = $(this).text();
				  					callar();
							 	//hablar($(event.target).text());
					});



	                $( "a" ).mouseover(function(event) {
				  				//var p = $(this).text();
				  					hablar('botón '+$(event.target).text());
							 	//hablar($(event.target).text());
							});
	                $( "a" ).mouseout(function(event) {
				  				//var p = $(this).text();
				  					callar();
							 	//hablar($(event.target).text());
					});
	                 $( "select" ).mouseover(function(event) {
				  					texto = $(event.target).text();
				  					hablar(texto);
							 	//hablar($(event.target).text());
					});
	                 $( "select" ).mouseout(function(event) {
				  					callar();
							 	//hablar($(event.target).text());
					});
							
							$( "button" ).mouseover(function(event) {
									var ph = $(this).text();
				  					hablar("Botón "+ph);
							 	//hablar($(event.target).text());
							});
							$( "button" ).mouseout(function(event) {
									callar();
							 	//hablar($(event.target).text());
							});
							$( "input[type='text'], input[type='password'], input[type='file'], input[type='numeric']" ).mouseover(function(event) {
									var ph = $(this).attr("placeholder");
				  					hablar("ingrese aqui "+ph);
							 	//hablar($(event.target).text());
							});
							$( "input[type='text'], input[type='password'], input[type='file'], input[type='numeric']" ).mouseout(function(event) {
									callar();
							 	//hablar($(event.target).text());
							});
							$( "input[type='button'], input[type='submit']" ).mouseover(function(event) {
									var ph = $(this).attr("value");
				  					hablar("Botón para "+ph);
							 	//hablar($(event.target).text());
							});
							$( "input[type='button'], input[type='submit']" ).mouseout(function(event) {
									callar();
							 	//hablar($(event.target).text());
							});
							$( "textarea" ).mouseover(function(event) {
									var ph = $(this).attr("placeholder");
				  					hablar("ingrese aqui "+ph);
							 	//hablar($(event.target).text());
							});
							$( "textarea" ).mouseout(function(event) {
									callar();
							 	//hablar($(event.target).text());
							});
							

							$( "img" ).mouseover(function(event) {

				  				var alt = $(this).attr("alt");
				  				hablar(alt);
							});
							$( "img" ).mouseout(function(event) {

				  				callar();
							});
	@endif

	@if ( Session::has('flash_activadomicro') )
	 			 
					hablar("comando de voz activado");
	 			 	//$.notify("", "info");
	 			 	Command: toastr["success"]("{{ Session::get('flash_activadomicro') }}")

					toastr.options = {
					  "closeButton": true,
					  "debug": true,
					  "newestOnTop": false,
					  "progressBar": true,
					  "positionClass": "toast-top-right",
					  "preventDuplicates": true,
					  "showDuration": "300",
					  "hideDuration": "1500",
					  "timeOut": "5000",
					  "extendedTimeOut": "1000",
					  "showEasing": "swing",
					  "hideEasing": "linear",
					  "showMethod": "fadeIn",
					  "hideMethod": "fadeOut"
					}
	 			
	  				
	@endif

	@if (Session::has('flash_desactivadomicro'))
				
				hablar("desactivando comando de voz");
						
						setInterval(function(){ location.reload(); }, 2000);
					Command: toastr["error"]("{{ Session::get('flash_desactivadomicro')}}")

					toastr.options = {
					  "closeButton": true,
					  "debug": true,
					  "newestOnTop": false,
					  "progressBar": true,
					  "positionClass": "toast-top-right",
					  "preventDuplicates": true,
					  "showDuration": "300",
					  "hideDuration": "1500",
					  "timeOut": "5000",
					  "extendedTimeOut": "1000",
					  "showEasing": "swing",
					  "hideEasing": "linear",
					  "showMethod": "fadeIn",
					  "hideMethod": "fadeOut"
					}
				
	@endif


	@if ( Session::has('flash_activadotext') )
	 			
	 			 	hablar("dictador de texto activado");
	 			 	Command: toastr["success"]("{{ Session::get('flash_activadotext') }}")

					toastr.options = {
					  "closeButton": true,
					  "debug": true,
					  "newestOnTop": false,
					  "progressBar": true,
					  "positionClass": "toast-top-right",
					  "preventDuplicates": true,
					  "showDuration": "300",
					  "hideDuration": "1500",
					  "timeOut": "5000",
					  "extendedTimeOut": "1000",
					  "showEasing": "swing",
					  "hideEasing": "linear",
					  "showMethod": "fadeIn",
					  "hideMethod": "fadeOut"
					}
	 		
	  				
	@endif

	@if (Session::has('flash_desactivadotext'))

				hablar("dictador de texto desactivado");
					Command: toastr["error"]("{{ Session::get('flash_desactivadotext')}}")

					toastr.options = {
					  "closeButton": true,
					  "debug": true,
					  "newestOnTop": false,
					  "progressBar": true,
					  "positionClass": "toast-top-right",
					  "preventDuplicates": true,
					  "showDuration": "300",
					  "hideDuration": "1500",
					  "timeOut": "5000",
					  "extendedTimeOut": "1000",
					  "showEasing": "swing",
					  "hideEasing": "linear",
					  "showMethod": "fadeIn",
					  "hideMethod": "fadeOut"
					}
				
	@endif

	@if (Session::has('flash_desactivar'))
				
				hablar("Primero desactiva tu función actual");
					Command: toastr["error"]("{{ Session::get('flash_desactivar')}}")

					toastr.options = {
					  "closeButton": true,
					  "debug": true,
					  "newestOnTop": false,
					  "progressBar": true,
					  "positionClass": "toast-top-right",
					  "preventDuplicates": true,
					  "showDuration": "300",
					  "hideDuration": "1500",
					  "timeOut": "5000",
					  "extendedTimeOut": "1000",
					  "showEasing": "swing",
					  "hideEasing": "linear",
					  "showMethod": "fadeIn",
					  "hideMethod": "fadeOut"
					}
				
	@endif
	@if (Session::has('activarDalt'))

		$('*').css({
	      "background-color": "black",
	      "color": "white"
    	});
		
	@endif


	function iniciar(){
			var texto ;
			artyom.initialize({
		    lang:"es-VE",
		    debug:true, // Show what recognizes in the Console
		    listen:true, // Start listening after this
		    speed:1.2, // Talk a little bit slow
		    log: true,
		    mode:"quick", // This parameter is not required as it will be normal by default
		    continuous:true
			});
		}
	// Add a single command
var comandos = {
    indexes:["herramientas","mis datos","publicar producto", "publicar servicio","ver productos","ver servicios","menú", "salir","bajar","subir","servicios ocultos","registros","inicio","login","atras","parar","noticias generales","noticias locales","siguiente","Desactivar","en espera"
    	
    ], // Decir alguna de estas palabras activara el comando
    action:function(i){ // Acción a ejecutar cuando alguna palabra de los indices es reconocida
        
        if(i == 0){

        	setTimeout(function () { window.location = '{{ url("userDependiente/herramientas") }}' }, 0);
        }
         if(i == 1){
        	setTimeout(function () { window.location = '{{ url('userDependiente/datos') }}' }, 0);
        }
        if(i == 2){
        	setTimeout(function () { window.location = "{{ url('userDependiente/publicarProducto') }}"; }, 0);
        }
        if(i == 3){
        	setTimeout(function () { window.location = ""; }, 0);
        }
        if(i == 4){
        	setTimeout(function () { window.location = "{{ url('userDependiente/ver_todo_producto') }}"; }, 0);
        }
         if(i == 5){
        	setTimeout(function () { window.location = "{{ url('userDependiente/ver_todo_servicio') }}"; }, 0);
        }
         if(i == 6){
        	$(".menu-btn").click();
        }
         if(i == 7){
         	setTimeout(function () { window.location = "{{ url('userDependiente/logout') }}"; }, 0);
        }
         if(i == 8){
         	abajo();
        }
         if(i == 9){
         	subir();
        }
         if(i == 10){
         	setTimeout(function () { window.location = "serviciosOcultos"; }, 0);
        }
        if(i == 11){
         	$('#registrobtn').click();
        }
        if (i == 12){
        	setTimeout(function () { window.location = "{{ url('userDependiente/inicio') }}"; }, 0);
        }
         if (i == 13){
        	$('#loginbtn').click();
        }
        if(i == 14){
        	window.history.back();
        }
         if(i == 15){
         	stopScroll();
        }
        if(i == 16){
        	setTimeout(function () { window.location = "{{ url('userDependiente/verNoticiasGenerales') }}"; }, 0);
        }
        if(i == 17){
        	setTimeout(function () { window.location = "{{ url('userDependiente/verNoticiasLocales') }}"; }, 0);
        }
        if(i == 18){
        
        	  url = $("ul[class=pagination] li > a").attr('href');

        	  window.location = url;
        }
         if(i == 19){
       

        	  window.location = "{{ url('userDependiente/desactivarmicro') }}";
        }
         if(i == 20){
       

        	  window.location = "{{ url('userDependiente/traerProductoEnEspera') }}";
        }
        
    }
};

artyom.addCommands(comandos); // Agregar comando

	function hablar(texto){
		
			if (window.speechSynthesis != 'undefined'){
				
					var voz = new SpeechSynthesisUtterance();
					voz.text = texto;
					voz.lang = "es-LA",
		        	voz.name = "Google Español",
		        	voz.voiceURI = "Google Español",
					window.speechSynthesis.speak(voz);
					
					
			}
			else{
				alert("disculpa, speechSynthesis no definidido");
			}
	}
	function callar() {
		if (window.speechSynthesis != 'undefined'){
				
					window.speechSynthesis.cancel();
					
					
			}
			else{
				alert("disculpa, speechSynthesis no definidido");
			}
	}

	function abajo() {
		clearTimeout(scrolldelay);
		window.scrollBy(0,10);
		scrolldelay = setTimeout('abajo()',65);
	}
	function subir() {
		clearTimeout(scrolldelay);
		window.scrollBy(0,-10);
		scrolldelay = setTimeout('subir()',65);
	}
	function stopScroll() {
		clearTimeout(scrolldelay);
	}

</script>