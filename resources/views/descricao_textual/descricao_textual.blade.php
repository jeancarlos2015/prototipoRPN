
@extends('descricao_textual.layout.layout')

@section('conteudo')
@includeIf('painel.componentes.modal_nome_repositorio',['modelo' => $modelo])
@includeIf('descricao_textual.componentes.FormularioModelo',['modelo' => $modelo])
@endsection

@section('boltao_voltar')
    <li class="nav-item">
        <a class="nav-link"
           href="#" data-toggle="modal"
           data-target="#modal-nome-repositorio">
            <i class="fa fa-info" title="Modelo: {!! strtoupper($modelo->nome) !!}"></i>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection
