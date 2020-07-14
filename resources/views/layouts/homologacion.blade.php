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
            <h1 class="mx-auto">HOMOLOGACIONES</h1>
        </div>
       <div class="col-12 py-2">
           <div class="col-12">
            <form action="/homologacion/store">
                <div class="row">
                    <div class="col-xl-2 col-md-2 col-sm-3 col-xs-12">
                        <label>CODIGO</label>
                        <input class="form-control" type="number" name="codigo">
                    </div>
                    <div class="col-xl-10 col-md-10 col-sm-9 col-xs-12">
                        <label>DESCRIPCION</label>
                        <input class="form-control" type="text" name="descripcion">
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
               <button class="btn btn-primary" onclick="homotable()">ACTIVAR FILTROS</button>
           </div>
           <div class="col-12">
                <table class="table table-bordered" id="tabla-homologacion">
                    <thead class="bg-white">
                        <th class="col">DESCRIPCION</th>
                        <th class="col">CODIGO</th>
                        <th class="col">OPCIONES</th>
                    </thead>
                    <tbody class="body-real">
                        @foreach ($homologaciones as $homologaciones)
                        <tr class="bg-white">
                            <td class="col">{{ $homologaciones->descripcion }}</td>
                            <td class="col">{{ $homologaciones->codigo }}</td>
                            <td class="col">
                                <form action="/homologacion/delete">
                                    <input type="hidden" name="id" value="{{ $homologaciones->id }}">
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
<script src="{{ asset('assets/js/proyecto/homo.js') }}" defer></script>
@endsection