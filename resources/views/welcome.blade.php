@extends('layouts.app_guest')

@section('content')
<!--<div class="px-0 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12 d-flex position-absolute" style="min-height: 100%;max-height:100%;z-index:-2;top:0px;bottom:0px;">
    <div class="purple-gradient col-xl-4 col-md-4 col-sm-5 col-xs-1 col-1" style="min-height: 80%;max-height:80%"></div>
    <div class="purple-gradient col-xl-1 col-md-3 col-sm-2 col-xs-4 col-3" style="min-height: 30%;max-height:80%"></div>
    <div class="purple-gradient col-xl-7 col-md-5 col-sm-5 col-xs-7 col-6" style="min-height: 80%;max-height:100%"></div>
    <div class="bg-general px-0 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12 d-flex position-absolute" style="bottom:20%;min-height: 20%;max-height:20%" >
    </div>
    <div class="bg-general px-0 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12 d-flex position-absolute" style="top:10%;min-height: 10%;max-height:10%" >
    </div>
</div>-->
<div class="container-fluid">
    
   <div class="row px-0">
    
        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 col-12 d-flex" style="align-items: center">
            <img class="col-12" src="{{ $foto1 }}" alt="">
        <p class="p-10-per font-heavy-titulo color-primary position-absolute">{{$principal}}</p>
        </div>
        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 col-12 d-flex" style="align-items: center">
        <p class="p-10-per font-heavy-parrafo color-primary position-absolute">{{$resumen}}</p>
        </div>
   </div>
   <!--<div class="row py-5">
        <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12 d-flex flex-wrap" style="align-items: center">
            <img class="mx-auto offset-xl-1 offset-md-1 col-xl-5 col-md-5 col-sm-7 col-xs-10 col-10" src="{{ asset('assets/img/diagrama_db.png') }}" alt="">
            <img class="mx-auto col-xl-6 col-md-6 col-sm-7 col-xs-10 col-10" src="{{ asset('assets/img/conectividad.png') }}" alt="">
            <p class="p-10-per font-heavy-banner color-primary position-absolute">MIGRA TODOS TUS ARCHIVOS CONTABLES DE EXCEL Y CSV A BASES DE DATOS</p>
        </div>
   </div>-->
   <!--<div class="row py-5">
        <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12">
            <div class="col-12 position-relative">
                <div class="z-index-3 col-12 d-flex">
                    <div class="font-heavy-subtitulo z-index-3 col-xl-10 col-md-9 col-sm-9 col-xs-8 px-0 mx-0 d-flex" style="align-items: center">
                    </div>
                    <img class="col-xl-2 col-md-3 col-sm-3 col-xs-4 col-4" src="{{ asset('assets/img/excel.png') }}" alt="">
                </div>
                <div class="z-index-3 col-12 d-flex">
                    <div class="font-heavy-banner z-index-3 col-xl-10 col-md-9 col-sm-9 col-xs-8 px-0 mx-0 d-flex" style="align-items: center">
                        REEMPLAZA EL PAPEL Y LOS ARCHIVOS EXCEL
                    </div>
                    <img class="col-xl-2 col-md-3 col-sm-3 col-xs-4 col-4" src="{{ asset('assets/img/xml.png') }}" alt="">
                </div>
                <div class="z-index-3 col-12 d-flex">
                    <div class="font-heavy-subtitulo z-index-3 col-xl-10 col-md-9 col-sm-9 col-xs-8 px-0 mx-0 d-flex" style="align-items: center">
                    </div>
                    <img class="col-xl-2 col-md-3 col-sm-3 col-xs-4 col-4" src="{{ asset('assets/img/csv_black.png') }}" alt="">
                </div>
                <img class="h-100 absolute-top-left-check position-absolute z-index-2 float-left col-6 col-xl-3 col-md-4 col-sm-4 col-xs-6" src="{{ asset('assets/img/adios_papel.gif') }}" alt="">
            </div>
        </div>
   </div>-->
   <div class="row py-5">
        <div class="px-0 py-3 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12">
            
            @include('layouts.servicios')
        </div>
        <div class="px-0 vh-100 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12 d-flex" style="align-items: baseline">
            <!--<div class="vh-100 px-0 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12 d-flex position-absolute" style="z-index:-2;top:0px;bottom:0px;">
                <div class="purple-gradient col-xl-4 col-md-4 col-sm-5 col-xs-1 col-3" style="min-height: 80%;max-height:80%"></div>
                <div class="purple-gradient col-xl-1 col-md-3 col-sm-2 col-xs-4 col-3" style="min-height: 30%;max-height:80%"></div>
                <div class="purple-gradient col-xl-7 col-md-5 col-sm-5 col-xs-7 col-6" style="min-height: 80%;max-height:100%"></div>
                <div class="bg-general px-0 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12 d-flex position-absolute" style="bottom:20%;min-height: 20%;max-height:20%" >
                </div>
                <div class="bg-general px-0 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-12 d-flex position-absolute" style="top:10%;min-height: 10%;max-height:10%" >
                </div>
            </div>-->
            <form action="/contacto/" class="px-0 d-flex flex-wrap" >
                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 col-12">
                    <p class="px-4 p-10-per font-heavy-titulo color-primary text-center">{{$footer}}</p>
                    <div class="text-center col-12">
                        <img class="col-xl-3 col-md-3 col-sm-4 col-xs-10 col-10" src="{{ $foto3 }}" alt="">
                    </div>
                </div>
                <div class="py-5 col-xl-6 col-md-6 col-sm-12 col-xs-12 col-12">
                    <h1>Contacto :</h1>
                    <div class="form-group">
                        <input class="form-control" type="text" name="nombre" placeholder="NOMBRE">
                        <input class="form-control" type="text" name="apellido" placeholder="APELLIDO">
                        <input class="form-control" type="text" name="dni" placeholder="DNI">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="mail" name="correo" placeholder="CORREO">
                        <input class="form-control" type="number" name="telefono" placeholder="TELEFONO">
                        
                    </div>
                    <div class="form-group">
                        <label>Dinos algo :</label>
                        <textarea class="form-control" name="mensaje" id="" cols="30" rows="7"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="ENVIAR" class="btn btn-success">
                    </div>
                </div>
            </form>
            
        </div>
        
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
