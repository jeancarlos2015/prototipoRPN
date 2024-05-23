@Auth

    @if(Auth::getUser()->usuario_esta_no_repositorio())

        @yield('menu_usuarios_superior')
        @includeIf('componentes.descricao',
                    [
                    'descricao_titulo_menu' =>
                    ' Repositório: '.Auth::user()->repositorio->nome.
                    ' Usuário: '.Auth::user()->name.
                    ' Função: '.Auth::user()->repositorio->papel(),
                    'nome_titulo_menu' => Auth::user()->repositorio->nome,
                    ])
    @endif
    @if(!empty(Auth::user()->papel()))

        @includeIf('layouts.admin.layouts.sub_componentes.li_nav',
                   [
                       'rota' => 'limpar_cache',
                       'ico' => 'fa fa-refresh ',
                       'descricao_titulo_menu'=> 'Atualizar Página',
                       'id' => 'limpar_cache'
                   ])
    @endif

@endauth
