<form id="formcoeficiente">
    <input type="hidden" name="uso_id" value="{{$uso->id}}">
    <table class="table table-responsive table-bordered">
        <thead class="bg-primary">
            <tr>
                <th>DETERMINACION DE INGRESOS</th>
                <th>CASILLA</th>
                <th>PDT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Ventas Netas</td>
                <td><input type="number" step="0.01" name="nroventaneta" id="coeficientenroventaneta" class="form-control" value="{{$coeficiente->NroVentasNetas}}"></td>
                <td><input type="number" step="0.01" name="ventaneta" id="coeficienteventaneta" class="form-control" value="{{$coeficiente->VentasNetas}}"></td>
            </tr>
            <tr>
                <td>Ingresos Financieros gravados</td>
                <td><input type="number" step="0.01" name="nroingresosfiancierosgravados" id="coeficientenroingresosfiancierosgravados" class="form-control" value="{{$coeficiente->NroIngresosFinancierosGravados}}"></td>
                <td><input type="number" step="0.01" name="ingresosfiancierosgravados" id="coeficienteingresosfiancierosgravados" class="form-control" value="{{$coeficiente->IngresosFinancierosGravados}}"></td>
            </tr>
            <tr>
                <td>Otros Ingresos gravados</td>
                <td><input type="number" step="0.01" name="nroingresosgravados" id="coeficientenroingresosgravados" class="form-control" value="{{$coeficiente->NroOtrosIngresosGravados}}"></td>
                <td><input type="number" step="0.01" name="ingresosgravados" id="coeficienteingresosgravados" class="form-control" value="{{$coeficiente->OtrosIngresosGravados}}"></td>
            </tr>
            <tr>
                <td>Otros Ingresos no gravados</td>
                <td><input type="number" step="0.01" name="nroingresosnogravados" id="coeficientenroingresosnogravados" class="form-control" value="{{$coeficiente->NroOtrosIngresosNoGravados}}"></td>
                <td><input type="number" step="0.01" name="ingresosnogravados" id="coeficienteingresosnogravados" class="form-control" value="{{$coeficiente->OtrosIngresosNoGravados}}"></td>
            </tr>
            <tr>
                <td>Enajenación de valores y bienes del AF</td>
                <td><input type="number" step="0.01" name="nroenajenacion" id="coeficientenroenajenacion" class="form-control" value="{{$coeficiente->NroEnajenaciónValoresBienesAF}}"></td>
                <td><input type="number" step="0.01" name="enajenacion" id="coeficienteenajenacion" class="form-control" value="{{$coeficiente->EnajenaciónValoresBienesAF}}"></td>
            </tr>
            <tr>
                <td>REI del ejercicio</td>
                <td><input type="number" step="0.01" name="nrorei" id="coeficientenrorei" class="form-control" value="{{$coeficiente->NroREI}}"></td>
                <td><input type="number" step="0.01" name="rei" id="coeficienterei" class="form-control" value="{{$coeficiente->REI}}"></td>
            </tr>
            <tr class="bg-info">
                <td><strong>Total Ingresos Netos</strong></td>
                <td></td>
                <td><input type="number" step="0.01" name="totalneto" id="coeficientetotalneto" class="form-control" value="{{$coeficiente->TotalIngresosNetos}}" ></td>
            </tr>
            <tr class="bg-danger">
                <td><strong class="color-danger">(-) Menos</strong></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Ingresos por diferencia de cambio</td>
                <td></td>
                <td><input type="number" step="0.01" name="ingresosdiferenciacambio" id="coeficienteingresosdiferenciacambio" class="form-control" value="{{$coeficiente->IngresoDiferenciaCambio}}"></td>
            </tr>
            <tr class="bg-info">
                <td><strong>Ingresos Netos</strong></td>
                <td></td>
                <td><input type="number" step="0.01" name="ingresosnetos" id="coeficienteingresosnetos" class="form-control" value="{{$coeficiente->IngresosNetos}}" ></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="bg-info">
                <td><strong>Impuesto calculado</strong></td>
                <td><input type="number" step="0.01" name="nroimpuestocalculado" id="coeficientenroimpuestocalculado" class="form-control" value="{{$coeficiente->NroImpuestoCalculado}}"></td>
                <td><input type="number" step="0.01" name="impuestocalculado" id="coeficienteimpuestocalculado" class="form-control" value="{{$coeficiente->ImpuestoCalculado}}" ></td>
            </tr>
            <tr class="bg-info">
                <td><strong>Coeficiente</strong></td>
                <td></td>
                <td><input type="number" step="0.01" name="coeficiente" id="coeficiente" class="form-control" value="{{$coeficiente->Coeficiente}}" ></td>
            </tr>
            <tr class="bg-info">
                <td><strong>Coeficiente final</strong></td>
                <td></td>
                <td><input type="number" step="0.01" name="coeficientefinal" id="coeficientefinal" class="form-control" value="{{$coeficiente->CoeficienteFinal}}" ></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="bg-info">
                <td><strong>Comparacion de coeficiente</strong></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="bg-info">
                <td><strong>Coeficiente SUNAT</strong></td>
                <td></td>
                <td><input type="number" step="0.01" name="coeficientesunat" id="coeficientesunat" class="form-control" value="{{$coeficiente->CoeficienteSUNAT}}" ></td>
            </tr>
            <tr class="bg-info">
                <td><strong>Coeficiente PDT</strong></td>
                <td></td>
                <td><input type="number" step="0.01" name="coeficientepdt" id="coeficientepdt" class="form-control" value="{{$coeficiente->CoeficientePDT}}" ></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="bg-info">
                <td><strong>Coeficiente a usar</strong></td>
                <td></td>
                <td><input type="number" step="0.01" name="coeficientedefinitivo" id="coeficientedefinitivo" class="form-control" value="{{$coeficiente->CoeficienteDefinitivo}}" ></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <input type="submit" value="GUARDAR CALCULO" class="btn btn-success">
                </td>
            </tr>
        </tfoot>
    </table>
</form>
<script>
    var xxeee = document.querySelector('#formcoeficiente');
    var xxeef = xxeee.querySelectorAll('input');
    for (let index = 0; index < xxeef.length; index++) {
        const element = xxeef[index];
        element.addEventListener("input", () => { calcularcoeficiente() });
    }
    function confirmar666(data){
        show_alert_now("Se guardo coeficiente");
        console.log(data);
    }
    setviewcall('#formcoeficiente','#divcoeficiente','/Reporte/Ventas/Coeficiente',confirmar666);
</script>