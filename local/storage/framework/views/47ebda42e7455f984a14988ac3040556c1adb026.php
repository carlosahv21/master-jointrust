<?php $__env->startSection('title','Login'); ?>

<main>

    <!-- Section -->
    <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
        <div class="container">
            
            <div wire:ignore.self class="row justify-content-center form-bg-image"
                data-background-lg="<?php echo e(asset('public/assets/img/illustrations/signin.svg')); ?>">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-3 h3">Bienvenido</h1>
                            <p class="mb-0"> Crea una cuenta nueva o
                                <p class="mb-0">Inicia sesión con tus credenciales:</p>

                            </p>
                        </div>
                        <form wire:submit.prevent="login" action="#" class="mt-4" method="POST">
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="email">Tu correo electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><svg
                                            class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                            </path>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                        </svg></span>
                                    <input wire:model="email" type="email" class="form-control"
                                        placeholder="ejemplo@empresa.com" id="email" autofocus required>
                                </div>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div wire:key="form" class="invalid-feedback"> <?php echo e($message); ?> </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="password">Tu contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2"><svg
                                                class="icon icon-xs text-gray-600" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg></span>
                                        <input wire:model.lazy="password" type="password" placeholder="Contraseña"
                                            class="form-control" id="password" required>
                                    </div>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"> <?php echo e($message); ?> </div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <!-- End of Form -->
                                <div class="d-flex justify-content-between align-items-top mb-4">
                                    <div class="form-check">
                                        <input wire:model="remember_me" class="form-check-input" type="checkbox"
                                            value="" id="remember">
                                        <label class="form-check-label mb-0" for="remember">
                                            Recuérdame
                                        </label>
                                    </div>
                                    <div><a href="<?php echo e(route('forgot-password')); ?>" class="small text-right">¿Contraseña perdida?</a></div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gray-800">Entrar</button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <span class="fw-normal">
                                ¿No tienes cuenta?
                                <a href="<?php echo e(route('register')); ?>" class="fw-bold">Crear una cuenta</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><?php /**PATH C:\laragon\www\app_laravel_subir\local\resources\views/livewire/auth/login.blade.php ENDPATH**/ ?>