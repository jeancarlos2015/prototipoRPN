@extends('layouts.admin.layouts.layout_vazio.main')

@section('content')

    @includeIf('layouts.admin.componentes.tables',[
                    'titulos' => ['Diagrama','Ações'],
                    'modelos_versionaveis' => $representacao_diagramatica->historico_alteracoes,
                    'rota_atualizacao' => 'controle_historico_diagramas_create',
                    'rota_exibicao' => 'exibir_historicos_diagrama',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Versões',
                    'tipo' => 'diagrama_versionavel'
    ])

@endsection

@section('titulo')

    @includeIf('controle_modelos_diagramaticos_versionaveis.componentes.titulos_view_index_modelo')
@endsection

{{--@section('modal')--}}
{{--    @if(Auth::getuser()->TemPermissaoParaEscluir())--}}
{{--        @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',--}}
{{--                    [--}}
{{--                     'rota_vinculo' => 'vincular_usuario_modelo',--}}
{{--                     'titulo' => 'modelo',--}}
{{--                     'usuarios' => Auth::user()->usuarios(),--}}
{{--                     'tipos' => ['CLIENTE','COLABORADOR','PROPRIETARIO'],--}}
{{--                     'modelo' => $representacao_diagramatica->modelo--}}
{{--                     ])--}}
{{--    @endif--}}
{{--    @includeIf('controle_repositorios.componentes.modal_envio_mensagens',['usuarios' => $representacao_diagramatica->modelo->usuarios_do_modelo()])--}}
{{--    @includeIf('painel.componentes.modal_nome_repositorio',['diagrama' => $representacao_diagramatica])--}}
{{--    @includeIf('controle_repositorios.componentes.modal_listagem_usuarios',--}}
{{--      [--}}
{{--      'entradas' => $representacao_diagramatica->modelo->usuarios_modelos,--}}
{{--      'tipo_modal' => 'modal_modelo',--}}
{{--      'titulo' => 'Modelo'--}}
{{--      ])--}}
{{--@endsection--}}

@section('modal')
    @includeIf('painel.modais.modais')

@endsection
