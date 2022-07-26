<div>
    <div class="row align-items-start p-2">
        <div class="col-12 p-2">
            <label for="inputNombre" class="form-label">Nombre <span class="text-danger"> *</span></label>
            <input wire:model.defer="name" type="text" class="form-control" placeholder="Ej: Cesta" id="inputNombre">
            @if ($errors->has('first_name'))
                <div class="invalid-feedback">
                    {{ $errors->first('first_name') }}
                </div>
            @endif
        </div>
        <div class="col-12 p-2">
            <label for="inputValor" class="form-label">Valor <span class="text-danger"> *</span></label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input wire:model="value" type="text" class="form-control" placeholder="Ej: 100000" id="inputValor">
              </div>
            @if ($errors->has('value'))
                <div class="invalid-feedback">
                    {{ $errors->first('value') }}
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-end py-4">
            <button wire:click="save" class="btn btn-secondary">Guardar</button>
            <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
        </div>
    </div>
</div>
