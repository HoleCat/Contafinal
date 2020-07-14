@include('herramientas.sidebar.tool')
<div class="col-12">
    @include('layouts.uso')
    <div class="col-12 text-center">
        <h3 class="py-3">IMPORTACION DE BALANCE</h1>
    </div>
    <div class="jumbotron col-12 text-left py-3">
        <h5>1. Importar archivo</h5>
        <form id="formcargabalance" enctype="multipart/form-data">
            <input type="hidden" name="iduso" value="{{$uso->id}}">
            <div class="col-12 d-flex px-0">
                <div class="col-xl-6 col-md-7 col-sm-8 col-xs-10 pl-0">
                    <div class="form-group">
                        <label>NOMBRE PARA EL ARCHIVO</label>
                        <input type="text" class="form-control" name="nombrearchivo">
                    </div>
                    <div class="form-group">
                        <input placeholder="DELIMITARDOR (CSV)" type="text" class="form-control" name="delimitador">
                    </div>
                    <div class="custom-file px-1">
                        <input type="file" class="custom-file-input" id="balancefile" name="myfile">
                        <label id="balancelabel" class="custom-file-label" for="balancefile"></label>
                    </div>
                </div>
                <div class="col-xs-2 text-center" id="cargabalancefile">
                    
                </div>
            </div>
            <div class="col-12 text-left px-0 py-3">
                <div class="form-group">
                    <input type="submit" value="IMPORTAR" class="btn btn-success">
                </div>
            </div>
        </form>
    </div>
    <div class="jumbotron col-12 text-left py-3">
        <h5>2. Exportar </h5>
        <form action="/Balance/Exportar" method="GET">
            <div class="px-0 col-xl-6 col-md-6 col-sm-8 col-xs-12">
                <div class="form-group">
                    <input class="form-control" type="text" name="empresa" placeholder="EMPRESA">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="ruc" placeholder="RUC">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="periodo" placeholder="PERIODO">
                </div>
            </div>
            <button type="submit" id="btn-exportar-mayorbalance" class="btn btn-warning">Exportar en excel</button>
        </form>
    </div>
    <script type="text/javascript" src="{{ asset('assets/js/proyecto/balance/balance.js')}}"></script>
</div>