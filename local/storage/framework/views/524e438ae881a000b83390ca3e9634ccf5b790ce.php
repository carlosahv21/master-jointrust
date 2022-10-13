<?php $__env->startSection('title','Usuario'); ?>

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
                    <li class="breadcrumb-item active" aria-current="page">Lista de Usuarios</li>
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
                    <input wire:model="search" type="text" class="form-control" placeholder="Buscar usuario">
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

                <button class="btn btn-secondary me-2 dropdown-toggle" wire:click="selectItem('', 'create')">
                    <span class="fas fa-plus"></span> Crear Usuarios
                </button>
            </div>
        </div>
    </div>
    <div class="card shadow border-0 table-wrapper table-responsive">
        <?php if($users->count()): ?>
            <div wire:loading.class="opacity-50">
                <table class="table user-table align-items-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>
                                <div class="form-check dashboard-check">
                                    <input class="form-check-input" type="checkbox" value="" id="userCheck55">
                                    <label class="form-check-label" for="userCheck55">
                                    </label>
                                </div>
                            </th>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Direccion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="form-check dashboard-check">
                                        <input class="form-check-input" type="checkbox" value="" id="userCheck1">
                                        <label class="form-check-label" for="userCheck1">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a class="d-flex align-items-center">
                                        <?php if($user->user_image): ?>
                                        <img src="<?php echo e(asset('local/storage/app/images_profile/'.$user->user_image)); ?>" class="avatar rounded-circle me-3" alt="<?php echo e($user->first_name ." ". $user->last_name); ?>">
                                        <?php else: ?>
                                        <img src="../assets/img/team/profile-picture-1.jpg" class="avatar rounded-circle me-3"
                                            alt="Avatar">
                                        <?php endif; ?>
                                        <div class="d-block">
                                            <span class="fw-bold"><?php echo e($user->first_name . " ". $user->last_name); ?></span>
                                            <div class="small text-gray"><?php echo e($user->email); ?></div>
                                        </div>
                                    </a>
                                </td>
                                <th><?php echo e($user->role); ?></th>
                                <th><?php echo e($user->address); ?></th>
                                <th style="width: 5%;">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a wire:click="selectItem(<?php echo e($user->id); ?>, 'update')" class="dropdown-item btn-outline-gray-500"><i class="fas fa-edit"></i> Editar</a></li>
                                        <?php if($user->role != 'admin'): ?>
                                            <?php if($user->role == 'client'): ?>
                                                <li><a href="/referals/<?php echo e($user->id); ?>" class="dropdown-item btn-outline-gray-500"><i class="fas fa-eye"></i> Ver Referidos</a></li>
                                                <li><button wire:click="selectItem(<?php echo e($user->id); ?>, 'seeAddress')" class="dropdown-item btn-outline-gray-500"><i class="far fa-address-card"></i> Ver Direcciones</button></li>
                                            <?php endif; ?>
                                            <li><button wire:click="selectItem(<?php echo e($user->id); ?>, 'delete')" class="dropdown-item btn-outline-gray-500 text-danger"><i class="fas fa-trash"></i> Eliminar</button></li>
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
                <span class="text-gray-500"><i class="fas fa-archive"></i>  No hay usuarios para mostrar </span>
            </div>
        <?php endif; ?>
    </div>
    <?php if($users->links()): ?>
        <div class="d-flex justify-content-end py-4">
            <?php echo e($users->links()); ?>

        </div>
    <?php endif; ?>
    <!-- Modal Add-->
    <div wire:ignore.self class="modal fade" id="createUser" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title"><?php echo e($title_modal); ?></h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('user-form')->html();
} elseif ($_instance->childHasBeenRendered('cSPiBI9')) {
    $componentId = $_instance->getRenderedChildComponentId('cSPiBI9');
    $componentTag = $_instance->getRenderedChildComponentTagName('cSPiBI9');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('cSPiBI9');
} else {
    $response = \Livewire\Livewire::mount('user-form');
    $html = $response->html();
    $_instance->logRenderedChild('cSPiBI9', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Delete-->
    <div wire:ignore.self class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Eliminar Usuario</h2>
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
    <div wire:ignore.self class="modal fade" id="deleteUserMasive" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Eliminar Usuarios</h2>
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
    <!-- Modal See Referrals-->
    <div wire:ignore.self class="modal fade" id="seeAddress" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Direcciones de entrega</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <table class="table user-table align-items-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Direccion</th>
                            <th>Domicilio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo csrf_field(); ?>
                        <?php $__currentLoopData = $this->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th>
                                    <?php echo e($address->address); ?>

                                </th>
                                <th>
                                    <select class="form-control" onchange="addShiping(this, <?php echo e($address->id); ?> )">
                                        <option value="">Elegir Zona</option>
                                        <?php $__currentLoopData = $this->shippings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($shipping->id == $address->shipping_id): ?> selected="selected" <?php endif; ?> value="<?php echo e($shipping->id); ?>"><?php echo e($shipping->zone); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </th>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <!-- <button wire:click="delete" class="btn btn-secondary">Eliminar</button> -->
                    <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('public/assets/js/users.js')); ?>"></script><?php /**PATH /Users/usuario/Sites/app_laravel_subir/local/resources/views/livewire/users.blade.php ENDPATH**/ ?>