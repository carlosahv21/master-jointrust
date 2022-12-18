@section('title','Domiciliarios')

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
                    <li class="breadcrumb-item active" aria-current="page">Lista de Domiciliarios</li>
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
            <div class="col-9 col-lg-9 d-md-flex">
                <div class="input-group me-2 me-lg-3 fmxw-300">
                    <span class="input-group-text">
                        <span class="fas fa-search"></span>
                    </span>
                    <input wire:model="search" type="text" class="form-control" placeholder="Buscar domiciliado">
                </div>
            </div>
            <div class="col-3 col-lg-3 d-flex justify-content-end">
                <button wire:click="selectItem('', 'sendRoute')" class="btn btn-secondary "> <i class="fas fa-route"></i> Enviar ruta</button>
            </div>
        </div>
    </div>
    <div class="card shadow border-0 table-wrapper table-responsive">
        @if ($orders_domiciliaries->count())
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
                            <th>Usuario asignado</th>
                            <th>Dirección de entrega</th>
                            <th>Cliente</th>
                            <th>Fecha de asignación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{ $orders_domiciliaries }}
                        @foreach ($orders_domiciliaries as $order)

                            <tr>
                                <td>
                                    <div class="form-check dashboard-check">
                                        <input class="form-check-input" type="checkbox" value="" id="orderCheck1">
                                        <label class="form-check-label" for="orderCheck1">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    {{  $order->orders->code }}
                                </td>
                                <th>{{ ucfirst($order->user->first_name) }} {{ ucfirst($order->user->last_name) }}</th>
                                <th>{{ $order->orders->address->address }}</th>
                                <th>{{ ucfirst($order->orders->user->first_name) }} {{ ucfirst($order->orders->user->last_name) }}</th>
                                <th>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y')  }}</th>
                                <th style="width: 5%;">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @if ($order->role != 'admin')
                                                <li>
                                                    <button wire:click="selectItem({{ $order->id }}, 'delete')" class="dropdown-item btn-outline-gray-500 text-danger"><i class="fas fa-trash"></i> Eliminar</button>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="d-flex justify-content-center py-6">
                <span class="text-gray-500"><i class="fas fa-archive"></i>  No hay domiciliarios para mostrar </span>
            </div>
        @endif
    </div>
    @if($orders_domiciliaries->links())
        <div class="d-flex justify-content-end py-4">
            {{ $orders_domiciliaries->links()}}
        </div>
    @endif
     
    <!-- Modal Delete-->
    <div wire:ignore.self class="modal fade" id="deleteDomiciliary" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Eliminar Domiciliado</h2>
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
    <!-- Modal sendRoute-->
    <div wire:ignore.self class="modal fade" id="sendRoute" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Seleccionar Domiciliario para enviar ruta</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 p-2">
                        @foreach ($users as $user)
                            <div class="d-flex align-items-center justify-content-between pb-1 row">
                                <div class="col-9 h6 mb-0 d-flex align-items-center">
                                        <div class="form-check dashboard-check">
                                            <label class="form-check-label" for="address">
                                                {{ $user->first_name}} {{$user->last_name}}
                                            </label>
                                        </div>
                                    </div>
                                <div class="col-3">
                                    <button class="btn btn-secondary me-2" onclick="sendWhatsapp(this, {{ $user->id }} , 'sendRouteWhatsapp')" data-bs-dismiss="modal" class="btn btn-secondary">Enviar</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>