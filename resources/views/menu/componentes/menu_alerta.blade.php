@Auth
    @if(Auth::getuser()->EAdministrador())
        @yield('menu_alerta')
    @endif
@endauth
