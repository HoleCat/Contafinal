@include('herramientas.sidebar.tool2')
<div class="col-12">
    @include('layouts.uso')
    @include('layouts.resumen')
    <div class="col-12 text-center">
        <h3 class="py-3">PAGOS A RENDIR</h1>
    </div>
    <div class="col-12">
        <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12">
            <form id="formrendirpago">
                <input type="hidden" id="liquidaciondetalle_id" name="liquidaciondetalle_id" value="{{ $liquidacion->id }}">
                <div class="col-12 d-flex flex-wrap px-0">
                    <div class="col-xl-4 col-md-4 col-sm-6 col-xs-12 px-1">
                        <div class="form-group my-1">
                            <label>RUC |<a onclick="validarsunat('#rucrendirpago','#validador-ruc')" class="btn btn-primary"><i class="fas fa-user-secret"></i></a>|<a onclick="validarcomprobantes('#rucrendirpago','')" class="btn btn-warning"><i class="fab fa-audible"></i></a></label>
                            <input oninput="validacionunitariabasica('#rucrendirpago','#validador-ruc',8,15)" id="rucrendirpago" name="ruc" class="form-control" type="number">
                            <small id="validador-ruc" class="text-danger fade">Campo obligatorio</small>
                        </div>
                        <div class="form-group my-0">
                            <label>TIPO DOCUMENTO</label>
                            <select name="tipodocumento" class="custom-select">
                                <option selected>seleccione..</option>
                                @foreach ($documentos as $documentos)
                                <option value="{{ $documentos->id }}">{{ $documentos->codigo }} {{ $documentos->descripcion }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger fade">Campo obligatorio</small>
                        </div>
                        <div class="form-group my-0">
                            <label >SERIE - N° DOCUMENTO</label>
                            <div class="col-12 d-flex flex-wrap px-0">
                                <div class="col-6 px-0">
                                    <input oninput="validacionunitariabasica('#codigodocumentorendirpago','#validador-nrodocumento',3,5)" id="codigodocumentorendirpago" placeholder="F001" name="codigodocumento" class="form-control" type="text">
                                </div>
                                <div class="col-6 px-0">
                                    <input oninput="validacionunitariabasica('#numerodocumentorendirpago','#validador-nrodocumento',3,12)" id="numerodocumentorendirpago" placeholder="00000001" name="documento" class="form-control" type="number">
                                </div>
                            </div>
                            <small class="text-danger fade" id="validador-nrodocumento">Campo obligatorio</small>
                        </div>
                        <div class="form-group my-0">
                            <label>FECHA</label>
                            <input id="fecharendirpago" name="fecha" class="form-control" type="date">
                            <small class="text-danger fade">Campo obligatorio</small>
                        </div>
                        <div class="form-group my-0">
                            <label>CONCEPTO</label>
                            <input oninput="validacionunitariabasica('#conceptorendirpago','#validador-concepto',0,100)" id="conceptorendirpago" name="concepto" class="form-control" type="text">      
                            <small class="text-danger fade" id="validador-concepto">Campo obligatorio</small>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-6 col-xs-12 px-1">
                        <div class="form-group my-3">
                            
                            
                            <div class="form-group text-left" id="cambio_div">
                                <label>MONEDA </label>
                                <button class="my-2 btn btn-success" onclick="validartipodecambio('#fecharendirpago','#tipocambiorendirpago')"><i class="fas fa-dollar-sign"></i></button>
                                <small class="text-primary">primero una fecha</small>
                            </div>
                            <select id="select_cambio" name="moneda" class="custom-select">
                                <option selected>seleccione..</option>
                                @foreach ($monedas as $monedas)
                                <option value="{{ $monedas->id }}">{{ $monedas->descripcion }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger fade">Campo obligatorio</small>
                            <label id="tipocambiorendirpago"></label>
                            <div class="form-group" id="cambio_div">
                                <label>COMPRA :</label>
                                <input min="0.00" step="0.001" value="0.0" placeholder="compra" type="number" id="compra_var" name="compra" class="form-control">
                                <label>VENTA :</label>
                                <input min="0.00" step="0.001" value="0.0" placeholder="venta" type="number" id="venta_var" name="venta" class="form-control">
                            </div>                            
                        </div>
                        <div class="form-group my-0">
                            <label>CONTABILIDAD</label>
                            <select name="contabilidad" class="custom-select">
                                <option selected>seleccione..</option>
                                @foreach ($codigocontable as $codigo)
                                <option value="{{ $codigo->id }}">{{ $codigo->descripcion }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger fade">Campo obligatorio</small>
                        </div>
                        <div class="form-group my-0">
                            <label>CENTRO COSTO</label>
                            <select name="centrocosto" class="custom-select">
                                <option selected>seleccione..</option>
                                @foreach ($centrocostos as $centrocostos)
                                <option value="{{ $centrocostos->id }}">{{ $centrocostos->descripcion }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger fade">Campo obligatorio</small>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 px-1 my-3">
                        <div class="form-group my-0">
                            <label>MONTO</label>
                            <input name="monto" class="form-control" type="number">      
                            <small class="text-danger fade">Campo obligatorio</small>
                        </div>
                        <div class="form-check">
                            <input name="igv" class="form-check-input" type="checkbox">
                            <label for="form-check-label">CON IGV</label>
                        </div>
                        <div class="col-12" id="rendirpagototales">
                            
                        </div>
                        <div class="col-12 text-center py-3">
                            <input type="submit" class="btn btn-primary" value="ACEPTAR">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="modal-comprobantes" tabindex="-1" role="dialog" aria-labelledby="modal-comprobantes-titulo" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-comprobantes-titulo">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>
                </div>
            </div>
        </div>
        <div class="jumbotron col-12 text-left py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalexportarcaja">
                Iniciar exportacion
            </button>
            @extends('modules.caja.modalexportar')
    
            @section('content')
            <form action="/Caja/rendirpago/Exportar">
                <div class="col-12 mx-auto">
                    <div class="form-group">
                        <label>CODIGO DEL DOCUMENTO</label>
                        <input class="form-control" type="mail" name="codigo" placeholder="NRO COD">
                    </div>
                    <div class="form-group">
                        <label>DESTINATARIO</label>
                        <input class="form-control" type="mail" name="correo" placeholder="CORREO">
                    </div>
                    <div class="form-group">
                        <label>ASUNTO</label>
                        <input class="form-control" type="text" name="asunto" placeholder="ASUNTO">
                    </div>
                    <div class="form-group">
                        <label>SISTEMA CONTABLE</label>
                        <select name="sistema" class="custom-select">
                            <option selected>seleccione..</option>
                            @foreach ($sistemas as $sistemas)
                            <option value="{{ $sistemas->id }}">{{ $sistemas->codigo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-right">
                        <input type="hidden" name="uso_id" value="{{ $uso->id }}">
                        <input class="btn btn-success" type="submit" value="EXPORTAR">
                        <div class="form-check">
                            <input name="mail" class="form-check-input" type="checkbox">
                            <label for="form-check-label">enviar mail</label>
                        </div>
                    </div>
                </div>
            </form>
            @endsection
        </div>
        <div id="divtablarendirpago" class="col-12">
            
        </div>
        <script type="text/javascript" src="{{ asset('assets/js/proyecto/caja/rendirpago/rendirpago.js')}}"></script>
    </div>
</div>