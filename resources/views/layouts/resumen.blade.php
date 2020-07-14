<div class="col-12 px-0 py-3">
    <form id="form-historico">
        <div class="input-group">
            <select class="custom-select" name="historico">
                <option selected>-- Historico --</option>
                @foreach ($historico as $historico)
                <option value="{{ $historico->id }}">{{ $historico->id }}-{{ $historico->referencia }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">USAR</button>
            </div>
        </div>
    </form>
</div>