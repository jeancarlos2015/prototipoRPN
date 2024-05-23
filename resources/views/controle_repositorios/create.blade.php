@extends('layouts.admin.layouts.layout_repositorio.main')
@section('content')
    @includeIf('controle_repositorios.componentes.conteudo')
@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de Repositórios',
        'nome_titulo_menu' => 'Modo de Criação do Repositório'
    ])
@endsection

@section('titulo')
   @includeIf('controle_repositorios.componentes.titulos_view_create_repositorios')
@endsection
