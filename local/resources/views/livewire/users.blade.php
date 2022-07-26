@section('title','Usuario')

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
        {{-- <div class="btn-toolbar mb-2 mb-md-0">
            <button class="btn btn-secondary me-2 dropdown-toggle" data-bs-toggle="modal" data-bs-target="#createUser">
                <span class="fas fa-plus"></span> Crear Usuarios
            </button>
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">Share</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">Export</button>
            </div>
        </div> --}}
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
            {{-- <div class="col-3 col-lg-3 d-md-flex">
                <select class="form-select fmxw-200" aria-label="Message select example">
                    <option selected>Bulk Action</option>
                    <option value="1">Send Email</option>
                    <option value="2">Change Group</option>
                    <option value="3">Delete User</option>
                </select>
                <button class="btn btn-sm px-3 btn-secondary ms-3">Apply</button>
            </div> --}}
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
        @if ($users->count())
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
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="form-check dashboard-check">
                                        <input class="form-check-input" type="checkbox" value="" id="userCheck1">
                                        <label class="form-check-label" for="userCheck1">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="d-flex align-items-center">
                                        @if($user->user_image)
                                        <img src="{{ Storage::disk('images_profile')->url($user->user_image) }}" class="avatar rounded-circle me-3" alt="{{  $user->first_name ." ". $user->last_name}}">
                                        @else
                                        <img src="../assets/img/team/profile-picture-1.jpg" class="avatar rounded-circle me-3"
                                            alt="Avatar">
                                        @endif
                                        <div class="d-block">
                                            <span class="fw-bold">{{ $user->first_name . " ". $user->last_name }}</span>
                                            <div class="small text-gray">{{ $user->email }}</div>
                                        </div>
                                    </a>
                                </td>
                                <th>{{ $user->role }}</th>
                                <th>{{ $user->address }}</th>
                                <th style="width: 5%;">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a wire:click="selectItem({{ $user->id }}, 'update')" class="dropdown-item btn-outline-gray-500"><i class="fas fa-edit"></i> Editar</a></li>
                                        @if ($user->role != 'admin')
                                            <li><button wire:click="selectItem({{ $user->id }}, 'delete')" class="dropdown-item btn-outline-gray-500 text-danger"><i class="fas fa-trash"></i> Eliminar</button></li>
                                            <li><button wire:click="selectItem({{ $user->id }}, 'seeReferrals')" class="dropdown-item btn-outline-gray-500"><i class="fas fa-eye"></i> Ver Referidos</button></li>
                                        @endif
                                        </ul>
                                    </li>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end py-4">
                {{ $users->links()}}
            </div>
        @else
            <div class="d-flex justify-content-center py-6">
                <span class="text-gray-500"><i class="fas fa-archive"></i>  No hay usuarios para mostrar </span>
            </div>
        @endif
    </div>
    <!-- Modal Add-->
    <div wire:ignore.self class="modal fade" id="createUser" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">{{$title_modal}}</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('user-form')
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
    <div wire:ignore.self class="modal fade" id="seeReferrals" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Ver Referidos</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <table class="table user-table align-items-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Telef&oacute;no</th>
                            <th>Invitaci&oacute;n</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->referrals as $referrals)
                            <tr>
                                <th>{{ $referrals->guest_name }}</th>
                                <th>{{ $referrals->guest_phone }}</th>
                                @if ($referrals->guest)
                                    <th> 
                                        <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                            <i class="fas fa-user-check"></i>
                                        </div>    
                                    </th>
                                @else
                                    <th> <button wire:click.ignore="inviteReferrals( {{$referrals->id}} )" class="btn btn-secondary"> <i class="fas fa-sms"></i> Invitar</button></th>
                                @endif
                            </tr>
                        @endforeach
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

<script src="{{asset('public/assets/js/users.js') }}"></script>