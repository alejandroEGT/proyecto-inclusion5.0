@extends('inicioCliente.clienteMaster')

@section('content')


<div class="container">
  <hr>
  <center><label><h1>Resultados</h1></label></center>
  <hr>
  <div class="row">
  <div class="col-md-offset-2 col-md-12 panel">
    @if (count($productos)>0)
      @foreach ($productos as $producto)
        <div class="row">
          <div class="col-md-4   ">
            <a class="imagen-producto" href="{{ url("/verDetalleProducto/".base64_encode($producto->idProducto)) }}"><img src="{{'/'.$producto->foto}}" class="img-thumbnail" ></a>
          </div>
          <div class="col-md-4  ">
            <label class="estiloDetalleProducto"><h4> {{ $producto->nombre }} </h4></label>
              <dl>      
                <dt><label class="estiloDetalleTitulos"><strong>Descripción del producto</strong></label></dt>
                <dd><label class="estiloDetalleDescripcion">{{ $producto->descripcion }}</label></dd>
                <dt><label class="estiloDetalleTitulos"><strong>Valor del producto</strong></label></dt>
                <dd><label class="estiloDetalleDescripcion lbl-precio">$ {{ $producto->precio }}</label></dd>
              </dl>
            <p>
              <a class="btn btn-primary btn-xs" href="{{ url("/verDetalleProducto/".base64_encode($producto->idProducto)) }}">Ver..</a>
            </p>
          </div>
        </div>
        <hr>
      @endforeach
    @endif
    @if (!count($productos))
      <label>No hay productos <img src="/ico/sad.png"></label>
    @endif
  </div>
</div>

</div>


@endsection