<?php $__env->startSection('title','Producto'); ?>

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
                    <li class="breadcrumb-item active" aria-current="page">Lista de Productos</li>
                </ol>
            </nav>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            
            
        </div>
    </div>

    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-9 d-md-flex">
                <div class="input-group me-2 me-lg-3 fmxw-300">
                    <span class="input-group-text">
                        <span class="fas fa-search"></span>
                    </span>
                    <input wire:model="search" type="text" class="form-control" placeholder="Buscar productos">
                </div>
            </div>
            
            <div class="col-3 col-lg-3 d-flex justify-content-end">
                <div class="dropdown px-2">
                    <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Acción masiva <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><button wire:click="selectItem('','masiveExport')" class="dropdown-item btn-outline-gray-500"><i class="fas fa-download"></i> Exportar</button></li>
                        <li><button wire:click="selectItem('','masiveDelete')" class="dropdown-item btn-outline-gray-500 text-danger"><i class="fas fa-trash"></i> Eliminar</button></li>
                    </ul>
                </div>
                
                <button class="btn btn-secondary me-2 dropdown-toggle" data-bs-toggle="modal" data-bs-target="#createProduct">
                    <span class="fas fa-plus"></span> Crear Productos
                </button>
            </div>
        </div>
    </div>
    <div class="card shadow border-0 table-wrapper table-responsive">
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
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="form-check dashboard-check">
                                        <input wire:model="selected" class="form-check-input" type="checkbox" value="<?php echo e($product->id); ?>">
                                        <label class="form-check-label" for="ProductCheck1">
                                        </label>
                                    </div>
                                </td>
                                <th><?php echo e(strtoupper($product->name)); ?></th>
                                <th><?php echo e($product->reference); ?></th>
                                <th><?php echo e($product->presentation); ?></th>
                                <th> <i class="fas fa-dollar-sign"></i> <?php echo e(number_format($product->price,'2',',','.')); ?></th>
                                <th><?php echo e($product->stock); ?></th>
                                <th style="width: 5%;">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a wire:click="selectItem(<?php echo e($product->id); ?>, 'update')" class="dropdown-item btn-outline-gray-500"><i class="fas fa-edit"></i> Editar</a></li>
                                        <?php if($product->role != 'admin'): ?>
                                            <?php if($product->favorite): ?>
                                                <li ><button wire:click="removeFavorite(<?php echo e($product->id); ?>)" class="dropdown-item btn-outline-gray-500"><i class="far fa-star"></i> Remover favorito</button></li>
                                            <?php else: ?>
                                                <li ><button wire:click="addFavorite(<?php echo e($product->id); ?>)" class="dropdown-item btn-outline-gray-500"><i class="fas fa-star"></i> Agregar favorito</button></li>
                                            <?php endif; ?>
                                            <li ><button wire:click="selectItem(<?php echo e($product->id); ?>, 'delete')" class="dropdown-item btn-outline-gray-500 text-danger"><i class="fas fa-trash"></i> Eliminar</button></li>
                                        <?php endif; ?>
                                        </ul>
                                    </li>
                                </th>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="d-flex justify-content-center py-6">
                <span class="text-gray-500"><i class="fas fa-archive"></i>  No hay productos para mostrar </span>
            </div>
        <?php endif; ?>
    </div>
    <?php if($products->links()): ?>
        <div class="d-flex justify-content-end py-4 px-4">
            <?php echo e($products->links()); ?>

        </div>
    <?php endif; ?>
    <!-- Modal Add-->
    <div wire:ignore.self class="modal fade" id="createProduct" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Crear Producto</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('product-form')->html();
} elseif ($_instance->childHasBeenRendered('l2519592853-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l2519592853-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l2519592853-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l2519592853-0');
} else {
    $response = \Livewire\Livewire::mount('product-form');
    $html = $response->html();
    $_instance->logRenderedChild('l2519592853-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Delete-->
    <div wire:ignore.self class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Eliminar Producto</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseas eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button wire:click="delete" class="btn btn-secondary">Eliminar</button>
                    <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Delete Masive-->
    <div wire:ignore.self class="modal fade" id="deleteProductMassive" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Eliminar Productos</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseas eliminar <?php echo e($countProduct); ?> registros?
                </div>
                <div class="modal-footer">
                    <button wire:click="massiveDelete" class="btn btn-secondary">Acepto</button>
                    <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /Users/usuario/Sites/app_laravel_subir/local/resources/views/livewire/products.blade.php ENDPATH**/ ?>