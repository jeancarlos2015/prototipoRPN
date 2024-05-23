@extends('layouts.admin.layouts.layout_repositorio.main')
@section('content')
  @includeIf('controle_repositorios.componentes.menu_show_repositorio')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'sub_titulo' => 'Repositórios',
                    'rota' => 'painel'
    ])

@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Visualização do Repositório',
        'nome_titulo_menu' => 'Visualização do Repositório'
    ])
@endsection
