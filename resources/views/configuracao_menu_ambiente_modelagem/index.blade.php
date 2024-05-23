@extends('layouts.admin.layouts.layout_principal.main')

@section('content')

    @includeIf('layouts.admin.componentes.breadcrumb',
    [
    'titulo' => 'Todos as Configurações'
    ])
    @includeIf('configuracao_menu_ambiente_modelagem.componentes.botao_create')
    @includeIf('layouts.admin.componentes.tables',[
                    'titulos' => ['Usuario', 'Ações'],
                    'rota_edicao' => 'controle_configuracao_modelagem.edit',
                    'rota_exclusao' => 'controle_configuracao_modelagem.destroy',
                    'nome_botao' => 'Nova Configuração',
                    'titulo' =>'Configuracoes do Ambiente de Modelagem',
                    'tipo' => 'ConfiguracaoAmbienteModelagem'

    ])
@endsection


@section('modo')

    @includeIf('controle_documentacao.componentes.titulo_menu_superior',[
    'titulo' => 'Edição da Configuração',
    'descricao' => 'Visualização da configuração'
    ])
@endsection

@section('modal')
    @includeIf('painel.modais.modais')

@endsection
