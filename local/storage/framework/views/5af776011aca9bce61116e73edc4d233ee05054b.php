<div>
    <div class="row align-items-start p-2">
        <div class="col-12 p-2">
            <label for="inputZona" class="form-label">Nombre de la Zona <span class="text-danger"> *</span></label>
            <input wire:model.defer="zone" type="text" class="form-control" placeholder="Ej: Zona 1" id="inputZona">
            <?php if($errors->has('zone')): ?>
                <div class="invalid-feedback">
                    <?php echo e($errors->first('zone')); ?>

                </div>
            <?php endif; ?>
        </div>
        <div class="col-12 p-2">
            <label for="inputValor" class="form-label">Valor <span class="text-danger"> *</span></label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input wire:model="value" type="text" class="form-control" placeholder="Ej: 100000" id="inputValor">
              </div>
            <?php if($errors->has('value')): ?>
                <div class="invalid-feedback">
                    <?php echo e($errors->first('value')); ?>

                </div>
            <?php endif; ?>
        </div>
        <div class="col-12 p-2">
            <label for="inputDescription" class="form-label">Descripci&oacute;n <span class="text-danger"> *</span></label>
            <textarea wire:model.defer="description" style="resize: none;" id="inputDescription" class="form-control"></textarea>
            <?php if($errors->has('description')): ?>
                <div class="invalid-feedback">
                    <?php echo e($errors->first('description')); ?>

                </div>
            <?php endif; ?>
        </div>
        <div class="d-flex justify-content-end py-4">
            <button wire:click="save" class="btn btn-secondary">Guardar</button>
            <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
        </div>
    </div>
</div>
<?php /**PATH /Users/usuario/Sites/app_laravel_subir/local/resources/views/livewire/shipping-form.blade.php ENDPATH**/ ?>