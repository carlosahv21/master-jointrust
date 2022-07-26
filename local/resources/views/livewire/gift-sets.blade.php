@section('title','Kits de Regalo')

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
                    <li class="breadcrumb-item active" aria-current="page">Lista de Kits de REgalos</li>
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
                    <input wire:model="search" type="text" class="form-control" placeholder="Buscar Kit de regalo">
                </div>
            </div>
            <div class="col-3 col-lg-3 d-flex justify-content-end">
                <div class="dropdown px-2">
                    <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Acción masiva <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><button wire:click="selectItem('','masiveDelete')" class="dropdown-item btn-outline-gray-500 text-danger"><i class="fas fa-trash"></i> Eliminar</button></li>
                    </ul>
                </div>

                <button class="btn btn-secondary me-2 dropdown-toggle" wire:click="selectItem('', 'create')">
                    <span class="fas fa-plus"></span> Crear Kit de Regalo
                </button>
            </div>
        </div>
    </div>
    <div class="card shadow border-0 table-wrapper table-responsive">
        @if ($gift_sets->count())
            <div wire:loading.class="opacity-50">
                <table class="table order-table align-items-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>
                                <div class="form-check dashboard-check">
                                    <input class="form-check-input" type="checkbox" value="" id="giftsetsCheck55">
                                    <label class="form-check-label" for="giftsetsCheck55">
                                    </label>
                                </div>
                            </th>
                            <th>Nombre</th>
                            <th>Valor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gift_sets as $gift_set)
                            <tr>
                                <td>
                                    <div class="form-check dashboard-check">
                                        <input wire:model="selected" class="form-check-input" type="checkbox" value="{{ $gift_set->id }}">
                                        <label class="form-check-label" for="giftsetsCheck1">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    {{ ucfirst($gift_set->name) }}
                                </td>
                                <td>{{ $gift_set->value }}</td>
                                <td style="width: 5%;">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @if (auth()->user()->role == 'admin')
                                                <li>
                                                    <button wire:click="selectItem({{ $gift_set->id }}, 'update')" class="dropdown-item btn-outline-gray-500"><i class="fas fa-edit"></i> Editar</button>
                                                </li>
                                                <li>
                                                    <button wire:click="selectItem({{ $gift_set->id }}, 'delete')" class="dropdown-item btn-outline-gray-500 text-danger"><i class="fas fa-trash"></i> Eliminar</button>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end py-4">
                {{ $gift_sets->links()}}
            </div>
        @else
            <div class="d-flex justify-content-center py-6">
                <span class="text-gray-500"><i class="fas fa-archive"></i>  No hay kits de regalo para mostrar </span>
            </div>
        @endif
    </div>

      <!-- Modal Add-->
      <div wire:ignore.self class="modal fade" id="createGiftSet" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">{{$title_modal}}</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('gift-set-form')
                </div>
            </div>
        </div>
    </div>
     
    <!-- Modal Delete-->
    <div wire:ignore.self class="modal fade" id="deleteGiftSet" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Eliminar Kit de regalo</h2>
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
    <div wire:ignore.self class="modal fade" id="deleteGiftSetMasive" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Eliminar Kists de Regalos</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseas eliminar {{ $countGiftSets }} registros?
                </div>
                <div class="modal-footer">
                    <button wire:click="massiveDelete" class="btn btn-secondary">Eliminar</button>
                    <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    
</div>