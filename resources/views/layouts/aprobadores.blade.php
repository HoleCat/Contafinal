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
            <h1 class="mx-auto">APROBADORES</h1>
        </div>
       <div class="col-12 py-2">
           <div class="col-12">
            <form action="/aprobador/store">
                <div class="row">
                    <div class="col">
                        <label>NOMBRE</label>
                        <input class="form-control" type="text" name="nombre">
                    </div>
                    <div class="col">
                        <label>APELLIDOS</label>
                        <input class="form-control" type="text" name="apellido">
                    </div>
                    <div class="col">
                        <label>CORREO</label>
                        <input class="form-control" type="text" name="correo">
                    </div>
                    <div class="col">
                        <label>DNI</label>
                        <input class="form-control" type="text" name="dni">
                    </div>
                    <div class="col">
                        <label>TELEFONO</label>
                        <input class="form-control" type="text" name="telefono">
                    </div>
                    <div class="col-12 my-3">
                        <input class="btn btn-success" type="submit" value="AGREGAR">
                    </div>
                </div>
            </form>
           </div>
       </div>
       <div class="col-12 py-0">
           <div class="pb-4 col-12">
               <button class="btn btn-primary" onclick="aprobadortable()">ACTIVAR FILTROS</button>
           </div>
           <div class="col-12">
                <table class="table table-bordered" id="tabla-aprobador">
                    <thead class="bg-white">
                        <th class="col">NOMBRE Y APELLIDOS</th>
                        <th class="col">CORREO</th>
                        <th class="col">TELEFONO</th>
                        <th class="col">DNI</th>
                        <th class="col">OPCIONES</th>
                    </thead>
                    <tbody class="body-real">
                        @foreach ($aprobadores as $aprobadores)
                        <tr class="bg-white">
                            <td class="col">{{ $aprobadores->nombre }} {{ $aprobadores->apellido }}</td>
                            <td class="col">{{ $aprobadores->correo }}</td>
                            <td class="col">{{ $aprobadores->telefono }}</td>
                            <td class="col">{{ $aprobadores->dni }}</td>
                            <td class="col">
                                <form action="/aprobador/delete">
                                    <input type="hidden" name="id" value="{{ $aprobadores->id }}">
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
<script src="{{ asset('assets/js/proyecto/aprobador.js') }}" defer></script>
@endsection