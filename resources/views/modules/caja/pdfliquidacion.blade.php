<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

</head>
<style>
    .letras-table-xl {
        font-size: 20px;
    }
    .letras-table {
        font-size: 10px;
    }
    table {
        border-collapse: collapse;
    }
    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
    }
    
    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }
    
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }
    
    .table tbody + tbody {
        border-top: 2px solid #dee2e6;
    }
    
    .table-sm th,
    .table-sm td {
        padding: 0.3rem;
    }
    
    .table-bordered {
        border: 1px solid #dee2e6;
    }
    
    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }
    
    .table-bordered thead th,
    .table-bordered thead td {
        border-bottom-width: 2px;
    }
    
    .table-borderless th,
    .table-borderless td,
    .table-borderless thead th,
    .table-borderless tbody + tbody {
        border: 0;
    }
    
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }
    
    .table-hover tbody tr:hover {
        color: #212529;
        background-color: rgba(0, 0, 0, 0.075);
    }
    
    .table-primary,
    .table-primary > th,
    .table-primary > td {
        background-color: #b8daff;
    }
    
    .table-primary th,
    .table-primary td,
    .table-primary thead th,
    .table-primary tbody + tbody {
        border-color: #7abaff;
    }
    
    .table-hover .table-primary:hover {
        background-color: #9fcdff;
    }
    
    .table-hover .table-primary:hover > td,
    .table-hover .table-primary:hover > th {
        background-color: #9fcdff;
    }
    
    .table-secondary,
    .table-secondary > th,
    .table-secondary > td {
        background-color: #d6d8db;
    }
    
    .table-secondary th,
    .table-secondary td,
    .table-secondary thead th,
    .table-secondary tbody + tbody {
        border-color: #b3b7bb;
    }
    
    .table-hover .table-secondary:hover {
        background-color: #c8cbcf;
    }
    
    .table-hover .table-secondary:hover > td,
    .table-hover .table-secondary:hover > th {
        background-color: #c8cbcf;
    }
    
    .table-success,
    .table-success > th,
    .table-success > td {
        background-color: #c3e6cb;
    }
    
    .table-success th,
    .table-success td,
    .table-success thead th,
    .table-success tbody + tbody {
        border-color: #8fd19e;
    }
    
    .table-hover .table-success:hover {
        background-color: #b1dfbb;
    }
    
    .table-hover .table-success:hover > td,
    .table-hover .table-success:hover > th {
        background-color: #b1dfbb;
    }
    
    .table-info,
    .table-info > th,
    .table-info > td {
        background-color: #bee5eb;
    }
    
    .table-info th,
    .table-info td,
    .table-info thead th,
    .table-info tbody + tbody {
        border-color: #86cfda;
    }
    
    .table-hover .table-info:hover {
        background-color: #abdde5;
    }
    
    .table-hover .table-info:hover > td,
    .table-hover .table-info:hover > th {
        background-color: #abdde5;
    }
    
    .table-warning,
    .table-warning > th,
    .table-warning > td {
        background-color: #ffeeba;
    }
    
    .table-warning th,
    .table-warning td,
    .table-warning thead th,
    .table-warning tbody + tbody {
        border-color: #ffdf7e;
    }
    
    .table-hover .table-warning:hover {
        background-color: #ffe8a1;
    }
    
    .table-hover .table-warning:hover > td,
    .table-hover .table-warning:hover > th {
        background-color: #ffe8a1;
    }
    
    .table-danger,
    .table-danger > th,
    .table-danger > td {
        background-color: #f5c6cb;
    }
    
    .table-danger th,
    .table-danger td,
    .table-danger thead th,
    .table-danger tbody + tbody {
        border-color: #ed969e;
    }
    
    .table-hover .table-danger:hover {
        background-color: #f1b0b7;
    }
    
    .table-hover .table-danger:hover > td,
    .table-hover .table-danger:hover > th {
        background-color: #f1b0b7;
    }
    
    .table-light,
    .table-light > th,
    .table-light > td {
        background-color: #fdfdfe;
    }
    
    .table-light th,
    .table-light td,
    .table-light thead th,
    .table-light tbody + tbody {
        border-color: #fbfcfc;
    }
    
    .table-hover .table-light:hover {
        background-color: #ececf6;
    }
    
    .table-hover .table-light:hover > td,
    .table-hover .table-light:hover > th {
        background-color: #ececf6;
    }
    
    .table-dark,
    .table-dark > th,
    .table-dark > td {
        background-color: #c6c8ca;
    }
    
    .table-dark th,
    .table-dark td,
    .table-dark thead th,
    .table-dark tbody + tbody {
        border-color: #95999c;
    }
    
    .table-hover .table-dark:hover {
        background-color: #b9bbbe;
    }
    
    .table-hover .table-dark:hover > td,
    .table-hover .table-dark:hover > th {
        background-color: #b9bbbe;
    }
    
    .table-active,
    .table-active > th,
    .table-active > td {
        background-color: rgba(0, 0, 0, 0.075);
    }
    
    .table-hover .table-active:hover {
        background-color: rgba(0, 0, 0, 0.075);
    }
    
    .table-hover .table-active:hover > td,
    .table-hover .table-active:hover > th {
        background-color: rgba(0, 0, 0, 0.075);
    }
    
    .table .thead-dark th {
        color: #fff;
        background-color: #343a40;
        border-color: #454d55;
    }
    
    .table .thead-light th {
        color: #495057;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
    
    .table-dark {
        color: #fff;
        background-color: #343a40;
    }
    
    .table-dark th,
    .table-dark td,
    .table-dark thead th {
        border-color: #454d55;
    }
    
    .table-dark.table-bordered {
        border: 0;
    }
    
    .table-dark.table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(255, 255, 255, 0.05);
    }
    
    .table-dark.table-hover tbody tr:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.075);
    }
    
    @media (max-width: 575.98px) {
        .table-responsive-sm {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        }
        .table-responsive-sm > .table-bordered {
        border: 0;
        }
    }
    
    @media (max-width: 767.98px) {
        .table-responsive-md {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        }
        .table-responsive-md > .table-bordered {
        border: 0;
        }
    }
    
    @media (max-width: 991.98px) {
        .table-responsive-lg {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        }
        .table-responsive-lg > .table-bordered {
        border: 0;
        }
    }
    
    @media (max-width: 1199.98px) {
        .table-responsive-xl {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        }
        .table-responsive-xl > .table-bordered {
        border: 0;
        }
    }
    
    .table-responsive {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .table-responsive > .table-bordered {
        border: 0;
    }

    .no-border * {
        border: none !important;
        border-color: rgba(0, 0, 0, 0) !important;
    }

    .text-left * {
        text-align: left
    }
</style>
<body>
    <div id="app">
        <div class="col-12 py-5"></div>
        <div class="container-fluid">
            <div class="row">
                <div style="display:flex;width:100% ">
                    <table class="table text-left no-border letras-table-xl">
                        <thead>
                            <tr>
                                <th><img src="{{$empresa->foto}}" style="width: 100px"></th>
                                <th>
                                    <tr>
                                        <th>EMPRESA : {{$empresa->nombre}}<th>
                                    </tr>
                                    <tr>
                                        <th>NUMERACION : {{$numeracion}}</th>
                                    </tr>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if ($liquidaciondetalle->servicio == 'cajachica')
                    <h1>REPORTE - CAJA CHICA</h1>
                    @else
                    <h1>REPORTE - PAGOS A RENDIR</h1>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table>
                        <tbody>
                            <tr><td class="col-4 text-left">Usuario                </td><td class="col-8 text-left">: {{ $user->name }}</td></tr>
                            <tr><td class="col-4 text-left">Fecha de envio         </td><td class="col-8 text-left">: {{ $date }}</td></tr>
                            <tr><td class="col-4 text-left">Aprobador              </td><td class="col-8 text-left">: {{ $aprobador->nombre }} {{ $aprobador->apellido }} / Telefono: {{ $aprobador->telefono }}</td></tr>
                            <tr><td class="col-4 text-left">Motivo                 </td><td class="col-8 text-left">: {{ $liquidaciondetalle->motivo }}</td></tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <hr>
                <div class="col-12 py-4">
                    <table class="table table-bordered letras-table">
                        <thead>
                            <tr><th>Fecha</th><th>RUC</th><th>TD</th><th>DOCUMENTO</th><th>CONCEPTO</th><th>CENTO COSTOS</th><th>MONEDA</th><th>BASE</th><th>IGV</th><th>TOTAL</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                                <tr>
                                    <td>{{ $data->fecha }}</td>
                                    <td>{{ $data->ruc }}</td>
                                    <td>{{ $data->ctipodocumento }}</td>
                                    <td>{{ $data->codigodocumento }}-{{ $data->documento }}</td>
                                    <td>{{ $data->concepto }}</td>
                                    <td>{{ $data->ccentrocosto }}</td>
                                    <td>{{ $data->cmoneda }}</td>
                                    <td>{{ $data->base }}</td>
                                    <td>{{ $data->igv }}</td>
                                    <td>{{ $data->monto }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table letras-table no-border">
                        <tbody>
                            <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>TOTAL LIQUIDADO</td><td>: {{$liquidaciondetalle->liquidacion}}</td></tr>
                        </tbody>
                    </table>
                    <hr>
                    <table class="table letras-table no-border">
                        <tbody>
                            @if ($liquidaciondetalle->servicio == 'cajachica')
                            <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>MONTO CAJA CHICA</td><td>: {{$liquidaciondetalle->monto}}</td></tr>
                            @else
                            <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>MONTO ENTREGADO</td><td>: {{$liquidaciondetalle->monto}}</td></tr>
                            @endif
                            <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>MONTO LIQUIDADO</td><td>: {{$liquidaciondetalle->liquidacion}}</td></tr>
                            <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>DIFERENCIA</td><td>: {{$liquidaciondetalle->neto}}</td></tr>
                            @if ($liquidaciondetalle->neto < 0)
                            <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>SALDO A FAVOR</td><td>: {{ -$liquidaciondetalle->neto}}</td></tr>
                            @else
                            <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>MONTO A DEPOSITAR</td><td>: {{$liquidaciondetalle->neto}}</td></tr>
                            @endif
                        </tbody>
                    </table>
                    <hr>
                    <table class="table letras-table no-border">
                        <tbody>
                            @if ($liquidaciondetalle->neto < 0)
                            <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>SALDO A FAVOR</td><td>: {{ -$liquidaciondetalle->neto}}</td></tr>
                            @else
                            <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>MONTO A DEPOSITAR</td><td>: {{$liquidaciondetalle->neto}}</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <br>
            <div style="width: 100%;">
                <div style="float:left;width: 20%"></div>
                <div style="float:left;width: 20%;text-align:center">
                    <hr>
                    Firma y documento de identidad
                </div>
                <div style="float:left;width: 20%"></div>
                <div style="float:left;width: 20%;text-align:center">
                    <hr>
                    Firma y documento de identidad
                </div>
                <div style="float:left;width: 20%"></div>
            </div>
        </div>
        <div class="col-12 py-5"></div>
    </div>
</body>
</html>
