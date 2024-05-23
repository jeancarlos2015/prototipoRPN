@extends('layouts.admin.layouts.layout_principal.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Repositório/'.
                    $regra->repositorio->nome.
                    '/Processos/Processo/'.
                    $regra->projeto->nome.
                     '/Modelo/'.$regra->modelodeclarativo->nome,
                    'rota' => 'todos_projetos'
    ])
    @includeIf('controle_regras.componentes.campos_disable')
@endsection
