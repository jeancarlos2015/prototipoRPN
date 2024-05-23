@extends('layouts.admin.layouts.layout_modelo.main')

@section('content')


    @includeIf('layouts.admin.componentes.tables',[
                   'titulos' => ["Solicitante", "Proprietário", "Repositório", "Ação"],
                   'solicitacoes' => $solicitacoes,
                   'rota_cancela_solicitacao' => '',
                   'rota_vincula_usuario' => '',
                   'nome_botao' => 'Novo',
                   'botao' => 'Novo',
                   'titulo' => 'Solicitações - Visualize todas as solicitações feitas pelos usuários',
                   'tipo' => 'solicitacao'
   ])


@endsection

@section('codigo_css')
    <style>
        .fonte-menor {
            font-size: small;
        }
    </style>
@endsection

@section('titulo')

    @includeIf('controle_solicitacoes.componentes.titulos_view_all_solicitacoes')
@endsection


@section('modo')
    @if(Auth::user()->existe_repositorio())
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @endif
@endsection

@section('modal')
    @includeIf('painel.componentes.modal_vinculacao_usuarios',[
       'solicitacoes' => $solicitacoes,
       'rota_vinculo' => 'vincular_usuario_repositorio',
       'titulo' => 'repositorio',
       'tipos' => ["COLABORADOR", "PROPRIETARIO", "CLIENTE"],
       ])
@endsection
