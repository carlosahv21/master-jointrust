<?php $__env->startSection('title','Perfil de Usuario'); ?>

<div class="row py-4">
    <div class="col-12 col-xl-8">
        <?php if($showSavedAlert): ?>
        <div class="alert alert-success" role="alert">
            Saved!
        </div>
        <?php endif; ?>
        <div class="card card-body border-0 shadow mb-4">
            <h2 class="h5 mb-4">Informacion del Cliente </h2>
            <div>
                <form wire:submit.prevent="save" action="#" method="POST">
                    <div class="row align-items-start p-2">
                        <div class="col-6 p-2">
                            <label for="inputNombre" class="form-label">Nombre <span class="text-danger"> *</span></label>
                            <input wire:model="user.first_name" type="text" class="form-control" placeholder="Ej: John" id="inputNombre">
                            <?php if($errors->has('user.first_name')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('user.first_name')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-6 p-2">
                            <label for="inputApellido" class="form-label">Apellido <span class="text-danger"> *</span></label>
                            <input wire:model="user.last_name" type="text" class="form-control" placeholder="Ej: Doe" id="inputApellido">
                            <?php if($errors->has('user.last_name')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('user.last_name')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-4 p-2">
                            <label for="inputEmail" class="form-label">Email <span class="text-danger"> *</span></label>
                            <input wire:model="user.email" type="text" class="form-control" placeholder="Ej: johndoe@test.com" id="inputEmail">
                            <?php if($errors->has('user.email')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('user.email')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-4 p-2">
                            <label for="inputCelular" class="form-label">Celular</label>
                            <input wire:model="user.phone" type="text" class="form-control" placeholder="Ej: 311999999" id="inputCelular">
                            <?php if($errors->has('user.phone')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('user.phone')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-4 p-2">
                            <label for="inputCumpleanios" class="form-label">Cumpleaños</label>
                            <input wire:model="user.date_birthday" type="date" class="form-control" placeholder="Ej: 15/10/1990" id="inputCumpleanios">
                            <?php if($errors->has('user.date_birthday')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('user.date_birthday')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 p-2">
                            <label for="inputDireccion" class="form-label">Direccion <span class="text-danger"> *</span></label>
                            <input wire:model="user.address" type="text" class="form-control" placeholder="Direccion completa que incluya nombre edificio o conjunto" id="inputDireccion" >
                            <?php if($errors->has('user.address')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('user.address')); ?>

                                </div>
                            <?php endif; ?>
                            <label class="form-text text-secondary">Especificar Interior, Torre, etc.</label>
                        </div>
                        <div class="col-6 p-2">
                            <label for="inputBarrio" class="form-label">Barrio </label>
                            <input wire:model="user.neighborhood" type="text" class="form-control" placeholder="Ej: Castilla" id="inputBarrio">
                            <?php if($errors->has('user.neighborhood')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('user.neighborhood')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-6 p-2">
                            <label for="inputLocalidad" class="form-label">Localidad</label>
                            <input wire:model="user.location" type="text" class="form-control" placeholder="Ej: Kenedy" id="inputLocalidad">
                            <?php if($errors->has('user.location')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('user.location')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-6 p-2">
                            <label for="inputCiudad" class="form-label">Ciudad/Municipio</label>
                            <input wire:model="user.city" type="text" class="form-control" placeholder="Ej: Barranquilla" id="inputCiudad">
                            <?php if($errors->has('user.city')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('user.city')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                                                                       
                        <?php if(auth()->user()->role == 'admin'): ?>
                            <div class="col-6 p-2">
                                <label for="inputTipo" class="form-label">Rol <span class="text-danger"> *</span></label>
                                <select wire:ignore.model="role" class="form-select" id="inputTipo">
                                    <option value="admin">Admin</option>
                                    <option value="client">Cliente</option>
                                    <option value="domiciliary">Domiciliario</option>
                                    </select>
                                    
                            </div>
                        <?php endif; ?>
                        <div class="col-6 p-2">
                            <label for="inputIdentificacion" class="form-label">NIT / CC </label>
                            <input wire:model="user.identificacion" type="text" class="form-control" placeholder="Ej: 123456789-0" id="inputIdentificacion">
                            <?php if($errors->has('user.identificacion')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('user.identificacion')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if(auth()->user()->role == 'client'): ?>
                        <div class="row align-items-start p-2">
                            <div class="col-12 p-2">
                                <div class="form-check">
                                    <input wire:model="user.confirm" class="form-check-input" type="radio" name="confirm" id="confirm1" value="option1" checked="">
                                    <label class="form-check-label" for="confirm1">
                                        Acepto y autorizo recibir a través de WhatsApp y/o mail la información de productos disponibles del día. 
                                    </label>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="d-flex justify-content-end py-4">
                        <button type="submit" class="btn btn-secondary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card shadow border-0 text-center p-0">
                    <div wire:ignore.self class="profile-cover rounded-top"
                        data-background="<?php echo e(asset('public/assets/img/profile-cover.jpg')); ?>"></div>
                    <div class="card-body pb-5">
                        <?php if($upload): ?>
                        <img class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" src="<?php echo e($upload->temporaryUrl()); ?>" alt="change avatar" width="100" height="100">                        
                        <?php elseif($user->user_image): ?>
                        <img src="<?php echo e(Storage::disk('images_profile')->url($user->user_image)); ?>" class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" alt="<?php echo e($user->first_name ." ". $user->last_name); ?>">
                        <?php else: ?>
                        <img src="<?php echo e(asset('public/assets/img/team/profile-picture-1.jpg')); ?>" class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" alt="<?php echo e($user->first_name ." ". $user->last_name); ?>">
                        <?php endif; ?>
                        <h4 class="h3">
                            <?php echo e($user->first_name ." ". $user->last_name); ?>

                        </h4>
                        <h5 class="fw-normal"><?php echo e($user->role); ?></h5>
                        <p class="text-gray mb-4"><?php echo e($user->location.", ".$user->neighborhood.", ".$user->address); ?></p>
                        <button wire:click="testListen()" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center me-2">
                            Cambiar Contraseña
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-body border-0 shadow mb-4">
                    <h2 class="h5 mb-4">Selecciona tu foto de perfil</h2>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <!-- Avatar -->
                            <div class="user-avatar xl-avatar">
                                <?php if($upload): ?>
                                <img class="rounded avatar-xl" src="<?php echo e($upload->temporaryUrl()); ?>" alt="change avatar" width="100" height="100">                        
                                <?php elseif($user->user_image): ?>
                                <img class="rounded avatar-xl" src="<?php echo e(Storage::disk('images_profile')->url($user->user_image)); ?>" alt="change avatar" width="100" height="100"> 
                                <?php else: ?>
                                <img class="rounded avatar-xl" src="https://volt-pro-laravel-admin-dashboard.updivision.com/avatars/profile-picture-1.jpg" alt="change avatar" width="100" height="100">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="file-field">
                            <div class="d-flex justify-content-xl-center ms-xl-3">
                                <form wire:submit.prevent="update">
                                    <div class="d-flex">
                                            <svg class="icon text-gray-500 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                                        </svg>
                                        <input wire:model="upload" type="file" accept="image/*">
                                        <?php if($errors->has('upload')): ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($errors->first('upload')); ?>

                                            </div>
                                        <?php endif; ?>
                                        <div class="d-md-block text-left">
                                            <div class="fw-normal text-dark mb-1">Escoger Imagen</div>
                                            <div class="text-gray small">JPG, GIF or PNG. Max size of 2MB</div>
                                            <button class="btn btn-facebook d-inline-flex align-items-center" type="submit">
                                                Actualizar Foto
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add-->
    <div wire:ignore.self class="modal fade" id="changePass" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Cambiar Contraseña</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('change-pass')->html();
} elseif ($_instance->childHasBeenRendered('l804183673-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l804183673-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l804183673-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l804183673-0');
} else {
    $response = \Livewire\Livewire::mount('change-pass');
    $html = $response->html();
    $_instance->logRenderedChild('l804183673-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Advertisement-->
    <div wire:ignore.self class="modal fade" id="advertisement" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Anuncio</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('guests')->html();
} elseif ($_instance->childHasBeenRendered('l804183673-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l804183673-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l804183673-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l804183673-1');
} else {
    $response = \Livewire\Livewire::mount('guests');
    $html = $response->html();
    $_instance->logRenderedChild('l804183673-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal FirstTime-->
    <div wire:ignore.self class="modal fade" id="first_time" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    ¡Felicitaciones, ya eres parte de la familia saludable JoinTrust!
                    <div class="d-flex justify-content-center py-4">
                        <button wire:click="first_time" class="btn btn-secondary" data-bs-dismiss="modal">Quiero hacer mi primer pedido!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /Users/usuario/Sites/app_laravel_subir/local/resources/views/livewire/profile.blade.php ENDPATH**/ ?>