<?php $__env->startSection('title','Domicilio'); ?>

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
                    <li class="breadcrumb-item active" aria-current="page">Lista de domicilios</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-9 d-md-flex">
                <div class="input-group me-2 me-lg-3 fmxw-300">
                    <span class="input-group-text">
                        <span class="fas fa-search"></span>
                    </span>
                    <input wire:model="search" type="text" class="form-control" placeholder="Buscar Kit de regalo">
                </div>
            </div>
            <div class="col-3 col-lg-3 d-flex justify-content-end">
                <div class="dropdown px-2">
                    <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Acción masiva <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><button wire:click="selectItem('','masiveDelete')" class="dropdown-item btn-outline-gray-500 text-danger"><i class="fas fa-trash"></i> Eliminar</button></li>
                    </ul>
                </div>

                <button class="btn btn-secondary me-2 dropdown-toggle" wire:click="selectItem('', 'create')">
                    <span class="fas fa-plus"></span> Crear Domicilio
                </button>
            </div>
        </div>
    </div>
    <div class="card shadow border-0 table-wrapper table-responsive">
        <?php if($shippings->count()): ?>
            <div wire:loading.class="opacity-50">
                <table class="table order-table align-items-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>
                                <div class="form-check dashboard-check">
                                    <input class="form-check-input" type="checkbox" value="" id="ShippingsCheck55">
                                    <label class="form-check-label" for="ShippingsCheck55">
                                    </label>
                                </div>
                            </th>
                            <th>Nombre de la zona</th>
                            <th>Descripci&oacute;n</th>
                            <th>Valor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $shippings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="form-check dashboard-check">
                                        <input wire:model="selected" class="form-check-input" type="checkbox" value="<?php echo e($shipping->id); ?>">
                                        <label class="form-check-label" for="ShippingsCheck1">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <?php echo e(ucfirst($shipping->zone)); ?>

                                </td>
                                <td> <?php echo e($shipping->description); ?></td>
                                <td> <i class="fas fa-dollar-sign"></i> <?php echo e(number_format($shipping->value,'2',',','.')); ?> </td>
                                <td style="width: 5%;">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <?php if(auth()->user()->role == 'admin'): ?>
                                                <li>
                                                    <button wire:click="selectItem(<?php echo e($shipping->id); ?>, 'update')" class="dropdown-item btn-outline-gray-500"><i class="fas fa-edit"></i> Editar</button>
                                                </li>
                                                <li>
                                                    <button wire:click="selectItem(<?php echo e($shipping->id); ?>, 'delete')" class="dropdown-item btn-outline-gray-500 text-danger"><i class="fas fa-trash"></i> Eliminar</button>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="d-flex justify-content-center py-6">
                <span class="text-gray-500"><i class="fas fa-archive"></i>  No hay domicilios para mostrar </span>
            </div>
        <?php endif; ?>
    </div>
    <?php if( $shippings->links()): ?>
        <div class="d-flex justify-content-end py-4">
            <?php echo e($shippings->links()); ?>

        </div>
    <?php endif; ?>


      <!-- Modal Add-->
      <div wire:ignore.self class="modal fade" id="createShipping" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title"><?php echo e($title_modal); ?></h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('shipping-form')->html();
} elseif ($_instance->childHasBeenRendered('BXPbAwJ')) {
    $componentId = $_instance->getRenderedChildComponentId('BXPbAwJ');
    $componentTag = $_instance->getRenderedChildComponentTagName('BXPbAwJ');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('BXPbAwJ');
} else {
    $response = \Livewire\Livewire::mount('shipping-form');
    $html = $response->html();
    $_instance->logRenderedChild('BXPbAwJ', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
            </div>
        </div>
    </div>
     
    <!-- Modal Delete-->
    <div wire:ignore.self class="modal fade" id="deleteShipping" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Eliminar Kit de regalo</h2>
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
    <div wire:ignore.self class="modal fade" id="deleteShippingMasive" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Eliminar Kists de Regalos</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseas eliminar <?php echo e($countShippings); ?> registros?
                </div>
                <div class="modal-footer">
                    <button wire:click="massiveDelete" class="btn btn-secondary">Eliminar</button>
                    <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    
</div><?php /**PATH /Users/usuario/Sites/app_laravel_subir/local/resources/views/livewire/shippings.blade.php ENDPATH**/ ?>