@extends('invitado.master_invitado')

@section('content')

<div class="padding color-verde">
		<div class="row">
			<div class="col-md-12 animated bounceInDown">
				<h4><label>Bienvenido a nuestro sitio web</label></h4>
				<h4 class="txt"><label>Este proyecto es una versión de prueba, puedes registrarte segun tu situación.</label></h4>
			</div>
		</div>	
</div>
<div class="row">
	<div class="col-md-6">
		<img class="img-responsive" src="ico/source.gif">
	</div>
	<div class="col-md-5"><br>
		<div class="panel panel-default" >
			<div class="panel-heading">
				<label>Inicio de Sesión como:</label>
			</div>
		<ul class="ulli">
			<li><a href="/login_institucion"><img class="logo" src="ico/school.png"> Institución</a></li>
			<li><a href="/login_vendedorInst"><img class="logo" src="ico/user-school.png"> Alumno de institución</a></li>
			{{--<li><a href="/login_vendedor"><img class="logo" src="ico/user.png"> Venedor individual</a></li>--}}
			<li><a href="/login_encargado"><img class="logo" src="ico/vendedor.png"> Encargado de área institucional</a></li>
		</ul>
		</div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<center><label>Instituciones</label></center>
					<br><br>
				
					    <ul id="flexiselDemo3">
						    <li><img class="logo-ayuda img-thumbnail" src="logo-static/1504245280.png" /></li>
						    <li><img class="logo-ayuda img-thumbnail" src="logo-static/logo_cidere_biobio_116x110.jpg" /></li>
						    <li><img class="logo-ayuda img-thumbnail" src="https://pbs.twimg.com/profile_images/866270328577830913/s10Su--x.jpg" /></li>                                                 
						</ul> 
	
	</div>
</div>

@endsection

@section('js')
	
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
	 <script type="text/javascript" src="/js/jquery.flexisel.js"></script>
	<script type="text/javascript">

	$(window).load(function() {
	    $("#flexiselDemo1").flexisel();

	    $("#flexiselDemo2").flexisel({
	        visibleItems: 4,
	        itemsToScroll: 3,
	        animationSpeed: 200,
	        infinite: true,
	        navigationTargetSelector: null,
	        autoPlay: {
	            enable: false,
	            interval: 5000,
	            pauseOnHover: true
	        },
	        responsiveBreakpoints: { 
	            portrait: { 
	                changePoint:480,
	                visibleItems: 1,
	                itemsToScroll: 1
	            }, 
	            landscape: { 
	                changePoint:640,
	                visibleItems: 2,
	                itemsToScroll: 2
	            },
	            tablet: { 
	                changePoint:768,
	                visibleItems: 3,
	                itemsToScroll: 3
	            }
	        },
	        loaded: function(object) {
	            console.log('Slider loaded...');
	        },
	        before: function(object){
	            console.log('Before transition...');
	        },
	        after: function(object) {
	            console.log('After transition...');
	        },
	        resize: function(object){
	            console.log('After resize...');
	        }
	    });
	    
	    $("#flexiselDemo3").flexisel({
	        visibleItems: 3,
	        itemsToScroll: 1,         
	        autoPlay: {
	            enable: true,
	            interval: 5000,
	            pauseOnHover: true
	        }        
	    });
	    
	    $("#flexiselDemo4").flexisel({
	        infinite: false     
	    });    
	    
	});
</script>

@endsection