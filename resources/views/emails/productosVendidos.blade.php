Felicidades administrador de la institución  <strong>{{ Session::get('nombre') }}</strong>, se ha generado una venta, abajo se encuentra el detalle:
<br>
<br>
Producto: <strong>{{ Session::get('producto') }}</strong>
<br>
Cantidad: <strong>{{ Session::get('cantidad') }}</strong>
<br>
Total: $<strong>{{ Session::get('total') }} CLP</strong>
<br>
<br>
Atentamente el equipo de "El arte escondido.".

