<div class="col-12">
    <form id="formeliminardata" class="text-center">
        <input type="hidden" name="iduso" value="{{$uso->id}}">
        <div class="col-12 d-flex flex-wrap  text-left">
            <label class="col-12">Elimina data de uno de tus archivos :</label>
            <div class="col-6">
                <select class="custom-select" name="id_archivo" id="usoarchivoselect">
                    <option selected>-- Seleccion --</option>
                    @foreach ($archivos as $archivos)
                    <option value="{{ $archivos->id }}">{{ $archivos->id }}-{{ $archivos->ruta }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <div class="form-group text-left d-flex">
                    <input type="submit" class="btn btn-danger" value="ELIMINAR DATA">
                    <div class="ml-1" id="cargaeliminardata">
                        
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>

</script>