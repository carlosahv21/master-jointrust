<div>
    <div class="row align-items-start p-2">
        <div class="col-12 p-2">
            <label for="password" class="form-label">Nueva contraseña</label>
            <input wire:model="password" type="text" class="form-control" id="password">
            <?php if($errors->has('password')): ?>
                <div class="invalid-feedback">
                    <?php echo e($errors->first('password')); ?>

                </div>
            <?php endif; ?>
        </div>
        <?php if(!empty($this->password)): ?>
            <div class="col-12 p-2">
                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                <input wire:model="password_confirmation" type="text" class="form-control" id="password_confirmation">
                <?php if($errors->has('password_confirmation')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('password_confirmation')); ?>

                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 p-2">
                <label for="current_password" class="form-label">Contraseña</label>
                <input wire:model="current_password" type="text" class="form-control" id="current_password">
                <?php if($errors->has('current_password')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('current_password')); ?>

                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="d-flex justify-content-end py-4">
        <button wire:click="save" class="btn btn-secondary">Guardar</button>
        <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
    </div>
</div>
<?php /**PATH /Users/usuario/Sites/app_laravel_subir/local/resources/views/livewire/change-pass.blade.php ENDPATH**/ ?>