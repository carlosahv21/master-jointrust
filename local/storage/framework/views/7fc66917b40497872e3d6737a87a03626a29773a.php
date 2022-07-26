<?php $__env->startSection('title','Agregar Pedido'); ?>

<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <span class="fas fa-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Jointrust</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Agregar Pedido</li>
                </ol>
            </nav>
        </div>
    </div>

    <div>

        <div class="card border-0 shadow my-4">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8 col-xxl-6">
                    <div wire:ignore class="card-body row">
                        <div class="input-group me-2 me-lg-3">
                            <span class="input-group-text">
                                <span class="fas fa-search"></span>
                            </span>
                            <input wire:model="search" type="text" class="form-control" placeholder="Busca un producto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if($products->count()): ?>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-4">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <img src="<?php echo e(asset('local/public/images_products/'.$product->product_image)); ?>" class="card-img-top img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo e(strtoupper($product->name )); ?></h5>
                                        <small class="text-muted">Description</small>
                                        <div wire:ignore class="text-end" style="margin-top: 11%;">
                                            <a wire:click="addProduct(<?php echo e($product->id); ?>,'<?php echo e($product->name); ?>',<?php echo e($product->price); ?>, '<?php echo e($product->reference); ?>' )" class="text-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Agregar al pedido"> 
                                                <small>
                                                    <div class="icon-shape icon-xs icon-shape-secondary rounded">
                                                        <i class="fas fa-cart-plus"></i>
                                                    </div>
                                                </small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>               
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-12 my-4 text-center">
                    <h5 class="text-gray-500"><i class="fas fa-exclamation-triangle"></i> No hay produtos para mostrar</h5>
                </div>
            <?php endif; ?>
        </div>

        <div class="card border-0 table-wrapper table-responsive">
            <div>
                <table class="table product-table align-items-center" id='table-data'>
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th style="width: 20%;">Producto</th>
                            <th style="width: 10%">Cantidad</th>
                            <th style="width: 10%">Precio</th>
                            <th style="width: 10%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(Cart::instance('cart')->count() > 0): ?>
                            <?php $__currentLoopData = Cart::instance('cart')->content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="d-block">
                                            <span class="fw-bold"><?php echo e(strtoupper($item->name)); ?></span>
                                            <div class="small text-gray"><?php echo e($item->options->reference); ?> </div>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <button wire:click.ignore="decreaseQuantity('<?php echo e($item->rowId); ?>')" class="btn btn-outline-secondary" type="button"> <i class="fa fa-minus" aria-hidden="true"></i> </button>

                                            <input type="text" class="form-control" value="<?php echo e($item->qty); ?>" readonly>

                                            <button wire:click.ignore="increaseQuantity('<?php echo e($item->rowId); ?>')" class="btn btn-outline-secondary" type="button"> <i class="fa fa-plus" aria-hidden="true"></i> </button>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p> 
                                            <i class="fas fa-dollar-sign"></i>  <?php echo e(number_format($item->price,'2', ',', '.')); ?>

                                        </p>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-10 text-center">
                                                <p> 
                                                    <i class="fas fa-dollar-sign"></i> 
                                                    <span>
                                                        <?php echo e(number_format((float) $item->subtotal, '2', ',', '.')); ?>

                                                    </span>
                                                </p>
                                            </div>
                                            <div wire:click.prevent="removeProduct('<?php echo e($item->rowId); ?>')" class="col-2">
                                                <a class="item-delete text-danger"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <td colspan="4">
                                <div class="d-flex justify-content-center py-6">
                                    <span class="text-gray-500"><i class="fas fa-archive"></i> Aca mostraremos tus productos </span>
                                </div>
                            </td>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card border-0 shadow components-section my-4">
            <div class="row">
                <div class="col-6 my-4 mx-4">
                    <div class="mt-2">
                        <label for="textarea">Comentarios</label>
                        <textarea class="form-control textarea" placeholder="Cuéntanos si tienes alguna sugerencias o recomendación especial." rows="4"></textarea>
                    </div>
                    <div class="mt-4 row">
                        <div class="col-6">
                            <label for="textarea">Fecha de entrega</label>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group" wire:ignore.defer="date_order">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar-day"></i>
                                    </span>
                                    <input data-date-order="window.livewire.find('<?php echo e($_instance->id); ?>')" id="date_order" autocomplete="off" class="form-control datepicker" type="text" placeholder="dd/mm/yyyy">                                               
                                    <div id="dateOrderError" class="invalid-feedback" style="display:none">
                                        La fecha de entrega es requerida.
                                    </div>
                                </div>                                            
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 row">
                        <div class="col-6">
                            <label for="inputDeliveryAddress">Dirección de entrega</label>
                        </div>
                        <div class="col-6">
                            <input wire:model.defer="delivery_address" type="text" class="form-control" placeholder="Direccion completa que incluya nombre edificio o conjunto" id="inputDeliveryAddress">
                            <?php if($errors->has('delivery_address')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('delivery_address')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="mt-4 row">
                        <div class="col-6">
                            <label for="textarea">¿Desea incluir kit de regalo?</label>
                        </div>
                        <div class="col-6">
                            <div class="row text-center">
                                <div class="col-6">
                                    <input wire:model="gift_check" class="form-check-input" type="radio" name="gift_check" value="si"> Si
                                </div>
                                <div class="col-6">
                                    <input wire:model="gift_check"   class="form-check-input" type="radio" name="gift_check" value="no"> No
                                </div>
                                <br>
                                <br>
                                <div class="col-12">
                                <select wire:ignore.self wire:model="gift" class="form-select" style="display:none;" id="gift" >
                                        <option>Elegir</option>
                                        <?php $__currentLoopData = $gift_sets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gifts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($gifts->value); ?>"><?php echo e($gifts->name); ?> - $ <?php echo e(number_format( $gifts->value, '0', ',', '.')); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-4 d-flex justify-content-end mb-4 py-4">
                    <div class="mt-4">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">
                                        <i class="fas fa-dollar-sign"></i> <?php echo e(number_format((float) Cart::instance('cart')->subtotal(), '2', ',', '.')); ?>

                                    </td>
                                </tr>
                                <?php if($this->gift): ?>
                                    <tr>
                                        <td class="left">
                                            <strong>Kit de regalo</strong>
                                        </td>
                                        <td class="right">
                                            <i class="fas fa-dollar-sign"></i> <?php echo e(number_format((float)  $this->gift, '2', ',', '.')); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                    <?php if($this->gift): ?>
                                        <strong><i class="fas fa-dollar-sign"></i> <?php echo e(number_format((float) Cart::instance('cart')->subtotal() + 15000, '2', ',', '.')); ?></strong>
                                    <?php else: ?>
                                        <strong><i class="fas fa-dollar-sign"></i> <?php echo e(number_format((float) Cart::instance('cart')->total(), '2', ',', '.')); ?></strong>
                                    <?php endif; ?>   
                                    </td>
                                </tr>
                                <tr>
                                    <td class="right" colspan="2">
                                        <div class="mt-2">
                                            <p>¿Aceptarías recibir una entrega parcial de tu pedido?</p>
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <input wire:model="radioButtom" class="form-check-input" type="radio" name="delivery" value="si" > Si                
                                                </div>
                                                <div class="col-6">
                                                    <input wire:model="radioButtom" class="form-check-input" type="radio" name="delivery" value="no" > No
                                                </div>
                                            </div>
                                            <?php $__errorArgs = [$radioButtom];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                                            <div class="invalid-feedback text-center">
                                                <?php echo e($message); ?>

                                            </div>    
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="2">
                                        <button wire:click="cancel" type="button" class="btn btn-link text-gray-600">Cancelar</button>
                                        <button wire:click="resume" class="btn btn-secondary" >Hacer pedido</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </div>
<div>
<!-- Modal Cancel-->
<div wire:ignore.self class="modal fade" id="cancelOrder" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                ¡Estas a punto de cancelar tu pedido! ¿estas seguro?
            </div>
            <div class="modal-footer">
                <button wire:click="accept" type="button" class="btn btn-secondary">Aceptar</button>
                <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Resume-->
<div wire:ignore.self class="modal fade" id="resumeOrder" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Resumen de tu pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            <div class="modal-body text-center">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th style="width: 20%;">Producto</th>
                            <th style="width: 10%">Cantidad</th>
                            <th style="width: 10%">Precio</th>
                            <th style="width: 10%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = Cart::instance('cart')->content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center">
                                    <div class="d-block">
                                        <span class="fw-bold"><?php echo e(strtoupper($item->name)); ?></span>
                                        <div class="small text-gray"><?php echo e($item->options->reference); ?> </div>
                                    </div>
                                    
                                </td>
                                <td>
                                    <p> 
                                        <span class="fw-bold"><?php echo e($item->qty); ?></span>
                                    </p>
                                </td>
                                <td class="text-center">
                                    <p> 
                                        <i class="fas fa-dollar-sign"></i>  <?php echo e(number_format((float)$item->price,'2',',','.')); ?>

                                    </p>
                                </td>
                                <td>
                                    <p> 
                                        <i class="fas fa-dollar-sign"></i> <?php echo e(number_format((float)$item->subtotal,'2',',','.')); ?>


                                    </p>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end text-right">
                    <div class="mt-4">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">
                                        <i class="fas fa-dollar-sign"></i> <?php echo e(number_format((float) Cart::instance('cart')->subtotal(),'2',',','.')); ?>

                                    </td>
                                </tr>
                                <?php if($this->gift): ?>
                                    <tr>
                                        <td class="left">
                                            <strong>Kit de regalo</strong>
                                        </td>
                                        <td class="right">
                                            <i class="fas fa-dollar-sign"></i> <?php echo e(number_format((float)  $this->gift, '2', ',', '.')); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <?php if($this->gift): ?>
                                            <strong><i class="fas fa-dollar-sign"></i> <?php echo e(number_format((float) Cart::instance('cart')->subtotal() + 15000, '2', ',', '.')); ?></strong>
                                        <?php else: ?>
                                            <strong><i class="fas fa-dollar-sign"></i> <?php echo e(number_format((float) Cart::instance('cart')->total(), '2', ',', '.')); ?></strong>
                                        <?php endif; ?> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button wire:click="save" type="button" class="btn btn-secondary">Aceptar</button>
                <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Alert Different Date-->
<div wire:ignore.self class="modal fade" id="differentDate" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                Sr. (a) <?php echo e(auth()->user()->first_name .' '. auth()->user()->last_name); ?> su pedido queda programado con prioridad, sin embargo, dependemos de la cosecha diaria y en ocasiones el clima nos afecta. Le informaremos oportunamente cualquier novedad.
            </div>
            <div class="modal-footer">
                <button wire:click="acceptPopup" type="button" class="btn btn-secondary">Aceptar</button>
                <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('livewire.form_orders', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\app_laravel_subir\local\resources\views/livewire/orders.blade.php ENDPATH**/ ?>