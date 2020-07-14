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
            <h1 class="mx-auto">IMAGENES</h1>
        </div>
       <div class="col-12 py-2">
           <div class="col-12">
            <form id="form_imagenes_store">
                <div class="row">
                    <div class="form-group col-xs-12">
                        <label for="input-image">Imagen</label>
                        <input type="file" class="form-control-file" id="input-image" name="myfile">
                    </div>
                    <div class="form-group col-xs-12">
                        <label>Nombre</label>
                        <input class="form-control" type="text" name="nombre">
                    </div>
                    <div class="form-group col-12">
                        <input class="btn btn-success" type="submit" value="AGREGAR">
                    </div>
                </div>
            </form>
           </div>
       </div>
       <div class="col-12 py-0">
           <div class="pb-4 col-12">
               <button class="btn btn-primary" onclick="imagentable()">ACTIVAR FILTROS</button>
           </div>
           <div class="col-12" id="tabla-imagen-div">
                <table class="table table-bordered" id="tabla-imagen">
                    <thead class="bg-white">
                        <th class="col">IMAGEN</th>
                        <th class="col">ID</th>
                        <th class="col">NOMBRE</th>
                        <th class="col">OPCIONES</th>
                    </thead>
                    <tbody class="body-real">
                        @foreach ($imagenes as $imagenes)
                        <tr class="bg-white">
                            <td class="col">
                                <img src="{{ $imagenes->ruta }}" alt="" style="width: 40px;">
                            </td>
                            <td class="col">
                                {{ $imagenes->id }}
                            </td>
                            <td class="col">
                                {{ $imagenes->nombre }}
                            </td>
                            <td class="col">
                                <form action="/imagen/delete">
                                    <input type="hidden" name="id" value="{{ $imagenes->id }}">
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
<script src="{{ asset('assets/js/proyecto/imagenes.js') }}" defer></script>
@endsection