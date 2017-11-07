		<script src="{{asset('js/jquery.easing.min.js')}}"></script> 
         <script src="{{asset('js/jquery.scrollTo.js')}}"></script>
         <script src="{{asset('js/wow.min.js')}}"></script>
        <script src="{{ asset('js/artyomCommands.js') }}" ></script>
         

<script>

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
		    $("a, h1, button, h2, h3, h4, h5, input, label").addClass('zoom');
		else
			//alert("no ok");
		    $("a, h1, button, h2, h3, h4, h5, input, label").removeClass('zoom');
	}


	@if (Session::has('activarMicro'))		 
		iniciar(); 
	                      	   
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


	                $( "label a" ).mouseover(function(event) {
				  				//var p = $(this).text();
				  					hablar($(event.target).text());
							 	//hablar($(event.target).text());
					});
					  $( "label, a" ).mouseout(function(event) {
				  				//var p = $(this).text();
				  					callar();
							 	//hablar($(event.target).text());
					});


	                 $( "select" ).mouseover(function(event) {
				  					texto = $(event.target).text();
				  					hablar(texto);
							 	//hablar($(event.target).text());
							});
							
							$( "button" ).mouseover(function(event) {
									var ph = $(this).text();
				  					hablar("Botón "+ph);
							 	//hablar($(event.target).text());
							});
							$( "input[type='text'], input[type='password'], input[type='file']" ).mouseover(function(event) {
									var ph = $(this).attr("placeholder");
				  					hablar("ingrese aqui "+ph);
							 	//hablar($(event.target).text());
							});
							$( "input[type='button'], input[type='submit']" ).mouseover(function(event) {
									var ph = $(this).attr("value");
				  					hablar("Botón para "+ph);
							 	//hablar($(event.target).text());
							});
							$( "textarea" ).mouseover(function(event) {
									var ph = $(this).attr("placeholder");
				  					hablar("ingrese aqui "+ph);
							 	//hablar($(event.target).text());
							});
							

							$( "a img" ).mouseover(function(event) {

				  				var alt = $(this).attr("alt");
				  				hablar(alt);
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

	function iniciar(){
			var texto ;
			artyom.initialize({
		    lang:"es-VE",
		    debug:true, // Show what recognizes in the Console
		    listen:true, // Start listening after this
		    speed:1.2, // Talk a little bit slow
		    log: true,
		    mode:"normal", // This parameter is not required as it will be normal by default
		    continuous:true
			});
		}
	// Add a single command
var comandos = {
    indexes:["institucion","alumno","vendedor", "crear institución","crear vendedor","crear vendedor alumno","menú", "desactivar","bajar","subir","crear usuarios","registros","inicio","login","atras"
    	
    ], // Decir alguna de estas palabras activara el comando
    action:function(i){ // Acción a ejecutar cuando alguna palabra de los indices es reconocida
        
        if(i == 0){

        	setTimeout(function () { window.location = "login_institucion"; }, 0);
        }
         if(i == 1){
        	setTimeout(function () { window.location = "login_vendedorInst"; }, 0);
        }
        if(i == 2){
        	setTimeout(function () { window.location = "login_vendedor"; }, 0);
        }
        if(i == 3){
        	setTimeout(function () { window.location = "formInstitucion"; }, 0);
        }
        if(i == 4){
        	setTimeout(function () { window.location = "formUsuario"; }, 0);
        }
         if(i == 5){
        	setTimeout(function () { window.location = "formUsuarioInstitucion"; }, 0);
        }
         if(i == 6){
        	$(".menu-btn").click();
        }
         if(i == 7){
         	setTimeout(function () { window.location = "desactivarmicro"; }, 0);
        }
         if(i == 8){
         	abajo();
        }
         if(i == 9){
         	subir();
        }
         if(i == 10){
         	setTimeout(function () { window.location = "ver_usuarios"; }, 0);
        }
        if(i == 11){
         	$('#registrobtn').click();
        }
        if (i == 12){
        	setTimeout(function () { window.location = "inicio"; }, 0);
        }
         if (i == 13){
        	$('#loginbtn').click();
        }
        if(i == 14){
        	window.history.back();
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