@extends('descricao_textual.layout.layout_vazio')

@section('conteudo')
    @includeIf('painel.componentes.modal_nome_repositorio',['diagrama' => $diagrama])
    @includeIf('descricao_textual.componentes.FormularioDiagrama',['diagrama' => $diagrama])
@endsection
@section('boltao_voltar')
    <li class="nav-item">
        <a class="nav-link"
           href="#" data-toggle="modal"
           data-target="#modal-nome-repositorio">
            <i class="fa fa-info" title="Diagrama: {!! strtoupper($diagrama->nome) !!}"></i>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection
