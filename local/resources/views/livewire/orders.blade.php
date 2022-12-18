@section('title','Agregar Pedido')

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
                    <li class="breadcrumb-item active" aria-current="page">Agregar Pedido</li>
                </ol>
            </nav>
        </div>
    </div>

    <div>

        <div class="card border-0 shadow my-4">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8 col-xxl-6">
                    <div wire:ignore class="card-body row">
                        <div class="input-group me-2 me-lg-3">
                            <span class="input-group-text">
                                <span class="fas fa-search"></span>
                            </span>
                            <input wire:model="search" type="text" class="form-control" placeholder="Busca un producto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div  wire:ignore id="productosCarousel" class="carousel slide" data-bs-ride="carousel">
                @if ($products->count())
                    <div class="carousel-inner" role="listbox">
                    @foreach ($products as $product)
                        @if ($loop->first)
                        <div class="carousel-item active">
                            <div class="col-md-3 mb-3 px-2">
                                <div class="card">
                                    <img class="card-img-top img-fluid" alt="100%x280" src="{{ asset('local/public/images_products/'.$product->product_image) }}">
                                    <div class="card-body">
                                        <h5 style="margin-bottom:0;">{{ $product->name}} - {{ $product->reference}} </h5>
                                        <div class="card-text row">
                                            <div class="col-9" style="display: inline;margin-top: 8px;">
                                                <b>Precio:</b> $ {{ $product->price}} <br>
                                            </div>
                                            <div class="col-3">
                                                <a wire:click="addProduct({{ $product->id }},'{{ $product->name }}',{{ $product->price }}, '{{ $product->reference }}' )" class="text-secondary right" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Agregar al pedido"> 
                                                    <small>
                                                        <div class="icon-shape icon-xs icon-shape-secondary rounded">
                                                            <i class="fas fa-cart-plus" aria-hidden="true"></i>
                                                        </div>
                                                    </small>
                                                </a>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="carousel-item">
                                <div class="col-md-3 mb-3 px-2">
                                    <div class="card">
                                        <img class="card-img-top img-fluid" alt="100%x280" src="{{ asset('local/public/images_products/'.$product->product_image) }}">
                                        <div class="card-body">
                                            <h5 style="margin-bottom:0;">{{ $product->name}} - {{ $product->reference}} </h5>
                                            <div class="card-text row">
                                                <div class="col-9" style="display: inline;margin-top: 8px;">
                                                    <b>Precio:</b> $ {{ $product->price}} <br>
                                                </div>
                                                <div class="col-3">
                                                    <a wire:click="addProduct({{ $product->id }},'{{ $product->name }}',{{ $product->price }}, '{{ $product->reference }}' )" class="text-secondary right" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Agregar al pedido"> 
                                                        <small>
                                                            <div class="icon-shape icon-xs icon-shape-secondary rounded">
                                                                <i class="fas fa-cart-plus" aria-hidden="true"></i>
                                                            </div>
                                                        </small>
                                                    </a>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif                
                    @endforeach
                    </div>
                    <a class="carousel-control-prev bg-transparent w-aut" href="#productosCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next bg-transparent w-aut" href="#productosCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
            </div>
                @endif  
        </div>

        <div class="card border-0 table-wrapper table-responsive">
            <div>
                <table class="table product-table align-items-center" id='table-data'>
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th style="width: 20%;">Producto</th>
                            <th style="width: 10%">Cantidad</th>
                            <th style="width: 10%">Precio</th>
                            <th style="width: 10%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(Cart::instance('cart')->count() > 0)
                            @foreach (Cart::instance('cart')->content() as $item )
                                <tr>
                                    <td class="text-center">
                                        <div class="d-block">
                                            <span class="fw-bold">{{ strtoupper($item->name) }}</span>
                                            <div class="small text-gray">{{ $item->options->reference }} </div>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <button wire:click.ignore="decreaseQuantity('{{$item->rowId}}')" class="btn btn-outline-secondary" type="button"> <i class="fa fa-minus" aria-hidden="true"></i> </button>

                                            <input type="text" class="form-control" value="{{$item->qty}}" readonly>

                                            <button wire:click.ignore="increaseQuantity('{{$item->rowId}}')" class="btn btn-outline-secondary" type="button"> <i class="fa fa-plus" aria-hidden="true"></i> </button>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p> 
                                            <i class="fas fa-dollar-sign"></i>  {{ number_format($item->price,'2', ',', '.') }}
                                        </p>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-10 text-center">
                                                <p> 
                                                    <i class="fas fa-dollar-sign"></i> 
                                                    <span>
                                                        {{ number_format((float) $item->subtotal, '2', ',', '.')  }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div wire:click.prevent="removeProduct('{{$item->rowId}}')" class="col-2">
                                                <a class="item-delete text-danger"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                        <td colspan="4">
                                <div class="d-flex justify-content-center py-6">
                                    <span class="text-gray-500"><i class="fas fa-archive"></i> Aca mostraremos tus productos </span>
                                </div>
                            </td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card border-0 shadow components-section my-4">
            <div class="row">
                <div class="col-6 my-4 mx-4">
                    <div class="mt-2">
                        <label for="textarea">Comentarios</label>
                        <textarea class="form-control textarea" placeholder="Cuéntanos si tienes alguna sugerencias o recomendación especial." rows="4"></textarea>
                    </div>
                    <div class="mt-4 row">
                        <div class="col-6">
                            <label for="textarea">Fecha de entrega</label>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group" wire:ignore.defer="date_order">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar-day"></i>
                                    </span>
                                    <input data-date-order="@this" id="date_order" autocomplete="off" class="form-control datepicker" type="text" placeholder="dd/mm/yyyy">                                               
                                    <div id="dateOrderError" class="invalid-feedback" style="display:none">
                                        La fecha de entrega es requerida.
                                    </div>
                                </div>                                            
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 row">
                        <div class="col-6">
                            <label for="inputDeliveryAddress">Dirección de entrega</label>
                        </div>
                        <div class="col-6 text-center" >
                            <input wire:model="showAddress" type="text" class="form-control" disabled="disabled" placeholder="Aun no has seleccionado una dirección" id="inputDeliveryAddress">
                            <button wire:click="showShipping" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#defaultAddress">Selecciona tu dirección de entrega</button>
                        </div>
                    </div>
                    <div class="mt-4 row">
                        <div class="col-6">
                            <label for="textarea">¿Desea incluir kit de regalo?</label>
                        </div>
                        <div class="col-6">
                            <div class="row text-center">
                                <div class="col-6">
                                    <input wire:model="gift_check" class="form-check-input" type="radio" name="gift_check" value="si"> Si
                                </div>
                                <div class="col-6">
                                    <input wire:model="gift_check"   class="form-check-input" type="radio" name="gift_check" value="no"> No
                                </div>
                                <br>
                                <br>
                                <div class="col-12">
                                <select wire:ignore.self wire:model="gift" wire:change="changeGift($event.target.value)" class="form-select" style="display:none;" id="gift" >
                                        <option>Elegir</option>
                                        @foreach ($gift_sets as $gifts)
                                            <option value="{{ $gifts->id }}">{{ $gifts->name }} - $ {{ number_format( $gifts->value, '0', ',', '.') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-4 d-flex justify-content-end mb-4 py-4">
                    <div class="mt-4">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">
                                        <i class="fas fa-dollar-sign"></i> {{ number_format((float) Cart::instance('cart')->subtotal(), '2', ',', '.') }}
                                    </td>
                                </tr>
                                @if($this->valueGif)
                                    <tr>
                                        <td class="left">
                                            <strong>Kit de regalo</strong>
                                        </td>
                                        <td class="right">
                                            <i class="fas fa-dollar-sign"></i> {{ number_format((float)  $this->valueGif, '2', ',', '.') }}
                                        </td>
                                    </tr>
                                @endif
                                @if($this->valueShipping)
                                    <tr>
                                        <td class="left">
                                            <strong>Domicilio</strong>
                                        </td>
                                        <td class="right">
                                            <i class="fas fa-dollar-sign"></i> {{ number_format((float)  $this->valueShipping, '2', ',', '.') }}
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong><i class="fas fa-dollar-sign"></i>
                                            @php
                                                $cart = Cart::instance('cart')->total();

                                                if(($this->valueGif) && ($this->valueShipping)){
                                                    $op = $cart + $this->valueGif + $this->valueShipping;
                                                    echo number_format((float)  $cart + $this->valueGif + $this->valueShipping , '2', ',', '.') ;

                                                }elseif (!($this->valueGif) && ($this->valueShipping)) {
                                                    // $op = $cart + $this->valueShipping;
                                                    echo number_format((float) $cart + $this->valueShipping, '2', ',', '.') ;

                                                }elseif (($this->valueGif) && !($this->valueShipping)) {
                                                    // $op = $cart + $this->valueGif;
                                                echo number_format((float) $cart + $this->valueGif, '2', ',', '.') ;

                                                }else{
                                                    echo number_format((float) $cart , '2', ',', '.') ;
                                                }


                                            @endphp
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="right" colspan="2">
                                        <div class="mt-2">
                                            <p>¿Aceptarías recibir una entrega parcial de tu pedido?</p>
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <input wire:model="radioButtom" class="form-check-input" type="radio" name="delivery" value="si" > Si                
                                                </div>
                                                <div class="col-6">
                                                    <input wire:model="radioButtom" class="form-check-input" type="radio" name="delivery" value="no" > No
                                                </div>
                                            </div>
                                            @error($radioButtom) 
                                            <div class="invalid-feedback text-center">
                                                {{ $message }}
                                            </div>    
                                        @enderror
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="2">
                                        <button wire:click="cancel" type="button" class="btn btn-link text-gray-600">Cancelar</button>
                                        <button wire:click="resume" class="btn btn-secondary" >Hacer pedido</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </div>
<div>
<!-- Modal Cancel-->
<div wire:ignore.self class="modal fade" id="cancelOrder" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                ¡Estas a punto de cancelar tu pedido! ¿estas seguro?
            </div>
            <div class="modal-footer">
                <button wire:click="accept" type="button" class="btn btn-secondary">Aceptar</button>
                <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Resume-->
<div wire:ignore.self class="modal fade" id="resumeOrder" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Resumen de tu pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            <div class="modal-body text-center">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th style="width: 20%;">Producto</th>
                            <th style="width: 10%">Cantidad</th>
                            <th style="width: 10%">Precio</th>
                            <th style="width: 10%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::instance('cart')->content() as $item )
                            <tr>
                                <td class="text-center">
                                    <div class="d-block">
                                        <span class="fw-bold">{{ strtoupper($item->name) }}</span>
                                        <div class="small text-gray">{{ $item->options->reference }} </div>
                                    </div>
                                    
                                </td>
                                <td>
                                    <p> 
                                        <span class="fw-bold">{{$item->qty}}</span>
                                    </p>
                                </td>
                                <td class="text-center">
                                    <p> 
                                        <i class="fas fa-dollar-sign"></i>  {{ number_format((float)$item->price,'2',',','.') }}
                                    </p>
                                </td>
                                <td>
                                    <p> 
                                        <i class="fas fa-dollar-sign"></i> {{ number_format((float)$item->subtotal,'2',',','.') }}

                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end text-right">
                    <div class="mt-4">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">
                                        <i class="fas fa-dollar-sign"></i> {{ number_format((float) Cart::instance('cart')->subtotal(),'2',',','.') }}
                                    </td>
                                </tr>
                                @if($this->valueGif)
                                    <tr>
                                        <td class="left">
                                            <strong>Kit de regalo</strong>
                                        </td>
                                        <td class="right">
                                            <i class="fas fa-dollar-sign"></i> {{ number_format((float)  $this->valueGif, '2', ',', '.') }}
                                        </td>
                                    </tr>
                                @endif
                                @if($this->valueShipping)
                                    <tr>
                                        <td class="left">
                                            <strong>Domicilio</strong>
                                        </td>
                                        <td class="right">
                                            <i class="fas fa-dollar-sign"></i> {{ number_format((float)  $this->valueShipping, '2', ',', '.') }}
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong><i class="fas fa-dollar-sign"></i>
                                            @php
                                                $cart = Cart::instance('cart')->total();

                                                if(($this->valueGif) && ($this->valueShipping)){
                                                    $op = $cart + $this->valueGif + $this->valueShipping;
                                                    echo number_format((float)  $cart + $this->valueGif + $this->valueShipping , '2', ',', '.') ;

                                                }elseif (!($this->valueGif) && ($this->valueShipping)) {
                                                    // $op = $cart + $this->valueShipping;
                                                    echo number_format((float) $cart + $this->valueShipping, '2', ',', '.') ;

                                                }elseif (($this->valueGif) && !($this->valueShipping)) {
                                                    // $op = $cart + $this->valueGif;
                                                echo number_format((float) $cart + $this->valueGif, '2', ',', '.') ;

                                                }else{
                                                    echo number_format((float) $cart , '2', ',', '.') ;
                                                }
                                            @endphp
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button wire:click="save" type="button" class="btn btn-secondary">Aceptar</button>
                <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Alert Different Date-->
<div wire:ignore.self class="modal fade" id="differentDate" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                Sr. (a) {{ auth()->user()->first_name .' '. auth()->user()->last_name}} su pedido queda programado con prioridad, sin embargo, dependemos de la cosecha diaria y en ocasiones el clima nos afecta. Le informaremos oportunamente cualquier novedad.
            </div>
            <div class="modal-footer">
                <button wire:click="acceptPopup" type="button" class="btn btn-secondary">Aceptar</button>
                <button type="button" class="btn btn-link text-gray-600 " data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Alert Validate Stock-->
<div wire:ignore.self class="modal fade" id="validateStock" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                Sr. (a) {{ auth()->user()->first_name .' '. auth()->user()->last_name}}, la cantidad que estas solicitando es mayor a nuestro stock.
            </div>
            <div class="modal-footer">
                <button type="button"  data-bs-dismiss="modal" class="btn btn-secondary">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Select address to shipping-->
<div  wire:ignore.self class="modal fade" id="defaultAddress" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">Selecciona tu dirección de entrega</h2>
            </div>
            <div class="modal-body" style="padding-bottom: 0;">
                @if ( count($this->addresses) )
                    @foreach ($this->addresses as $address)
                        <div class="d-flex align-items-center justify-content-between pb-1 row">
                            <div class="col-10 h6 mb-0 d-flex align-items-center">
                                    <div class="form-check dashboard-check">
                                        <input wire:model.ignore="delivery_address" class="form-check-input" type="radio" value="{{ $address->id }}" id="address-{{ $address->id }}">
                                        <label class="form-check-label" for="address-{{ $address->id }}">
                                            {{ $address->address}}
                                        </label>
                                    </div>
                                </div>
                            <div class="col-1">
                                @if ($address->favorite)
                                    <i class="fas fa-star" style="color: #FBA918" title="Dirección favorita"></i>
                                @endif
                            </div>
                            <div class="col-1">
                            </div>
                        </div>
                    @endforeach
                @else
                    No tienes direcciones configuradas
                @endif
                
            </div>
            <div class="modal-footer">
                <button wire:click="selectShipping" type="button" data-bs-dismiss="modal" class="btn btn-secondary">Seleccionar</button>
                <button onclick="createAddress()" type="button" class="btn btn-link text-gray-600">Crear dirección</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Alert Empty Shipping-->
<div wire:ignore.self class="modal fade" id="alertShipping" tabindex="-1" aria-labelledby="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                Sr. (a) {{ auth()->user()->first_name .' '. auth()->user()->last_name}}, la dirección seleccionada no cuneta con un domicilio configurado. Quedara guardada su dirección y se le asignara uno antes de realizar su domicilio.
            </div>
            <div class="modal-footer">
                <button type="button"  data-bs-dismiss="modal" class="btn btn-secondary">Aceptar</button>
            </div>
        </div>
    </div>
</div>
@include('livewire.form_orders')