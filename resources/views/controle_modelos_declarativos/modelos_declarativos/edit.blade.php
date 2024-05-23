@extends('layouts.admin.layouts.layout_representacao_declarativa.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'sub_titulo' =>
                   'Repositório/'.$modelo->repositorio->nome.
                   '/Processo/'.$modelo->projeto->nome.
                   '/Modelo Declarativo/'.$modelo->nome,
                   'rota' => 'controle_repositorios.index'
    ])
    @includeIf('controle_modelos_declarativos.modelos_declarativos.componentes.form_update')
    @includeIf('painel.componentes.modal_nome_repositorio',['modelo' => $modelo])
@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Modo de Criação do modelo declarativo',
        'nome_titulo_menu' => 'Edição do Modelo Declarativo'
    ])
@endsection

@section('titulo')
    <div class="text-center">
        <h3> Edição da Representação Declarativa </h3>
        <h4> Repositório {!! $modelo->repositorio->nome !!} </h4> <br>
        @if($modelo->projeto->publico)
            <strong> Processo Público -  {!!$modelo->projeto->nome !!} </strong> <br>
        @else
            <strong> Processo Privado -  {!!$modelo->projeto->nome !!} </strong> <br>
        @endif
        <strong> Modelo {!!$modelo->nome !!} </strong> <br>
    </div>
@endsection
