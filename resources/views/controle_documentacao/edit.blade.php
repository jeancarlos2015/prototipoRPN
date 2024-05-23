@extends('layouts.admin.layouts.layout_principal.main')

@section('content')

    @includeIf('layouts.admin.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'sub_titulo' => 'Documentações',
                    'rota' => 'painel'
    ])
    @includeIf('controle_documentacao.componentes.update_documentacao',[
    'dados' => $documentacao_view->dados,
    'documentacao' => $documentacao_view->documentacao,
    ])
@endsection

@section('modo')
    @includeIf('controle_documentacao.componentes.titulo_menu_superior',[
    'titulo' => 'Edição da documentação',
    'descricao' => 'Modo de Edição de Objeto de Fluxo'
    ])
@endsection
