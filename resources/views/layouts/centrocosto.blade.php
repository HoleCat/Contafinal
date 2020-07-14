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
            <h1 class="mx-auto">CENTRO DE COSTOS</h1>
        </div>
       <div class="col-12 py-2">
           <div class="col-12">
            <form action="/centrocosto/store">
                <div class="row">
                    <div class="col">
                        <label>CODIGO</label>
                        <input class="form-control" type="text" name="contenido">
                    </div>
                    <div class="col">
                        <label>DESCRIPCION</label>
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
               <button class="btn btn-primary" onclick="centrocostotable()">ACTIVAR FILTROS</button>
           </div>
           <div class="col-12">
                <table class="table table-bordered" id="tabla-centrocosto">
                    <thead class="bg-white">
                        
                        <th class="col">DESCRIPCION</th>
                        <th class="col">CODIGO</th>
                        <th class="col">OPCIONES</th>
                    </thead>
                    <tbody class="body-real">
                        @foreach ($centrocostos as $centrocostos)
                        <tr class="bg-white">
                            <td class="col">{{ $centrocostos->descripcion }}</td>
                            <td class="col">{{ $centrocostos->codigo }}</td>
                            
                            <td class="col">
                                <form action="/centrocosto/delete">
                                    <input type="hidden" name="id" value="{{ $centrocostos->id }}">
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
<script src="{{ asset('assets/js/proyecto/centrocosto.js') }}" defer></script>
@endsection