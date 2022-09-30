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
          <a class="nav-link text-dark notification-bell @if(count(auth()->user()->unreadNotifications)) unread @endif dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <svg class="icon icon-sm text-gray-900" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
              </path>
            </svg>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center mt-2 py-0 notify">
            <div class="list-group list-group-flush">
              <h6 href="#" class="text-center text-primary fw-bold py-2">Notificaciones</h6>
              <div role="separator" class="dropdown-divider my-0"></div>
              @forelse (auth()->user()->unreadNotifications as $notifications)
                <a href="/view-order/{{encrypt($notifications->data['id'])}}/{{$notifications->id}}" class="list-group-item list-group-item-action border-bottom">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <!-- Avatar -->
                      <img alt="Image placeholder" src="https://cdn-icons-png.flaticon.com/512/7132/7132915.png" class="avatar-md rounded">
                    </div>
                    <div class="col ps-0 ms-2">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <h4 class="h6 mb-0 text-small">{{ $notifications->data['user'] }}</h4>
                        </div>
                        <div class="text-end">
                          <small class="text-danger">{{ \Carbon\Carbon::parse($notifications->created_at)->diffForHumans() }}</small>
                        </div>
                      </div>
                      <p class="font-small mt-1 mb-0">{{ $notifications->data['title'] }}</p>
                    </div>
                  </div>
                </a>
              @empty
                <h6 class="text-center text-primary fw-bold py-3"> No tienes notificaciones</h6>
              @endforelse
              @if(count(auth()->user()->unreadNotifications))
                <a href="{{ route('markAsRead')}}" class="dropdown-item text-center fw-bold rounded-bottom py-3">
                  <svg class="icon icon-xxs text-gray-400 me-1" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                    <path fill-rule="evenodd"
                      d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                      clip-rule="evenodd"></path>
                  </svg>
                  Ver todos
                </a>
              @endif
            </div>
          </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link text-dark dropdown-toggle" 
            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fas fa-plus"></span>
          </a>
          <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1 shadow-lg">
            @if (auth()->user()->role == 'admin')
              <a href="{{ route('users') }}" class="dropdown-item"> <i class="fas fa-users" aria-hidden="true"></i> Agregar Cliente</a>
              <div role="separator" class="dropdown-divider my-1"></div>
              <a class="dropdown-item"> <i class="fas fa-box" aria-hidden="true"></i> Agregar Producto</a>
            @elseif(auth()->user()->role == 'client')
              <a href="{{ route('orders') }}" class="dropdown-item"> <i class="fas fa-file-invoice" aria-hidden="true"></i> Agregar Pedido</a>
              <div role="separator" class="dropdown-divider my-1"></div>
              <a class="dropdown-item" id="addReferrals"> <i class="fas fa-users" aria-hidden="true"></i> Agregar Referido</a>
              <div role="separator" class="dropdown-divider my-1"></div>
              <a class="dropdown-item" id="addAddress"> <i class="far fa-address-card"></i> Agregar Direcci&oacute;n </a>
            @else

            @endif
          </div>
        </li>
        <li class="nav-item dropdown ms-lg-3">
          <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <div class="media d-flex align-items-center">
              @if(auth()->user()->user_image)
              <img class="avatar rounded-circle" alt="Imagen Perfil" src="{{ asset('local/storage/app/images_profile/'.auth()->user()->user_image) }}">   
              @else
              <img class="avatar rounded-circle" alt="Imagen Perfil" src="{{ asset('public/assets/img/team/profile-picture-1.jpg') }}">
              @endif
              <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                <span
                  class="mb-0 font-small fw-bold text-gray-900">{{  auth()->user()->first_name ? auth()->user()->first_name . ' ' . auth()->user()->last_name : 'User Name'}}</span>
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
              <livewire:logout /></a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Modal Advertisement-->
<div wire:ignore.self class="modal fade" id="advertisement" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h2 class="h6 modal-title">Invitar Amigo</h2>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              @livewire('guests')
          </div>
      </div>
  </div>
</div>
<!-- Modal Address-->
<div wire:ignore.self class="modal fade" id="address" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h2 class="h6 modal-title">Agregar dirección</h2>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              @livewire('addresses')
          </div>
      </div>
  </div>
</div>