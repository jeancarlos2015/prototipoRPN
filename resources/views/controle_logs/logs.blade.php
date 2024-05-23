@extends('layouts.admin.layouts.layout_principal.main')

@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                              'titulo' => 'Painel',
                            'rota' => 'painel',
                            'sub_titulo' => 'Logs'
            ])

    @includeIf('layouts.admin.componentes.tables',[
                    'titulos' => ['Descrição','Ação'],
                    'logs' => $log_viwer->logs,
                    'rota_exclusao' => 'controle_logs.destroy',
                    'titulo' =>'Logs Do Sistema',
                    'tipo' => $log_viwer->tipo
    ])
@endsection

@section('modo')
    @includeIf('controle_documentacao.componentes.titulo_menu_superior',[
    'titulo' => 'Todos os Logs',
    'descricao' => 'Todos os Logs'
    ])
@endsection

@section('modal')
    @includeIf('painel.modais.modais')

@endsection
