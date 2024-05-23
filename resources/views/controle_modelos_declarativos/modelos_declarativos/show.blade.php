@extends('layouts.admin.layouts.layout_representacao_declarativa.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
    'titulo' => 'Painel',
    'sub_titulo' => ''

    ])
    @includeIf('layouts.admin.componentes.cards')
@endsection
@section('modo')
    @includeIf('componentes.titulo_menu_superior',[
    'titulo' => 'Visualização do modelo declarativo',
    'descricao' => 'Visualização do modelo declarativo'
    ])
@endsection


@section('codigo_css')
    <style>
        .para-baixo{
            margin-top: 5%;
        }
    </style>
@endsection
