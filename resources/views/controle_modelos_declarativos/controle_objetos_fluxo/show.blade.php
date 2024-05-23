@extends('layouts.admin.layouts.layout_representacao_declarativa.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Repositório/'.$objeto->repositorio->nome.
                                    '/Projeto/'.$objeto->projeto->nome,
                    'rota' => 'painel'
    ])
    @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.form_show')
@endsection

@section('titulo')
   @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.titulos_view_show')
@endsection