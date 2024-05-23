@extends('layouts.admin.layouts.layout_projeto.main')
@section('content')

@includeIf('controle_mensagens.Componentes.form')
@endsection

@section('titulo')
  @includeIf('controle_mensagens.Componentes.titulos')
@endsection

@section('menu_usuarios')
    @if(Auth::getUser()->EstaLiberado())
        @if(!empty($repositorio))
            @includeIf('menu.componentes.menu_usuarios',[
            'entradas' => $repositorio->usuarios_repositorios
            ])
        @endif
    @endif
@endsection

@section('modo')
    @if(Auth::user()->existe_repositorio())
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @endif
@endsection
