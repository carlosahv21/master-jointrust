@section('title','Pedidos')

<div>
    <input type="hidden" id="text_copy">
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
                    <li class="breadcrumb-item active" aria-current="page">Lista de Pedidos</li>
                </ol>
            </nav>
        </div>
        {{-- <div class="btn-toolbar mb-2 mb-md-0">
            <button class="btn btn-secondary me-2 dropdown-toggle" data-bs-toggle="modal" data-bs-target="#createOrder">
                <span class="fas fa-plus"></span> Crear Pedidos
            </button>
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">Share</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">Export</button>
            </div>
        </div> --}}
    </div>

    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-8 col-lg-6 d-flex">
                <div class="input-group me-2 me-lg-3" style="width: 40%;">
                    <span class="input-group-text"> 
                        <span class="fas fa-search"></span>
                    </span>
                    <input wire:model.debounce.350ms="search" type="text" class="form-control" placeholder="Buscar pedido">
                </div>
                <div class="col-1 d-flex me-lg-3">
                    <select wire:model="perPage" class="form-select mb-0" id="entries" aria-label="Entries per page">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-2 d-flex me-lg-3">
                    <select wire:model="statusFilter" class="form-select mb-0" id="entries" aria-label="Entries per page">
                        <option value="Todos"> Todos </option>
                        <option value="Pendiente"> Pendientes </option>
                        <option value="En Ruta"> En Ruta </option>
                        <option value="Entregado"> Entregados </option>
                        <option value="No Entregado"> No Entregados </option>
                    </select>
                </div>
                <div class="col-2 d-flex">
                    <select wire:model="dateBetween" wire:change="changeDate($event.target.value)" class="form-select mb-0" id="entries" aria-label="Date select">
                        <option value="all"> Todos</option>
                        <option value="today"> Hoy </option>
                        <option value="week"> Esta semana </option>
                        <option value="month"> Este mes</option>
                        <option value="last_month"> Mes Anterior</option>
                    </select>
                </div>
            </div>

            <div class="col-3 col-lg-3 d-flex justify-content-end">
                <a href="/orders"  class="btn btn-secondary me-2 dropdown-toggle" >
                    <span class="fas fa-plus"></span> Crear Pedidos
                </a>
            </div>
        </div>
    </div>
    <div class="card shadow border-0 table-wrapper table-responsive">
        @if ($orders->count())
            <div wire:loading.class="opacity-50">
                <table class="table order-table align-items-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>
                                <div class="form-check dashboard-check">
                                    <input class="form-check-input" type="checkbox" value="" id="orderCheck55">
                                    <label class="form-check-label" for="orderCheck55">
                                    </label>
                                </div>
                            </th>
                            <th>Referencia del pedido</th>
                            <th>Total</th>
                            <th>Fecha de Entrega</th>
                            @if (auth()->user()->role == 'admin')
                                <th>Cliente</th>
                            @endif
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @if (auth()->user()->role == 'admin')
                                <tr>
                                    <td>
                                        <div class="form-check dashboard-check">
                                            <input class="form-check-input" type="checkbox" value="" id="orderCheck{{ $order->id }}">
                                            <label class="form-check-label" for="orderCheck{{ $order->id }}">
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $order->code }}
                                    </td>
                                    <th> <i class="fas fa-dollar-sign"></i> {{ number_format($order->total,'2',',','.')  }}</th>
                                    <th>{{ $order->date_order }}</th>
                                    <th>{{ ucfirst($order->user->first_name) }} {{ ucfirst($order->user->last_name) }}</th>
                                    <th>
                                        <span class="badge text-white" style="background-color:@if ($order->state == 'Pendiente') #FBA918 @elseif ($order->state == 'En Ruta') #11cdef @elseif ($order->state == 'Entregado') #10B981 @elseif ($order->state == 'No Entregado') #E11D48 @endif">{{ $order->state }} </span>
                                    </th>
                                    <th style="width: 5%;">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <li>
                                                    <a wire:click="selectItem({{ $order->id }}, 'update')" class="dropdown-item btn-outline-gray-500"><i class="fas fa-edit"></i> Editar</a></li>
                                                    <li>
                                                        <button wire:click="selectItem({{ $order->id }}, 'assignDomiciliary')" class="dropdown-item btn-outline-gray-500"><i class="fas fa-user-check"></i> Asignar Domiciliario</button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item btn-outline-gray-500 confirmation" data-id="{{ $order->id }}"><i class="fas fa-sms"></i> Confirmar pedido</button>
                                                    </li>
                                                    <li>
                                                        <button wire:click="selectItem({{ $order->id }}, 'delete')" class="dropdown-item btn-outline-gray-500 text-danger"><i class="fas fa-trash"></i> Eliminar</button>
                                                    </li>
                                            </ul>
                                        </li>
                                    </th>
                                </tr>
                            @else
                                <tr>
                                    <td>
                                        <div class="form-check dashboard-check">
                                            <input class="form-check-input" type="checkbox" value="" id="orderCheck1">
                                            <label class="form-check-label" for="orderCheck1">
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $order->code }}
                                    </td>
                                    <th> <i class="fas fa-dollar-sign"></i> {{ number_format($order->total,'2',',','.')  }}</th>
                                    <th>{{ $order->date_order }}</th>
                                    <th> <span class="badge text-white" style="background-color:@if ($order->state == 'Pendiente') #FBA918 @elseif ($order->state == 'En Ruta') #11cdef @elseif ($order->state == 'Entregado') #10B981 @elseif ($order->state == 'No Entregado') #E11D48 @endif">{{ $order->state }} </span> </th>
                                    <th style="width: 5%;">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <li>
                                                    <a wire:click="selectItem({{ $order->id }}, 'comments')" class="dropdown-item btn-outline-gray-500"><i class="fas fa-edit"></i> Comentarios</a></li>
                                            </ul>
                                        </li>
                                    </th>
                                </tr>
                            @endif
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        @else
            <div class="d-flex justify-content-center py-6">
                <span class="text-gray-500"><i class="fas fa-archive"></i>  No hay pedidos para mostrar </span>
            </div>
        @endif
    </div>
    @if($orders->links())
        <div class="d-flex justify-content-end py-4">
            {{ $orders->links()}}
        </div>
    @endif
    <!-- Modal Add-->
    <div wire:ignore.self class="modal fade" id="createOrder" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Crear Pedidos</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- @livewire('order-form') --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Delete-->
    <div wire:ignore.self class="modal fade" id="deleteOrder" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Eliminar Pedidos</h2>
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
    <div wire:ignore.self class="modal fade" id="deleteOrderMasive" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Eliminar Pedidos</h2>
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
    <!-- Modal Assign Domiciliary-->
    <div wire:ignore.self class="modal fade" id="assignDomiciliary" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Asignar Domicialiario</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 p-2">
                        <label for="inputIdDomiciliary" class="form-label">Usuarios <span class="text-danger"> *</span></label>
                        <select wire:model="idDomiciliary" id="inputIdDomiciliary" class="form-control">
                            <option disabled="" selected>Elegir</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->first_name}} {{$user->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button wire:click="saveDomiciliary" class="btn btn-secondary">Guardar</button>
                    <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Costumer's Commentaries-->
    <div wire:ignore.self class="modal fade" id="costumersCommentaries" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Comentarios del Pedido</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 p-2">
                        {{ $this->commentaries }}
                        <label for="inputIdDomiciliary" class="form-label">Comentario <span class="text-danger"> *</span></label>
                        <textarea wire:model.defer="commentaries" style="resize: none;" id="inputCommentaries" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="saveCommentaries" class="btn btn-secondary">Guardar</button>
                    <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>