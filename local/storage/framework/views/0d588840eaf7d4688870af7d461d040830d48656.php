  <!-- Modal -->
<div class="modal fade" id="form_orders" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Selecciona el producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-9 col-lg-9 d-md-flex">
                    <div class="input-group me-2 me-lg-3 fmxw-300">
                        <span class="input-group-text">
                            <span class="fas fa-search"></span>
                        </span>
                        <input wire:model="search" type="text" class="form-control" placeholder="Buscar productos">
                    </div>
                </div>
                <?php if($products->count()): ?>
                    <div wire:loading.class="opacity-50">
                        <table class="table product-table align-items-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>
                                        <div class="form-check dashboard-check">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <label class="form-check-label" for="ProductCheck55">
                                            </label>
                                        </div>
                                    </th>
                                    <th>Nombre del Producto</th>
                                    <th>Referencia</th>
                                    <th>Presentación</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="form-check dashboard-check">
                                                <input class="form-check-input" type="checkbox" value="<?php echo e($product->id); ?>">
                                                <label class="form-check-label" for="ProductCheck1">
                                                </label>
                                            </div>
                                        </td>
                                        <th><?php echo e(strtoupper($product->name)); ?></th>
                                        <th><?php echo e($product->reference); ?></th>
                                        <th><?php echo e($product->presentation); ?></th>
                                        <th><?php echo e($product->price); ?></th>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end py-4 px-4">
                        <?php echo e($products->links()); ?>

                    </div>
                <?php else: ?>
            <div class="d-flex justify-content-center py-6">
                <span class="text-gray-500"><i class="fas fa-archive"></i>  No hay productos para mostrar </span>
            </div>
        <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary">Seleccionar</button>
                <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
  <?php /**PATH C:\laragon\www\app_laravel_subir\local\resources\views/livewire/form_orders.blade.php ENDPATH**/ ?>