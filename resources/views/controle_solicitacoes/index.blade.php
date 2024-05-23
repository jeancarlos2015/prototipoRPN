@extends('layouts.admin.layouts.layout_modelo.main')

@section('content')


    @if(!empty($projeto->repositorio))
        @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
    @endif

    @includeIf('layouts.admin.componentes.tables',[
                          'titulos' => ['Autor','Ações'],
                          'modelos' => $projeto->modelos,
                          'rota_edicao' => 'controle_modelos.edit',
                          'rota_exclusao' => 'controle_modelos.destroy',
                          'rota_cricao' => 'controle_modelos.create',
                          'rota_exibicao' => 'controle_modelos_diagramaticos_index',
                          'nome_botao' => 'Novo',
                          'botao' => 'Novo',
                          'titulo' => 'Modelos - Clique no modelo desejado para gerenciar suas representações!!',
                          'tipo' => 'modelo'
          ])
@endsection

@section('modal')
    @includeIf('controle_modelos.componentes.modal_atribuicao_usuarios_projetos',[
   'rota_vinculo' => 'vincular_usuario_projeto',
   'titulo' => 'Projeto'
   ])
    @includeIf('controle_repositorios.componentes.modal_listagem_usuarios',
    [
    'entradas' => $projeto->usuarios_projetos,
    'tipo_modal' => 'modal_projeto',
    'titulo' => 'Projeto'
    ])
    @includeIf('painel.componentes.modal_mensagens_usuario',['entradas' => $projeto->usuarios_projetos])
    @includeIf('controle_repositorios.componentes.modal_envio_mensagens')
    @includeIf('painel.componentes.modal_nome_repositorio',['repositorio' => $projeto->repositorio])
@endsection

@section('botoes_listar_atribuir')
    @includeIf('controle_repositorios.componentes.botoes_atribuicao_listagem_usuarios')
    @includeIf('controle_solicitacoes.componentes.titulos_view_index_solicitacoes')
@endsection

@section('codigo_js')
    @includeIf('controle_repositorios.componentes.scripts_repositorio')
@endsection


@section('codigo_css')
    <style>
        .fonte-menor {
            font-size: small;
        }
    </style>
@endsection

@section('menu_usuarios')
    @includeIf('menu.componentes.menu_usuarios',[
    'entradas' => $projeto->usuarios_projetos
    ])
    @if(Auth::getUser()->usuario_esta_no_repositorio())
        @if(collect(Auth::user()->solicitacoes_repositorio())->count()>0)
            @includeIf('menu.componentes.menu_solicitacoes',[
            'solicitacoes' => Auth::user()->solicitacoes_repositorio()
            ])
        @endif
    @endif
@endsection

@section('modo')
    @if(Auth::getuser()->EAdministrador())
        @includeIf('componentes.icone',[
            'id' => $projeto->codprojeto,
           'rota' => 'gerar_relatorio_projeto',
           'ico' => 'fa fa-address-card',
           'nome' => 'Relatório',
           'descricao_titulo_menu'=> 'Relatório'
        ])
    @ENDIF
    @if(Auth::user()->existe_repositorio())
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @endif
@endsection
