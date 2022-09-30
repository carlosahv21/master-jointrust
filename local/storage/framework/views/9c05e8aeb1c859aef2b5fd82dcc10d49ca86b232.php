<div>
    <h6 class="mb-4">Tengo un amig@ que le puede interesar los productos Join Trust</h6>
    <?php $__currentLoopData = $inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row pt-1">
            <div class="col-6">
                <label for="input_<?php echo e($key); ?>_guest_name" class="form-label">Nombre completo</label>
                <input type="text" id="input_<?php echo e($key); ?>_guest_name" wire:model.defer="inputs.<?php echo e($key); ?>.guest_name" class="form-control">
                <?php $__errorArgs = ['inputs.'.$key.'.guest_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                    <div class="invalid-feedback">
                        <?php echo e($message); ?>

                    </div>    
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-5">
                <label for="input_<?php echo e($key); ?>_guest_phone" class="form-label">Celular</label>
                <input type="text" id="input_<?php echo e($key); ?>_guest_phone" wire:model.defer="inputs.<?php echo e($key); ?>.guest_phone" class="form-control">
                <?php $__errorArgs = ['inputs.'.$key.'.guest_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                    <div class="invalid-feedback">
                        <?php echo e($message); ?>

                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-1">
                <div wire:click="removeInput(<?php echo e($key); ?>)" class="flex items-center justify-end text-red-600 text-sm w-full cursor-pointer" style="top: 55%;position: relative;">
                    <a class="item-delete text-danger"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="flex text-center justify-center py-4">
        <a wire:click="addInput" class="text-secondary"> <i class="fas fa-cart-plus"></i> Agregar otro amigo </a>
    </div>
    <div class="row">
        <span class="small text-secondary mt-3" style="font-size: 0.75em;"> * Recuerda avisarle a tus amig@s que los vamos a contactar, no queremos incomodarl@s. Entre más referidos nos des, más beneficios recibes.</span>
    </div>
    <div class="d-flex justify-content-end py-4">
        <button wire:click="save" class="btn btn-secondary">Enviar amigos</button>
        <button wire:click="skip" type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
    </div>
</div>
<?php /**PATH /Users/usuario/Sites/app_laravel_subir/local/resources/views/livewire/guests.blade.php ENDPATH**/ ?>