<?php $__env->startSection('title','Domiciliarios'); ?>

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
                    <li class="breadcrumb-item active" aria-current="page">Lista de Domiciliarios</li>
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
                    <input wire:model="search" type="text" class="form-control" placeholder="Buscar domiciliado">
                </div>
            </div>
            
        </div>
    </div>
    <div class="card shadow border-0 table-wrapper table-responsive">
        <?php if($orders_domiciliaries->count()): ?>
            <div wire:loading.class="opacity-50">
                <table class="table order-table align-items-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>
                                <div class="form-check dashboard-check">
                                    <input class="form-check-input" type="checkbox" value="" id="orderCheck55">
                                    <label class="form-check-label" for="orderCheck55">
                                    </label>
                                </div>
                            </th>
                            <th>Referencia del pedido</th>
                            <th>Usuario asignado</th>
                            <th>Dirección de entrega</th>
                            <th>Cliente</th>
                            <th>Fecha de asignación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $orders_domiciliaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td>
                                    <div class="form-check dashboard-check">
                                        <input class="form-check-input" type="checkbox" value="" id="orderCheck1">
                                        <label class="form-check-label" for="orderCheck1">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <?php echo e(Orders::getReference($order->orders->code)); ?>

                                </td>
                                <th><?php echo e(ucfirst($order->user->first_name)); ?> <?php echo e(ucfirst($order->user->last_name)); ?></th>
                                <th><?php echo e($order->orders->delivery_address); ?></th>
                                <th><?php echo e(ucfirst($order->orders->user->first_name)); ?> <?php echo e(ucfirst($order->orders->user->last_name)); ?></th>
                                <th><?php echo e(\Carbon\Carbon::parse($order->created_at)->format('d-m-Y')); ?></th>
                                <th style="width: 5%;">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <?php if($order->role != 'admin'): ?>
                                                <li>
                                                    <button wire:click="selectItem(<?php echo e($order->id); ?>, 'delete')" class="dropdown-item btn-outline-gray-500 text-danger"><i class="fas fa-trash"></i> Eliminar</button>
                                                </li>
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
                <span class="text-gray-500"><i class="fas fa-archive"></i>  No hay domiciliarios para mostrar </span>
            </div>
        <?php endif; ?>
    </div>
    <?php if($orders_domiciliaries->links()): ?>
        <div class="d-flex justify-content-end py-4">
            <?php echo e($orders_domiciliaries->links()); ?>

        </div>
    <?php endif; ?>
     
    <!-- Modal Delete-->
    <div wire:ignore.self class="modal fade" id="deleteDomiciliary" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Eliminar Domiciliado</h2>
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
    
</div><?php /**PATH /Users/usuario/Sites/app_laravel_subir/local/resources/views/livewire/list-domiciliary.blade.php ENDPATH**/ ?>