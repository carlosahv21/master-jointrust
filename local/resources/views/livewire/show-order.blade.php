@section('title', 'Pedido '.$order['code'])
<x-layouts.base>
    {{-- Nav --}}
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')
    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
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
                        <li class="breadcrumb-item active" aria-current="page">Resumen del Pedido</li>
                    </ol>
                </nav>
            </div>
        </div>
        
        <div class="table-settings mb-4">
            <div class="row justify-content-between align-items-center">
                <div class="col-9 col-lg-9 d-md-flex">

                </div>
                <div class="col-3 col-lg-3 d-flex justify-content-end">
                    <button class="btn btn-secondary me-2 dropdown-toggle">
                        <i class="fas fa-file-pdf"></i> Descargar
                    </button>
                    @if ($order['state'] != 'Entregado')
                        <button class="btn btn-info me-2 dropdown-toggle" onclick="sendWhatsapp(this, {{ $order['id'] }} , 'confirmation')" data-url="confirmation">
                            <span class="fas fa-sms"></span> Confirmar pedido
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @if ($order)
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-xl-9">
                    <div class="card shadow border-0 p-4 p-md-5 position-relative">
                        <div class="d-flex justify-content-between pb-4 pb-md-5 mb-4 mb-md-5 border-bottom border-light">
                            <img class="image-md" src="../../assets/img/brand/light.svg" alt="Rocket Logo" width="30" height="30">
                            <div>
                                <h4>Volt LLC.</h4>
                                <ul class="list-group simple-list">
                                    <li class="list-group-item fw-normal">112 Washington Square</li>
                                    <li class="list-group-item fw-normal">New York, USA</li>
                                    <li class="list-group-item fw-normal"><a class="fw-bold text-primary" href="#">company@themesberg.com</a></li>
                                </ul> 
                            </div>
                        </div>
                        <div class="mb-6 d-flex align-items-center justify-content-center">
                            <h2 class="h1 mb-0">Pedido #{{ $order['code'] }}</h2>
                            <span class="badge badge-lg ms-4" style="background-color:@if ($order['state'] == 'Pendiente') #FBA918 @elseif ($order['state'] == 'En Ruta') #11cdef @elseif ($order['state'] == 'Entregado') #10B981 @elseif ($order['state'] == 'No Entregado') #E11D48 @endif">{{$order['state']}}</span>
                        </div>
                        <div class="row justify-content-between mb-4 mb-md-5">
                            <div class="col-sm">
                                <h5>Client Information:</h5>
                                <div>
                                    <ul class="list-group simple-list">
                                        <li class="list-group-item fw-normal">{{ ucfirst($user['first_name']) }} {{ ucfirst($user['last_name']) }}</li>
                                        <li class="list-group-item fw-normal">{{ ucfirst($user['address']) }}, {{ ucfirst($user['neighborhood']) }}, {{ ucfirst($user['city']) }}</li>
                                        <li class="list-group-item fw-normal"><a class="fw-bold text-primary" href="#">{{ ucfirst($user['email']) }}</a></li>
                                    </ul> 
                                </div>
                            </div>
                            <div class="col-sm col-lg-4">
                                <dl class="row text-sm-right">
                                    {{-- <dt>&nbsp;</dt> --}}
                                    <dt class="col-6"><strong>Pedido No.</strong> </dt>
                                    <dd class="col-6">{{ str_replace("ORDER_", "", $order['code']) }}</dd>
                                    <dt class="col-6"><strong>Fecha de creación:</strong>
                                    </dt>
                                    <dd class="col-6">{{ \Carbon\Carbon::parse($order['created_at'])->format('d/m/Y') }}</dd>
                                    <dt class="col-6"><strong>Fecha de Entrega:</strong>
                                    </dt>
                                    <dd class="col-6">{{ \Carbon\Carbon::parse($order['date_order'])->format('d/m/Y')}}</dd>
                                    <dt class="col-6"><strong>Direcci&oacute;n de Entrega:</strong>
                                    </dt>
                                    <dd class="col-6">{{ $address['address'] }}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="bg-light border-top">
                                            <tr>
                                                <th scope="row" class="border-0 text-left">
                                                    Imagen
                                                </th>
                                                <th scope="row" class="border-0">
                                                    Nombre del producto
                                                </th>
                                                <th scope="row" class="border-0">
                                                    Precio unitario
                                                </th> 
                                                <th scope="row" class="border-0">
                                                    Cantidad
                                                </th>
                                                <th scope="row" class="border-0">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order_data as $item)
                                            <tr>
                                                <th scope="row" class="text-left fw-bold h6">
                                                    <img class="image-md" src="{{ asset('local/public/images_products/'.$item->product_image) }}">
                                                </th>
                                                <td>
                                                    {{ $item->name }}
                                                </td>
                                                <td>
                                                    <i class="fas fa-dollar-sign" aria-hidden="true"></i> {{ number_format($item->price,'2',',','.')  }}
                                                </td>
                                                <td>
                                                    {{ $item->qty  }}
                                                </td>
                                                <td>
                                                    <i class="fas fa-dollar-sign" aria-hidden="true"></i> {{ number_format($item->qty * $item->price,'2',',','.')  }}
                                                </td>
                                            </tr> 
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end text-right mb-4 py-4">
                                    <div class="mt-4">
                                        <table class="table table-clear">
                                            <tbody>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Subtotal</strong>
                                                    </td>
                                                    <td class="right"> <i class="fas fa-dollar-sign" aria-hidden="true"></i> {{ number_format($order['subtotal'],'2',',','.') }}</td>
                                                </tr>
                                                @if ($shipping)
                                                    <tr>
                                                        <td class="left">
                                                            <strong>Domicilio</strong>
                                                        </td>
                                                        <td class="right"> <i class="fas fa-dollar-sign" aria-hidden="true"></i> {{ number_format($shipping['value'],'2',',','.') }}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td class="left">
                                                            <strong>Domicilio</strong>
                                                        </td>
                                                        <td class="right"> <strong> Este domicilio no tiene zona asignada </strong></td>
                                                    </tr>
                                                @endif

                                                @if( $order['gift_sets'] )
                                                    <tr>
                                                        <td class="left">
                                                            <strong>Kit de regalo</strong>
                                                        </td>
                                                        <td class="right"><i class="fas fa-dollar-sign" aria-hidden="true"></i> {{ number_format($gift_set['value'],'2',',','.')}}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td class="left">
                                                        <strong>Total</strong>
                                                    </td>
                                                    <td class="right">
                                                        <strong>
                                                            <i class="fas fa-dollar-sign" aria-hidden="true"></i>

                                                            @if( ($gift_set['value']) && $shipping)
                                                                {{ number_format($order['total'] + $gift_set['value'] + $shipping['value'],'2',',','.') }}
                                                            @elseif( !($gift_set['value']) && ($shipping))
                                                                {{ number_format($order['total'] + $shipping['value'],'2',',','.') }}
                                                            @elseif( ($gift_set['value']) && !($shipping))
                                                                {{ number_format($order['total'] + $gift_set['value'] ,'2',',','.') }}
                                                            @else
                                                                @if( $shipping )
                                                                    {{ number_format($order['total'] + $shipping['value'],'2',',','.') }}
                                                                @else
                                                                    {{ number_format($order['total'] ,'2',',','.') }}
                                                                @endif
                                                            @endif
                                                        </strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <h4>Comentarios</h4>
                                <span>{{ $order['commentaries'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
        @endif
        
        {{-- Footer --}}
        @include('layouts.footer')
    </main>
    <!-- Modal Alert Empty Shipping-->
    <div wire:ignore.self class="modal fade" id="alertAddrees" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    Sr. (a) {{ auth()->user()->first_name .' '. auth()->user()->last_name}}, la dirección de entrega de este pedido no cuenta con un domicilio configurado. Para poder confirmar el pedido configura una Zona a la dirección.
                </div>
                <div class="modal-footer">
                    <button type="button" id="goSetZone" class="btn btn-secondary" data-bs-dismiss="modal">Configurar Zona</button>
                    <button type="button" class="btn btn-link text-gray-600" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</x-layouts.base>
