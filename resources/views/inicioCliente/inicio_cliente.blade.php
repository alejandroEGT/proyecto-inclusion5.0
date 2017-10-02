
@extends('inicioCliente.clienteMaster')

@section('content')
   
	<!--Carousel-->
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
					    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					  </ol>
					  <div class="carousel-inner">
					    <div class="carousel-item active">
					      <img class="d-block w-100" src="http://ipcft.santotomas.cl/wp-content/uploads/sites/7/2016/01/gastronomia.jpg" alt="First slide">
					    </div>
					    <div class="carousel-item">
					      <img class="d-block w-100" src="http://destinonegocio.com/wp-content/uploads/2015/04/artesanias.jpg" alt="Second slide">
					    </div>
					    <div class="carousel-item">
					      <img class="d-block w-100" src="https://interiorismos.com/wp-content/2017/01/geometricos2.jpg" alt="Third slide">
					    </div>
					  </div>
					  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
				</div>
			</div>
		</div>
	</div>

	<!--recomedados-->
	<div class="android-more-section">
		<div class="android-section-title mdl-typography--display-1-color-contrast"><i class="material-icons">&#xE8D0;</i> Recomendados</div>
	  		<div class="android-card-container mdl-grid">
	    		

				    <ul id="flexiselDemo1"> 
					    <li><a href="registro_cliente">
							<div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--3dp">
								<div class="mdl-card__media porteimg">
					    			<img src="productos/IMG_4224.jpg"/>
					    		</div>
								
								<div class="mdl-card__title">
							         <h4 class="mdl-card__title-text">Unpade</h4>
							    </div>

							    <div class="mdl-card__supporting-text">
							        <span class="mdl-typography--font-light mdl-typography--subhead">Lindo Florero fabricado por sonrisas de unpade</span>
							    </div>
							</div>
					    </li></a>	                                                         
					</ul>
						<div class="clearout"></div>  
				

				

		   
		</div>
	</div>

	<!--tiendas-->
	<div class="android-more-section">
		<div class="android-section-title mdl-typography--display-1-color-contrast"><i class="material-icons">&#xE867;</i> Tiendas</div>
	  <div class="android-card-container mdl-grid">
	    <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
	      <div class="mdl-card__media porteimg">
	        <img src="productos/unpade.jpg">
	      </div>
	      <div class="mdl-card__title">
	         <h4 class="mdl-card__title-text">Unpade</h4>
	      </div>
	      <div class="mdl-card__supporting-text">
	        <span class="mdl-typography--font-light mdl-typography--subhead">Lindo Florero fabricado por sonrisas de unpade</span>
	      </div>
	      <div class="mdl-card__actions">
	         <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="">
	           Ver Tienda
	           <i class="material-icons">chevron_right</i>
	         </a>
	      </div>
	    </div>

	    <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
	      <div class="mdl-card__media porteimg">
	        <img src="productos/artemanos.jpg">
	      </div>
	      <div class="mdl-card__title">
	         <h4 class="mdl-card__title-text">ArteManos</h4>
	      </div>
	      <div class="mdl-card__supporting-text">
	        <span class="mdl-typography--font-light mdl-typography--subhead">Lindo Llavero fabricado por sonrisas de unpade</span>
	      </div>
	      <div class="mdl-card__actions">
	         <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="">
	           Ver Tienda
	           <i class="material-icons">chevron_right</i>
	         </a>
	      </div>
	    </div>

	    <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
	      <div class="mdl-card__media porteimg">
	        <img src="productos/sonrisas.png">
	      </div>
	      <div class="mdl-card__title">
	         <h4 class="mdl-card__title-text">Sonrisas de unpade</h4>
	      </div>
	      <div class="mdl-card__supporting-text">
	        <span class="mdl-typography--font-light mdl-typography--subhead">Lindo Llaverito fabricado por sonrisas de unpade</span>
	      </div>
	      <div class="mdl-card__actions">
	         <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="">
	           Ver Tienda
	           <i class="material-icons">chevron_right</i>
	         </a>
	      </div>
	    </div>

	    <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--2-col-phone mdl-card mdl-shadow--3dp">
	      <div class="mdl-card__media porteimg">
	        <img src="productos/lider.png">
	      </div>
	      <div class="mdl-card__title">
	         <h4 class="mdl-card__title-text">Lider</h4>
	      </div>
	      <div class="mdl-card__supporting-text">
	        <span class="mdl-typography--font-light mdl-typography--subhead">Lindo Elastico para el pelo fabricado por sonrisas de unpade</span>
	      </div>
	      <div class="mdl-card__actions">
	         <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="">
	           Ver Tienda
	           <i class="material-icons">chevron_right</i>
	         </a>
	      </div>
	    </div>
	  </div>
	  
	</div>

	<!--calidad-->
	<div class="container-fluid">
		<div class="row piePagina">
			<div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
				<div class="piePagina text-center">
			      	<img src="productos/dinero-icono.png">
				      <div class="caption">
				        <h5>Calidad y precio</h5>
		       
				      </div>
			    </div>
			</div>

			<div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
				<div class="piePagina text-center">
			      	<img src="productos/kiphu.png">
				      <div class="caption">
				        <h5>Pagos mediante khipu</h5>
				        
				      </div>
			    </div>
			</div>


			<div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
				<div class="piePagina text-center">
			      	<img src="productos/confianza.png">
				      <div class="caption">
				        <h5>Compra con confianza</h5>
				      </div>
			    </div>
			</div>

		</div>
	</div>	
	 		
@endsection
