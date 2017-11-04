@extends('inicioCliente.clienteMaster')

@section('content')


<div class="container">
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