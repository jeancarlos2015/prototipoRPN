@extends('layouts.admin.layouts.layout_principal.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' =>
                    'Repositório/'.
                    $regra->repositorio->nome.
                    '/Processos/'.
                    $regra->projeto->nome.
                    '/Modelo/'.
                    $regra->modelodeclarativo->nome.
                    '/Regra/'.
                    $regra->codregra,
                    'rota' => 'painel'
    ])
@includeIf('controle_regras.componentes.form')
@endsection

@section('titulo')
   @includeIf('controle_regras.componentes.titulos_view_edit_regras')
@endsection
