<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name = "viewport" content = "user-scalable=no, width=device-width">
<meta name="apple-mobile-web-app-capable" content="yes" />
<title>Flexisel - A responsive jQuery Carousel</title>
<link href="css/estilo_carousel.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.flexisel.js"></script>

</head>

<body>
    
        @foreach($ver_producto as $p)
   
        <h1>{{ $p->nombreProducto }}</h1>

        @endforeach
       
</body>
</html>