
@extends('layouts.admin.layouts.layout_principal.main')

@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' =>
                   ' Repositório /'.$modelo->projeto->repositorio->nome.
                   '/ Projeto /'.$modelo->projeto->nome.
                   '/ Modelo BPMN'
   ])
   @includeIf('controle_modelos_diagramaticos.componentes.form_diagramatico_create')
    @if(!empty($representacao_diagramatica))
        <div class="alert alert-warning">
            <strong>Warning!</strong> O modelo já existe, para acessá-lo clique neste <a href="{!! route('editar_diagrama',[$representacao_diagramatica->codmodelodiagramatico]) !!}" class="link">Link</a>.
        </div>
    @endif
@endsection

@section('titulo')
    <div class="text-center">
        <h3> Criação da Representação BPMN </h3>
        <h4> Repositório {!! $modelo->projeto->repositorio->nome !!} </h4>
        @if($modelo->projeto->publico)
            <strong> Projeto Público -  {!!$modelo->projeto->nome !!} </strong> <br>
        @else
            <strong> Projeto Privado -  {!!$modelo->projeto->nome !!} </strong> <br>
        @endif
    </div>

@endsection
