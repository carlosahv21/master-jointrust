@section('title', 'Crear Usuario')
 <main>

        <!-- Section -->
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                {{-- <p class="text-center"><a href="{{ route('dashboard') }}" class="text-gray-700"><i class="fas fa-angle-left me-2"></i> Back to homepage</a></p> --}}
                <div wire:ignore.self class="row justify-content-center form-bg-image" data-background-lg="{{ asset('public/assets/img/illustrations/signin.svg') }}">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Crea una cuenta</h1>
                            </div>
                            <form wire:submit.prevent="register" action="#" method="POST">
                                <!-- Form -->
                                <div class="form-group mt-4 mb-4">
                                    <label for="email">Tu correo electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg></span>
                                        <input wire:model="email" id="email" type="email" class="form-control" placeholder="ejemplo@empresa.com" autofocus required>
                                    </div>
                                    @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="password">Tu contraseña</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon4"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg></span>
                                            <input wire:model.lazy="password" type="password" placeholder="Contraseña" class="form-control" id="password" required>
                                            <button class="btn btn-pill btn-outline-gray-500" type="button" id="see-password"><i id="pass-icon" class="fas fa-eye" aria-hidden="true"></i></button>
                                        </div>  
                                        @error('password') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                                    </div>
                                    <!-- End of Form -->
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="confirm_password">Confirmar contraseña</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon5"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg></span>
                                            <input wire:model.lazy="passwordConfirmation" type="password" placeholder="Confirmar Contraseña" class="form-control" id="confirm-password" required>
                                            <button class="btn btn-pill btn-outline-gray-500" type="button" id="see-password-confirm"><i id="confirm-password-pass-icon" class="fas fa-eye" aria-hidden="true"></i></button>
                                        </div>  
                                    </div>
                                    <!-- End of Form -->
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" value="" id="terms" required>
                                        <label class="form-check-label fw-normal mb-0" for="terms">
                                            Estoy de acuerdo con los <a href="#">términos y condiciones</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gray-800">Registrarse</button>
                                </div>
                            </form>
                            <div class="d-flex justify-content-center align-items-center mt-4">
                                <span class="fw-normal">
                                    ¿Ya tienes una cuenta?
                                    <a href="{{ route('login') }}" class="fw-bold">Entre aquí</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>