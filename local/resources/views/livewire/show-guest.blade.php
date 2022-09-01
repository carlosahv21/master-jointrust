@section('title', 'Referidos')
<x-layouts.base>
    {{-- Nav --}}
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')
    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
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
                            <li class="breadcrumb-item active" aria-current="page">Lista de Referidos</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="table-settings mb-4">
                <input type="hidden" id="some">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-lg-12 d-md-flex justify-content-end">
                        <a href="javascript:history.back()" class="btn btn-secondary me-2 dropdown-toggle"> Volver</a>
                    </div>
                </div>
            </div>
            <div class="card shadow border-0 table-wrapper table-responsive">
                @if ($guests)
                    <div wire:loading.class="opacity-50">
                        <table class="table order-table align-items-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>
                                        <div class="form-check dashboard-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="giftsetsCheck55">
                                            <label class="form-check-label" for="giftsetsCheck55">
                                            </label>
                                        </div>
                                    </th>
                                    <th>Nombre</th>
                                    <th>Tel&eacute;fono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guests as $guest)
                                    <tr>
                                        <td>
                                            <div class="form-check dashboard-check">
                                                <input wire:model="selected" class="form-check-input" type="checkbox"
                                                    value="{{ $guest->id }}">
                                                <label class="form-check-label" for="giftsetsCheck1">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            {{ ucfirst($guest->guest_name) }}
                                        </td>
                                        <td>{{ $guest->guest_phone }}</td>
                                        <td style="width: 5%;">
                                            <button data-id="{{ $guest->id }}" class="btn btn-secondary inviteReferrals"  id="inviteReferrals{{ $guest->id }}"> <i class="fas fa-sms"></i> Invitar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="d-flex justify-content-center py-6">
                        <span class="text-gray-500"><i class="fas fa-archive"></i> No hay Referidos para mostrar
                        </span>
                    </div>
                @endif
            </div>

        </div>
        {{-- Footer --}}
        @include('layouts.footer')
    </main>
</x-layouts.base>


<!-- {{ var_dump($guests) }} -->
