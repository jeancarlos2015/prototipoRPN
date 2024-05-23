@Auth
    @includeIf('layouts.admin.layouts.sub_componentes.li_nav',
               [
                   'rota' => 'painel',
                   'ico' => 'fa fa-home ',
                   'descricao_titulo_menu'=> 'Clique Aqui para voltar ao painel principal',
                   'id' => 'inicio2020'
               ])

    @includeIf('layouts.admin.layouts.sub_componentes.li_nav',
               [
                   'rota' => 'modelos_publicos',
                   'ico' => 'fa fa-book faa-pulse ',
                   'descricao_titulo_menu'=> 'Clique Aqui para ver todos os modelos públicos'
               ])


    @if(Auth::getuser()->EstaLiberado())
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav',
                        [
                            'link' => 'https://trello.com/b/D3sMcqT6/rpn-melhorias',
                            'ico' => 'fa fa-lightbulb-o faa-pulse ',
                            'descricao_titulo_menu'=> 'Criar Tarefa de bug, melhoria'
                        ])
    @endif

    @if(Auth::getuser()->Ecliente())
        @includeIf('layouts.admin.layouts.sub_componentes.dropdown')
    @elseif(!empty(Auth::user()->papel()))
        @includeIf('layouts.admin.layouts.sub_componentes.dropdown')
        @includeIf('layouts.admin.layouts.sub_componentes.dropdown_alerta')
    @endif

    @includeIf('layouts.admin.layouts.sub_componentes.dropdown_usuario')



@endauth
