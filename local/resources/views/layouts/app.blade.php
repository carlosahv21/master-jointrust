<x-layouts.base>

    @if(in_array(request()->route()->getName(), ['dashboard', 'profile', 'products', 'users', 'orders','list-order' ,'bootstrap-tables', 'transactions',
    'buttons', 'forms', 'modals', 'notifications', 'typography', 'upgrade-to-pro', 'list-domiciliary', 'gift-sets','shippings']))

    {{-- Nav --}}
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')
    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
        {{ $slot }}
        {{-- Footer --}}
        @include('layouts.footer')
    </main>

    @elseif(in_array(request()->route()->getName(), ['register', 'register-example', 'login', 'login-example',
    'forgot-password', 'forgot-password-example', 'reset-password','confirm-email/']))

    {{ $slot }}
    {{-- Footer --}}
    @include('layouts.footer2')


    @elseif(in_array(request()->route()->getName(), ['404', '500', 'lock']))

    {{ $slot }}

    @endif
</x-layouts.base>