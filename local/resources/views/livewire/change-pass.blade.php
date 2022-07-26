<div>
    <div class="row align-items-start p-2">
        <div class="col-12 p-2">
            <label for="password" class="form-label">Nueva contraseña</label>
            <input wire:model="password" type="text" class="form-control" id="password">
            @if ($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>
        @if (!empty($this->password))
            <div class="col-12 p-2">
                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                <input wire:model="password_confirmation" type="text" class="form-control" id="password_confirmation">
                @if ($errors->has('password_confirmation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                @endif
            </div>
            <div class="col-12 p-2">
                <label for="current_password" class="form-label">Contraseña</label>
                <input wire:model="current_password" type="text" class="form-control" id="current_password">
                @if ($errors->has('current_password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('current_password') }}
                    </div>
                @endif
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-end py-4">
        <button wire:click="save" class="btn btn-secondary">Guardar</button>
        <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
    </div>
</div>
