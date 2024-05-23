@extends('layouts.admin.layouts.layout_principal.main')

@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'sub_titulo' =>
                   'Repositório/'.$representacao_diagramatica->repositorio->nome.
                   '/Projeto/'.$representacao_diagramatica->projeto->nome.
                   '/ModeloDiagramatico/'.$representacao_diagramatica->nome,
                   'rota' => 'painel'
    ])
    @includeIf('controle_modelos_diagramaticos.componentes.form_diagramatico_update')
@endsection

@section('titulo')
    <div class="text-center">
        <h3> Edição da Representação BPMN </h3>
        <h4> Repositório {!! $representacao_diagramatica->repositorio->nome !!} </h4>
        @if($representacao_diagramatica->projeto->publico)
            <strong> Projeto Público -  {!!$representacao_diagramatica->projeto->nome !!} </strong> <br>
        @else
            <strong> Projeto Privado -  {!!$representacao_diagramatica->projeto->nome !!} </strong> <br>
        @endif
    </div>

@endsection