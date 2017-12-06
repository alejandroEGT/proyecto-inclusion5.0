@extends('inicioCliente.clienteMaster')

@section('content')


<div class="container">
  <br>
     <center><label><h1>Resultado de productos</h1></label></center>
  <br>
  <div class="row">
  <div class="col-md-offset-2 col-md-12 panel">
    @if (count($productos)>0)
      @foreach ($productos as $producto)
        <div class="row">
          <div class="col-md-4 imagen-producto  ">
            <img src="{{'/'.$producto->foto}}" class="img-thumbnail  " >
          </div>
          <div class="col-md-4  ">
            <p><label>{{ $producto->nombre }}</label></p>
            <p><label style="color:#85929E" >{{ $producto->descripcion }}</label></p>
            <p>
              <a href="{{ url("/verDetalleProducto/".base64_encode($producto->idProducto)) }}"><img src="/ico/ver_detalle.png" class="botonImagenVer"></a>

            </p>
          </div>
        </div>
        <hr>
      @endforeach
    @endif
    @if (!count($productos))
      <label>No hay productos relacionados a su busqueda <img src="/ico/sad.png"></label>
    @endif
  </div>
</div>
<br>

    <center><label><h1>Resultado de servicios</h1></label></center>
  <br>
<div class="row">
  <div class="col-md-offset-2 col-md-12 panel">
    @if (count($servicios)>0)
      @foreach ($servicios as $servicio)
        <div class="row">
          <div class="col-md-4 imagen-producto  ">
            <img src="{{'/'.$servicio->fotoServicio}}" class="img-thumbnail  " >
          </div>
          <div class="col-md-4  ">
            <p><label>{{ $servicio->nombreServicio }}</label></p>
            <p><label style="color:#85929E" >{{ $servicio->descripcionServicio }}</label></p>
            <p>
              <a href="{{ url('/detalleServicio/'.base64_encode($servicio->idServicio).'/'.base64_encode($servicio->idInstitucion)) }}"><img src="../ico/ver_detalle.png" class="botonImagenVer"></a>
            </p>
          </div>
        </div>
        <hr>
      @endforeach
    @endif
    @if (!count($servicios))
      <label>No hay servicios relacionados a su busqueda <img src="/ico/sad.png"></label>
    @endif
  </div>
</div>

</div>


@endsection