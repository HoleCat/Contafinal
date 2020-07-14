@include('herramientas.sidebar.tool')
<div class="pt-3 col-xl-10 col-md-10 col-sm-10 col-xs-11 mx-auto">
    @include('layouts.uso')
    @include('layouts.resumen')
    <div class="col-12 text-center">
        <h3 class="py-3">NUEVA LIQUIDACIÓN</h1>
    </div>
    <div class="col-12">
        <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12">
            <form id="formliquidacion">
                <input type="hidden" name="iduso" value="{{ $uso->id }}">
                <div class="mx-auto col-xl-8 col-md-9 col-sm-10 col-xs-12 d-flex flex-wrap px-0">
                    <div class="col-xl-6 col-md-6 col-sm-6 col-xs-12 px-1">
                        <div class="form-group my-0">
                            <label>LIQUIDACIÓN</label>
                            <select name="servicio" class="custom-select">
                                <option selected>-- Seleccion --</option>
                                <option value="cajachica">CAJA CHICA</option>
                                <option value="rendirpago">ENTREGA A RENDIR</option>
                            </select>
                            <small class="text-danger fade">Campo obligatorio</small>
                        </div>
                        <div class="form-group my-0">
                            <label>APROBADOR</label>
                            <select name="aprobador_id" class="custom-select">
                                <option selected>-- Seleccion --</option>
                                @foreach ($aprobadores as $aprobador)
                                <option value="{{ $aprobador->id }}">{{ $aprobador->nombre }} {{ $aprobador->apellido }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger fade">Campo obligatorio</small>
                        </div>
                        <div class="form-group my-0">
                            <label>MOTIVO</label>    
                            <input name="motivo" class="form-control" type="text">
                            <small class="text-danger fade">Campo obligatorio</small>
                        </div>
                        <div class="form-group my-0">
                            <label>DETALLE</label>
                            <textarea name="detalle" type="text" class="form-control" cols="30" rows="5"></textarea>
                            <small class="text-danger fade">Campo obligatorio</small>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-6 col-xs-12 px-1">
                        <div class="form-group my-0">
                            <label>MONTO ENTREGADO</label>
                            <input name="monto" class="form-control" type="number">      
                            <small class="text-danger fade">Campo obligatorio</small>
                        </div>
                        <div class="form-check">
                            <input name="multimoneda" class="form-check-input" type="checkbox">
                            <label for="form-check-label">OTRAS MONEDAS</label>
                        </div>
                        <div class="form-group my-0">
                            <label>TIEMPO DE LIQUIDACION (días)</label>
                            <input name="tiempo" class="form-control" type="number">      
                            <small class="text-danger fade">Campo obligatorio</small>
                        </div>
                    </div>
                    <div class="col-12 text-center py-3 px-0">
                        <input class="btn btn-success" type="submit" value="ACEPTAR">
                    </div>
                </div>
            </form>
        </div>
        <script type="text/javascript" src="{{ asset('assets/js/proyecto/caja/liquidacion.js')}}"></script>
    </div>
</div>