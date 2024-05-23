<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    @if(Auth::getuser()->TemPermissaoParaEscluir())
        @includeIf('menu.componentes.menu_admin_proprietario')
    @elseif(in_array(Auth::user()->papel(),['CLIENTE','COLABORADOR']))
        @includeIf('layouts.admin.layouts.sub_componentes.opcoes_menu_latereral_projeto')
    @endif
    @yield('menu_usuarios')
    @yield('participantes')
</ul>