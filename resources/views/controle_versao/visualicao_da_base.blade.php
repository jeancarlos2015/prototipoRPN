@extends('layouts.admin.layouts.layout_principal.main')
@section('content')
    @if(!empty($repositorio))
        @includeIf('layouts.admin.componentes.breadcrumb',[
                          'titulo' => 'Painel',
                        'sub_titulo' => 'Versionamento',
                        'rota' => 'painel',
                        'branch_atual' => $repositorio['default_branch']
        ])
    @includeIf('controle_versao.componentes.form_visualizacao')
    @endif
@endsection
