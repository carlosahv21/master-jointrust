<div wire:ignore>
    <h6 class="mb-4">Indicanos cual es tu direccion y te asignaremos un domicilio correspondiente <a href="#" class="text-info me-3" data-bs-toggle="tooltip" data-bs-placement="right" title="Si tienes dudas sobre tu domicilio, puedes contactarte con nosotros para realizar el ajuste.">
        <i class="fas fa-info-circle"></i></a>
    </h6>
    <input wire:model="useAddress" id="useAddress" type="hidden">
    <div class="flex py-2">
        <label for="inputDeliveryAddress">Dirección de entrega</label>
        <input wire:model.ignore="address" type="text" class="form-control" placeholder="Direccion completa que incluya nombre edificio o conjunto" id="inputAddress">
            @if ($errors->has('address'))
                <div class="invalid-feedback">
                    {{ $errors->first('address') }}
                </div>
            @endif
    </div>
    <div class="d-flex justify-content-end py-4">
        <button wire:click="save" class="btn btn-secondary">Agregar</button>
        <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
    </div>
</div>
