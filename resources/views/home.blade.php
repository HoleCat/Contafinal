@extends('layouts.app')

@section('content')
<script src="{{ asset('assets/js/proyecto/efectos.js') }}" defer></script>
<script src="{{ asset('assets/js/proyecto/tablas.js') }}" defer></script>
<script src="{{ asset('assets/js/proyecto/vistas.js') }}" defer></script>
<script src="{{ asset('assets/js/proyecto/config.js') }}" defer></script>
<script src="{{ asset('assets/js/proyecto/alerts.js') }}" defer></script>
<div class="container-fluid">
    <!--@include('herramientas.sidebar.sidebar')-->
    <div class="row" id="content">

    </div>
    <div class="row p-0 position-fixed w-100 z-index-3" style="bottom: 0px;min-height:50px;max-height:50px;">
      <div id="carousel-noticias" class="w-100 carousel slide bg-dark" data-ride="carousel">
          <div class="text-white carousel-inner">
              <div class="carousel-item active">
                  <p class="noticia-fix px-3 text-center d-block w-100">Ultimas noticias publicadas</p>
              </div>
              @foreach ($noticias as $noticias)
              <div class="carousel-item">
              <p class="noticia-fix py-0 px-3 text-center d-block w-100">{{$noticias->contenido}}</p>
              </div>
              @endforeach
          </div>
          <a class="w-fit-content-def carousel-control-prev" href="#carousel-noticias" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="w-fit-content-def carousel-control-next" href="#carousel-noticias" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
  </div>
</div>
@endsection
