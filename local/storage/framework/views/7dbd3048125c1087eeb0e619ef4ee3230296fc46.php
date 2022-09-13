<?php $__env->startSection('title', 'Referidos'); ?>
<?php if (isset($component)) { $__componentOriginald8bdefe537b868c30952851c478827a760077823 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layouts\Base::class, []); ?>
<?php $component->withName('layouts.base'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    
    <?php echo $__env->make('layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('layouts.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main class="content">
        
        <?php echo $__env->make('layouts.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                            <li class="breadcrumb-item active" aria-current="page">Lista de Referidos</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="table-settings mb-4">
                <input type="hidden" id="some">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-lg-12 d-md-flex justify-content-end">
                        <a href="javascript:history.back()" class="btn btn-secondary me-2 dropdown-toggle"> Volver</a>
                    </div>
                </div>
            </div>
            <div class="card shadow border-0 table-wrapper table-responsive">
                <?php if($guests): ?>
                    <div wire:loading.class="opacity-50">
                        <table class="table order-table align-items-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>
                                        <div class="form-check dashboard-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="giftsetsCheck55">
                                            <label class="form-check-label" for="giftsetsCheck55">
                                            </label>
                                        </div>
                                    </th>
                                    <th>Nombre</th>
                                    <th>Tel&eacute;fono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $guests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="form-check dashboard-check">
                                                <input wire:model="selected" class="form-check-input" type="checkbox"
                                                    value="<?php echo e($guest->id); ?>">
                                                <label class="form-check-label" for="giftsetsCheck1">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo e(ucfirst($guest->guest_name)); ?>

                                        </td>
                                        <td><?php echo e($guest->guest_phone); ?></td>
                                        <td style="width: 5%;">
                                            <button data-id="<?php echo e($guest->id); ?>" class="btn btn-secondary inviteReferrals"  id="inviteReferrals<?php echo e($guest->id); ?>"> <i class="fas fa-sms"></i> Invitar</button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="d-flex justify-content-center py-6">
                        <span class="text-gray-500"><i class="fas fa-archive"></i> No hay Referidos para mostrar
                        </span>
                    </div>
                <?php endif; ?>
            </div>

        </div>
        
        <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8bdefe537b868c30952851c478827a760077823)): ?>
<?php $component = $__componentOriginald8bdefe537b868c30952851c478827a760077823; ?>
<?php unset($__componentOriginald8bdefe537b868c30952851c478827a760077823); ?>
<?php endif; ?>


<!-- <?php echo e(var_dump($guests)); ?> -->
<?php /**PATH /Users/usuario/Sites/app_laravel_subir/local/resources/views/livewire/show-guest.blade.php ENDPATH**/ ?>