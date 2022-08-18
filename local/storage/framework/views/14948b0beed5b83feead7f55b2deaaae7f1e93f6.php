<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
  <div class="container-fluid px-0">
    <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
      <div class="d-flex align-items-center">
        <!-- Search form -->
        <form class="navbar-search form-inline" id="navbar-search-main">
          <div class="input-group input-group-merge search-bar">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Buscar" aria-label="Buscar" aria-describedby="button-addon2">
              <button class="btn btn-pill btn-outline-gray-500" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
      <!-- Navbar links -->
      <ul class="navbar-nav align-items-center">
        
        <li class="nav-item dropdown">
            <a class="nav-link text-dark dropdown-toggle" 
            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fas fa-plus"></span>
          </a>
          <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1 shadow-lg">
            <?php if(auth()->user()->role == 'admin'): ?>
              <a class="dropdown-item"> <i class="fas fa-users" aria-hidden="true"></i> Agregar Cliente</a>
              <div role="separator" class="dropdown-divider my-1"></div>
              <a class="dropdown-item"> <i class="fas fa-box" aria-hidden="true"></i> Agregar Producto</a>
            <?php elseif(auth()->user()->role == 'client'): ?>
              <a class="dropdown-item"> <i class="fas fa-file-invoice" aria-hidden="true"></i> Agregar Pedido</a>
            <?php else: ?>

            <?php endif; ?>
          </div>
        </li>
        <li class="nav-item dropdown ms-lg-3">
          <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <div class="media d-flex align-items-center">
              <?php if(auth()->user()->user_image): ?>
              <img class="avatar rounded-circle" alt="Imagen Perfil" src="<?php echo e(Storage::disk('images_profile')->url(auth()->user()->user_image)); ?>">   
              <?php else: ?>
              <img class="avatar rounded-circle" alt="Imagen Perfil" src="<?php echo e(asset('public/assets/img/team/profile-picture-1.jpg')); ?>">
              <?php endif; ?>
              <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                <span
                  class="mb-0 font-small fw-bold text-gray-900"><?php echo e(auth()->user()->first_name ? auth()->user()->first_name . ' ' . auth()->user()->last_name : 'User Name'); ?></span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
            <a class="dropdown-item d-flex align-items-center" href="/profile">
              <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                  clip-rule="evenodd"></path>
              </svg>
              Perfil
            </a>
            <div role="separator" class="dropdown-divider my-1"></div>
            <a class="dropdown-item d-flex align-items-center">
              <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('logout', [])->html();
} elseif ($_instance->childHasBeenRendered('ALdiF7d')) {
    $componentId = $_instance->getRenderedChildComponentId('ALdiF7d');
    $componentTag = $_instance->getRenderedChildComponentTagName('ALdiF7d');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('ALdiF7d');
} else {
    $response = \Livewire\Livewire::mount('logout', []);
    $html = $response->html();
    $_instance->logRenderedChild('ALdiF7d', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?></a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav><?php /**PATH /Users/usuario/Sites/app_laravel_subir/local/resources/views/layouts/topbar.blade.php ENDPATH**/ ?>