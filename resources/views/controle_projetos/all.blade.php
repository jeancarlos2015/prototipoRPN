@extends('layouts.admin.layouts.layout_projeto.main')
@section('content')

    @if(!empty($repositorio))
        @if(!Auth::getuser()->ECliente())
            @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
        @endif
        @includeIf('painel.componentes.modal_nome_repositorio',['repositorio' => $repositorio])
    @endif


    @includeIf('layouts.admin.componentes.tables',[
                           'titulos' => $titulos,
                           'projetos' => $projetos,
                           'rota_edicao' => 'controle_projetos.edit',
                           'rota_exclusao' => 'controle_projetos.destroy',
                           'rota_cricao' => 'controle_projetos.create',
                           'rota_exibicao' => 'controle_projetos.show',
                           'rota_relatorio' => 'gerar_relatorio_projeto',
                           'nome_botao' => 'Novo',
                           'botao' => 'Novo',
                           'titulo' => 'Processos - Clique no processo desejado para gerenciar seus modelos!!'
           ])

@endsection

@section('titulo')
    @includeIf('controle_projetos.componentes.titulos_view_all_projetos')
@endsection

@section('menu_usuarios')
    @if(Auth::getuser()->EstaLiberado())
        @if(!empty($repositorio))
            @includeIf('menu.componentes.menu_usuarios',[
            'entradas' => $repositorio->usuarios_repositorios
            ])
        @endif
    @endif
@endsection

@section('modo')
    @if(Auth::user()->existe_repositorio())
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @endif
@endsection

@section('modal')
    @includeIf('painel.modais.modais')
    @if (Auth::getUser()->usuario_esta_no_repositorio())
        @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',[
                 'rota' => 'vincular_usuario_repositorio',
                 'codigo' => Auth::getUser()->codrepositorio
                 ])
    @endif

@endsection
