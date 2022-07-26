<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
  <div class="sidebar-inner px-2 pt-3">
    <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
      <div class="d-flex align-items-center">
        <div class="avatar-lg me-4">
          <img src="<?php echo e(asset('public/assets/img/team/profile-picture-3.jpg')); ?>" class="card-img-top rounded-circle border-white"
            alt="Bonnie Green">
        </div>
      </div>
      <div class="collapse-close d-md-none">
        <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
          aria-expanded="true" aria-label="Toggle navigation">
          <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </a>
      </div>
    </div>
    <ul class="nav flex-column pt-3 pt-md-0">
      <li class="nav-item">
        <a href="/dashboard" class="nav-link d-flex align-items-center">
          <span class="sidebar-icon me-3">
            <img src="<?php echo e(asset('public/assets/img/brand/light.svg')); ?>" height="20" width="20" alt="Volt Logo">
          </span>
          <span class="mt-1 ms-1 sidebar-text">
            Jointrust
          </span>
        </a>
      </li>
      <?php if(auth()->user()->role == 'admin'): ?>
        <li class="nav-item <?php echo e(Request::segment(1) == 'users' ? 'active' : ''); ?>">
          <a href="/users" class="nav-link">
            <span class="sidebar-icon"><i class="fas fa-users"></i></span>
            <span class="sidebar-text">Usuarios</span>
          </a>
        </li>
        <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>
        <li class="nav-item <?php echo e(Request::segment(1) == 'products' ? 'active' : ''); ?>">
          <a href="/list-products" class="nav-link">
            <span class="sidebar-icon"><i class="fas fa-box"></i></span>
            <span class="sidebar-text">Productos</span>
          </a>
        </li>
        <li class="nav-item <?php echo e(Request::segment(1) == 'orders' ? 'active' : ''); ?>">
          <a href="/list-order" class="nav-link">
            <span class="sidebar-icon"><i class="fas fa-file-invoice"></i></span>
            <span class="sidebar-text">Pedidos</span>
          </a>
        </li>
        <li class="nav-item <?php echo e(Request::segment(1) == 'list-domiciliary' ? 'active' : ''); ?>">
          <a href="/list-domiciliary" class="nav-link">
            <span class="sidebar-icon"><i class="fas fa-user-check"></i></span>
            <span class="sidebar-text">Domiciliados</span>
          </a>
        </li>
        <li class="nav-item <?php echo e(Request::segment(1) == 'gift-sets' ? 'active' : ''); ?>">
          <a href="/gift-sets" class="nav-link">
            <span class="sidebar-icon"><i class="fas fa-gifts"></i></span>
            <span class="sidebar-text">Kits de regalos</span>
          </a>
        </li>
      <?php elseif(auth()->user()->role == 'client'): ?>
        <li class="nav-item <?php echo e(Request::segment(1) == 'orders' ? 'active' : ''); ?>">
          <a href="/orders" class="nav-link">
            <span class="sidebar-icon"><i class="fas fa-file-invoice"></i></span>
            <span class="sidebar-text">Pedidos</span>
          </a>
        </li>
      <?php else: ?>
        
      <?php endif; ?>
    </ul>
  </div>
</nav><?php /**PATH C:\laragon\www\app_laravel_subir\local\resources\views/layouts/sidenav.blade.php ENDPATH**/ ?>