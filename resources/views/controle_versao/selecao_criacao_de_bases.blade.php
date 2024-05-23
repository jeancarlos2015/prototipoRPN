@extends('layouts.admin.layouts.layout_principal.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Versionamento',
                    'rota' => 'painel',
                    'branch_atual' => $branch_atual
    ])
    @if(!empty($repositorios))
        @if(Auth::getuser()->EAdministrador())
            @includeIf('controle_versao.componentes.form_criacao')
            @includeIf('layouts.admin.componentes.tables',[
                                'titulos' => $titulos,
                                'repositorios' => $repositorios,
                                'nome_botao' => 'Novo',
                                'titulo' =>'Repositórios'
                ])
        @else
            @includeIf('layouts.admin.componentes.tables',[
                                'titulos' => $titulos,
                                'repositorios' => $repositorios,
                                'titulo' =>'Repositórios'
                ])
        @endif
    @endif
@endsection
