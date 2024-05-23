<ul class="navbar-nav ml-auto " id="page-title-tour">
    @Auth
        @includeIf('menu.componentes.menu_alerta')

        @includeIf('layouts.admin.layouts.sub_componentes.menu_configuracao')
    @EndAuth
    @yield('modo')
    @Auth
        @includeIf('menu.componentes.menu_descricao_limpeza_cache')
    @EndAuth
    @yield('boltao_voltar')
    @Auth
        @includeIf('menu.componentes.restante_menu')
    @EndAuth
</ul>
