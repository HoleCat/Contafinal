@extends('layouts.app_guest')

@section('content')
<script src="{{ asset('assets/js/proyecto/efectos.js') }}" defer></script>
<script src="{{ asset('assets/js/proyecto/tablas.js') }}" defer></script>
<script src="{{ asset('assets/js/proyecto/vistas.js') }}" defer></script>
<script src="{{ asset('assets/js/proyecto/config.js') }}" defer></script>
<script src="{{ asset('assets/js/proyecto/alerts.js') }}" defer></script>
<div class="container-fluid">
    <div class="row" id="content">
        <div class="col-12 text-center">
            <h1 class="mx-auto">NOTICIAS</h1>
        </div>
       <div class="col-12 py-2">
           <div class="col-12">
            <form action="/noticia/store">
                <div class="row">
                    <div class="col">
                        <label>CONTENIDO</label>
                        <input class="form-control" type="text" name="contenido">
                    </div>
                    <div class="col">
                        <label>RESUMEN</label>
                        <input class="form-control" type="text" name="resumen">
                    </div>
                    <div class="col">
                        <label>STATUS</label>
                        <select class="form-control" type="text" name="status">
                            <option value="none">-- ELIJA --</option>
                            <option value="activo">ACTIVO</option>
                            <option value="inactivo">INACTIVO</option>
                        </select>
                    </div>
                    <div class="col-12 py-3">
                        <input class="btn btn-success" type="submit" value="AGREGAR">
                    </div>
                </div>
            </form>
           </div>
       </div>
       <div class="col-12 py-0">
           <div class="pb-4 col-12">
               <button class="btn btn-primary" onclick="noticiatable()">ACTIVAR FILTROS</button>
           </div>
           <div class="col-12">
                <table class="table table-bordered" id="tabla-noticia">
                    <thead class="bg-white">
                        <th class="col">CONTENIDO</th>
                        <th class="col">RESUMEN</th>
                        <th class="col">STATUS</th>
                        <th class="col">OPCIONES</th>
                    </thead>
                    <tbody class="body-real">
                        @foreach ($noticias as $noticias)
                        <tr class="bg-white">
                            <td class="col">{{ $noticias->contenido }}</td>
                            <td class="col">{{ $noticias->resumen }}</td>
                            <td class="col">{{ $noticias->status }}</td>
                            <td class="col">
                                <form action="/noticia/delete">
                                    <input type="hidden" name="id" value="{{ $noticias->id }}">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
           </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/proyecto/noticia.js') }}" defer></script>
@endsection