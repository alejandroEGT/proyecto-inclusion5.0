$(document).ready(function($) {
	num = 0;
	
	$( "#activarLector" ).click(function() {
			if(num == 0){
					num++;
					$("#activarLector")
					.html("<i class='fa fa-headphones' aria-hidden='true'></i> Desactivar dictador de palabras");
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

					
			}
	});
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



