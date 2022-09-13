<?php $__env->startSection('title', 'Pedido '.$order['code']); ?>
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
                        <li class="breadcrumb-item active" aria-current="page">Resumen del Pedido</li>
                    </ol>
                </nav>
            </div>
        </div>
        
        <div class="table-settings mb-4">
            <div class="row justify-content-between align-items-center">
                <div class="col-9 col-lg-9 d-md-flex">
                    <input type="hidden" id="text_copy">
                </div>
                <div class="col-3 col-lg-3 d-flex justify-content-end">
                    <button class="btn btn-secondary me-2 dropdown-toggle">
                        <i class="fas fa-file-pdf"></i> Descargar
                    </button>
                    <?php if($order['state'] != 'Entregado'): ?>
                        <button class="btn btn-info me-2 dropdown-toggle" id="confirmation" data-id="<?php echo e($order['id']); ?>">
                            <span class="fas fa-sms"></span> Confirmar pedido
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if($order): ?>
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-xl-9">
                    <div class="card shadow border-0 p-4 p-md-5 position-relative">
                        <div class="d-flex justify-content-between pb-4 pb-md-5 mb-4 mb-md-5 border-bottom border-light">
                            <img class="image-md" src="../../assets/img/brand/light.svg" alt="Rocket Logo" width="30" height="30">
                            <div>
                                <h4>Volt LLC.</h4>
                                <ul class="list-group simple-list">
                                    <li class="list-group-item fw-normal">112 Washington Square</li>
                                    <li class="list-group-item fw-normal">New York, USA</li>
                                    <li class="list-group-item fw-normal"><a class="fw-bold text-primary" href="#">company@themesberg.com</a></li>
                                </ul> 
                            </div>
                        </div>
                        <div class="mb-6 d-flex align-items-center justify-content-center">
                            <h2 class="h1 mb-0">Pedido #<?php echo e($order['code']); ?></h2>
                            <span class="badge badge-lg ms-4" style="background-color:<?php if($order['state'] == 'Pendiente'): ?> #FBA918 <?php elseif($order['state'] == 'En Ruta'): ?> #11cdef <?php elseif($order['state'] == 'Entregado'): ?> #10B981 <?php elseif($order['state'] == 'No Entregado'): ?> #E11D48 <?php endif; ?>"><?php echo e($order['state']); ?></span>
                        </div>
                        <div class="row justify-content-between mb-4 mb-md-5">
                            <div class="col-sm">
                                <h5>Client Information:</h5>
                                <div>
                                    <ul class="list-group simple-list">
                                        <li class="list-group-item fw-normal"><?php echo e(ucfirst($user['first_name'])); ?> <?php echo e(ucfirst($user['last_name'])); ?></li>
                                        <li class="list-group-item fw-normal"><?php echo e(ucfirst($user['address'])); ?>, <?php echo e(ucfirst($user['neighborhood'])); ?>, <?php echo e(ucfirst($user['city'])); ?></li>
                                        <li class="list-group-item fw-normal"><a class="fw-bold text-primary" href="#"><?php echo e(ucfirst($user['email'])); ?></a></li>
                                    </ul> 
                                </div>
                            </div>
                            <div class="col-sm col-lg-4">
                                <dl class="row text-sm-right">
                                    
                                    <dt class="col-6"><strong>Pedido No.</strong> </dt>
                                    <dd class="col-6"><?php echo e(str_replace("ORDER_", "", $order['code'])); ?></dd>
                                    <dt class="col-6"><strong>Fecha de creación:</strong>
                                    </dt>
                                    <dd class="col-6"><?php echo e(\Carbon\Carbon::parse($order['created_at'])->format('d/m/Y')); ?></dd>
                                    <dt class="col-6"><strong>Fecha de Entrega:</strong>
                                    </dt>
                                    <dd class="col-6"><?php echo e(\Carbon\Carbon::parse($order['date_order'])->format('d/m/Y')); ?></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="bg-light border-top">
                                            <tr>
                                                <th scope="row" class="border-0 text-left">
                                                    Imagen
                                                </th>
                                                <th scope="row" class="border-0">
                                                    Nombre del producto
                                                </th>
                                                <th scope="row" class="border-0">
                                                    Precio unitario
                                                </th> 
                                                <th scope="row" class="border-0">
                                                    Cantidad
                                                </th>
                                                <th scope="row" class="border-0">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $order_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <th scope="row" class="text-left fw-bold h6">
                                                    <img class="image-md" src="<?php echo e(asset('local/public/images_products/'.$item->product_image)); ?>">
                                                </th>
                                                <td>
                                                    <?php echo e($item->name); ?>

                                                </td>
                                                <td>
                                                    <i class="fas fa-dollar-sign" aria-hidden="true"></i> <?php echo e(number_format($item->price,'2',',','.')); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($item->qty); ?>

                                                </td>
                                                <td>
                                                    <i class="fas fa-dollar-sign" aria-hidden="true"></i> <?php echo e(number_format($item->qty * $item->price,'2',',','.')); ?>

                                                </td>
                                            </tr> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end text-right mb-4 py-4">
                                    <div class="mt-4">
                                        <table class="table table-clear">
                                            <tbody>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Subtotal</strong>
                                                    </td>
                                                    <td class="right"> <i class="fas fa-dollar-sign" aria-hidden="true"></i> <?php echo e(number_format($order['subtotal'],'2',',','.')); ?></td>
                                                </tr>
                                                <?php if( $order['gift_sets'] ): ?>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Kit de regalo</strong>
                                                    </td>
                                                    <td class="right"><i class="fas fa-dollar-sign" aria-hidden="true"></i> <?php echo e(number_format($order['gift_sets'],'2',',','.')); ?></td>
                                                </tr>
                                                <?php endif; ?>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Total</strong>
                                                    </td>
                                                    <td class="right">
                                                        <strong>
                                                            <i class="fas fa-dollar-sign" aria-hidden="true"></i>

                                                            <?php if( $order['gift_sets'] ): ?>
                                                                <?php echo e(number_format($order['total'] + $order['gift_sets'] ,'2',',','.')); ?>

                                                            <?php else: ?>
                                                                <?php echo e(number_format($order['total'],'2',',','.')); ?>

                                                            <?php endif; ?>
                                                        </strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <h4>Metodo de Pago:</h4>
                                <span>payment@volt.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
        <?php endif; ?>
        
        
        <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8bdefe537b868c30952851c478827a760077823)): ?>
<?php $component = $__componentOriginald8bdefe537b868c30952851c478827a760077823; ?>
<?php unset($__componentOriginald8bdefe537b868c30952851c478827a760077823); ?>
<?php endif; ?>
<?php /**PATH /Users/usuario/Sites/app_laravel_subir/local/resources/views/livewire/show-order.blade.php ENDPATH**/ ?>