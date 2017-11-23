var reconociendo = false;
var reconocimiento;
var foco = false;

var scrolldelay;

$(document).ready(function($) {
	num = 0;
	num2 =0;
		$("#activarcomadnovoz").click(function(event) {
			/* Act on the event */
			if(num == 1){
				hablar("Primero desactiva tu función actual");
			}
			else{
				if(num2 == 0){
					num2++;
						
						hablar("comando de voz activado");
						iniciar();
				}
				else{
					hablar("desactivando comando de voz");
					location.reload();
						
				}
			}
		});
			
		$( "#activarLector" ).click(function() {

			if(num2 == 1){
				hablar("Primero desactiva tu función actual");
			}
			else{
				if(num == 0){
						num++;
						
			  			hablar("dictador de texto activado");

			  			$( "p" ).mouseover(function(event) {
			  				//var p = $(this).text();
			  					hablar($(event.target).text());
						 	//hablar($(event.target).text());
						});
						$( "h2" ).mouseover(function(event) {
			  					hablar($(event.target).text());
						});
						$( "h1" ).mouseover(function(event) {
			  					hablar($(event.target).text());
						 	//hablar($(event.target).text());
						});
						$( "h3" ).mouseover(function(event) {
			  					hablar($(event.target).text());
						 	//hablar($(event.target).text());
						});
						$( "h4" ).mouseover(function(event) {
			  					hablar($(event.target).text());
						 	//hablar($(event.target).text());
						});
						$( "h5" ).mouseover(function(event) {
			  					hablar($(event.target).text());
						 	//hablar($(event.target).text());
						});
						$( "h6" ).mouseover(function(event) {
			  					hablar($(event.target).text());
						 	//hablar($(event.target).text());
						});
						$( "input" ).mouseover(function(event) {
								var ph = $(this).attr("placeholder");
			  					hablar("ingrese aqui "+ph);
						 	//hablar($(event.target).text());
						});
						$( "textarea" ).mouseover(function(event) {
								var ph = $(this).attr("placeholder");
			  					hablar("ingrese aqui "+ph);
						 	//hablar($(event.target).text());
						});
						$( "button" ).mouseover(function(event) {
								var text = $(event.target).text();
			  					hablar("Botón para "+text);
						 	//hablar($(event.target).text());
						});

						$( "a img" ).mouseover(function(event) {

			  				var alt = $(this).attr("alt");
			  				hablar(alt);
						});
				}
				else{

						hablar("desactivando dictador de texto");
						location.reload();
						
				}
			}
	});
		
		/*$("#nombre").focus();
		if($("#nombre").is(':focus')){
			setTimeout(function () { hablar("Ingrese nombre"); }, 1000);
		}*/
	});
	
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
	//alert("hola");
	/*var commands = [

	{
		indexes: ["arriba","sube","subir"],
		action: function(){

			
			subir();
			
			//alert("hola");
			 //$("html, body").animate({scrollTop:"0px"});
		}
	}
	,
	{
		indexes: ["abajo","bajar"],
		action: function(){
			
			abajo();
			 //$("html, body").animate({scrollTop:num+"px"});
			 //num+=num;
		}
	}
	,
	{
		indexes: ["parar","frenar","detener","para"],
		action: function(){
			
			stopScroll();
			 //$("html, body").animate({scrollTop:num+"px"});
			 //num+=num;
		}
	}
	,
	{
    	indexes: ["contacto"],
    	action: function(){
        	//hablar("redireccionando a contacto");
        	artyom.fatality();
        	setTimeout(function () { window.location = "contacto"; }, 0);
    	}
    }	
    ,
    {
    	indexes: ["inicio"],
    	action: function(){
        	//hablar("redireccionando a inicio");
        	artyom.fatality();
        	setTimeout(function () { window.location = "/"; }, 0);
    	}
   },
   {
    	indexes: ["sesión"],
    	action: function(){
        	//hablar("redireccionando a sesión");
        	artyom.fatality();
        	setTimeout(function () { window.location = "sesion"; }, 0);
    	}
   }];

artyom.addCommands(commands);
	*/
	artyom.redirectRecognizedTextOutput((recognized,isFinal) => {
	    if(isFinal){
	        // Nothing
	        
	        if(/subir/.test(recognized) ){
	        	subir();
	        }
	        if(/bajar/.test(recognized) ){
	        	abajo();
	        }
	        if( /parar/.test(recognized)){
	        	stopScroll();
	        }
	        if(/contacto/.test(recognized)){
	        	//hablar("redireccionando a toyota");
	        	//artyom.fatality();
        		//setTimeout(function () { window.location = "contacto"; }, 0);
        		$("#contenido-master").load('contacto');
	        }
	         if(/sesión/.test(recognized)){
	        	//hablar("redireccionando a toyota");
	        	//artyom.fatality();
        		//setTimeout(function () { window.location = "sesion"; }, 0);
        		$("#contenido-master").load('sesion');
	        }
	         if(/inicio/.test(recognized) || /inició/.test(recognized)){
	        	//hablar("redireccionando a toyota");
	        	artyom.fatality();
        		setTimeout(function () { window.location = "/inicio"; }, 0);
	        }
	        
	        //artyom.say(recognized);*/
	    }else{
	        console.log("error");
	    }
	});
function hablar(texto){
	
		if (window.speechSynthesis != 'undefined'){
			
				var voz = new SpeechSynthesisUtterance();
				voz.text = texto;
				voz.lang = "es-LA",
	        	voz.name = "Google Español",
	        	voz.voiceURI = "Google Español",
				window.speechSynthesis.speak(voz);
				event.preventDefault();
				
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