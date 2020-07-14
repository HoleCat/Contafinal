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
            <h1 class="mx-auto">TITULOS</h1>
        </div>
       <div class="col-12 py-2">
           <div class="col-12">
            <form action="/titulos/store">
                <div class="row">
                    <div class="col-xl-2 col-md-2 col-sm-3 col-xs-12">
                        <label>CODIGO</label>
                        <input class="form-control" type="text" name="codigo">
                    </div>
                    <div class="col-xl-5 col-md-5 col-sm-5 col-xs-12">
                        <label>CONTENIDO</label>
                        <input class="form-control" type="text" name="contenido">
                    </div>
                    <div class="col-xl-5 col-md-5 col-sm-4 col-xs-12">
                        <label>RESUMEN</label>
                        <input class="form-control" type="text" name="resumen">
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
               <button class="btn btn-primary" onclick="titulotable()">ACTIVAR FILTROS</button>
           </div>
           <div class="col-12">
                <table class="table table-bordered" id="tabla-titulos">
                    <thead class="bg-white">
                        <th class="col">CONTENIDO</th>
                        <th class="col">RESUMEN</th>
                        <th class="col">CODIGO</th>
                        <th class="col">OPCIONES</th>
                    </thead>
                    <tbody class="body-real">
                        @foreach ($titulos as $titulos)
                        <tr class="bg-white">
                            <td class="col">{{ $titulos->contenido }}</td>
                            <td class="col">{{ $titulos->resumen }}</td>
                            <td class="col">{{ $titulos->codigo }}</td>
                            <td class="col">
                                <form action="/titulos/delete">
                                    <input type="hidden" name="id" value="{{ $titulos->id }}">
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
<script src="{{ asset('assets/js/proyecto/titulo.js') }}" defer></script>
@endsection