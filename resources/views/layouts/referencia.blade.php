<form id="formreferencia" class="text-left">
<input id="uso_id_general" type="hidden" name="iduso" value="{{ $uso->id }}">
    <p class="p-0 m-0">Referencia actual de la operacion : <strong id="referenciaactual">{{ $uso->referencia }}</strong></p>
    <div class="col-6 d-flex px-0">
        <div class="col-8 d-flex flex-center px-0 pr-1 pt-1">
            <input name="referencia" class="form-control form-control-sm" type="text">
        </div>
        <div class="col-4 d-flex flex-center px-0 pt-0">
            <input type="submit" value="Cambiar" class="btn btn-sm btn-primary">
        </div>
    </div>                 
</form>
<script>
setview('#formreferencia','#ref_container','/titulo/referencia')
</script>