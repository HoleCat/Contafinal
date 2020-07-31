@include('herramientas.sidebar.tool')
<div class="col-12">
    @include('layouts.uso')
    @include('layouts.resumen')
    <div class="col-12 text-center">
        <h3 class="py-3">IMPORTACION DE FACTURAS ELECTRONICAS</h1>
    </div>
    <div class="jumbotron col-12 text-left py-3">
        <h5>1. Importar archivo</h5>
        <form id="formcargaxml" enctype="multipart/form-data">
        <input type="hidden" name="uso_id" value="{{$uso->id}}" id="uso_id">
            <div class="col-12 d-flex px-0 flex-wrap">
                <div class="col-xl-6 col-md-7 col-sm-8 col-xs-10 pl-0">
                    <div class="form-group">
                        <label>NOMBRE PARA EL ARCHIVO</label>
                        <input type="text" class="form-control" name="nombrearchivo">
                    </div>
                    <div class="custom-file px-1">
                        <input id="xmlfile" type="file" multiple name="myfile[]" id="xml" class="form-control">
                        <label id="xmllabel" class="custom-file-label" for="xmlfile"></label>
                    </div>
                </div>
                <div class="col-xs-2 text-center" id="cargaxmlfile">
                    
                </div>
                <div class="pl-0 py-3 col-xl-12 col-md-12 col-sm-12 col-xs-12" id="xmllist">
                    
                </div>
            </div>
            <div class="col-12 text-left px-0 py-3">
                <div class="form-group">
                    <input type="submit" value="IMPORTAR" class="btn btn-success btn-send">
                </div>
            </div>
        </form>
    </div>
    <div class="jumbotron col-12 text-left py-3">
        <h5>2. Data</h5>
        <div class="row">
            <div class="col-xl-9 col-md-8 col-sm-12 col-xs-12">
                <div class="w-100 grid-result">

                </div>  
            </div>
        </div>
    </div>
    <div class="jumbotron col-12 text-left py-3">
        <h5>3. Guardar data de tabla</h5>
        <form id="formguardardataxml" class="my-3">
            <input type="hidden" name="uso_id" value="{{$uso->id}}">
            <button type="submit" id="btn-exportar-mayorcompras" class="btn btn-warning">Guardar data mostrada</button>
        </form>
        <h5>4. Exportar resultado</h5>
        <form action="/Xml/Exportar" method="GET">
            <input type="hidden" name="uso_id" value="{{$uso->id}}">
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
            <button type="submit" id="btn-exportar-mayorcompras" class="btn btn-warning">Exportar en excel</button>
        </form>
    </div>
    <script type="text/javascript" src="{{ asset('assets/js/proyecto/xml/xml.js')}}"></script>
</div>