@extends('layouts.admin.layouts.layout_projeto.main')
@section('content')

    @includeIf('controle_projetos.componentes.form_projeto_create')
    @if(!empty($projeto))
        <div class="alert alert-warning">
            <strong>Warning!</strong> O processo já existe, para acessá-lo clique neste <a href="{!! route('controle_projetos.show',[$projeto->codprojeto]) !!}" class="link">Link</a>.
        </div>
    @endif
    @includeIf('painel.componentes.modal_nome_repositorio',['repositorio' => $repositorio])
@endsection

@section('titulo')
@includeIf('controle_projetos.componentes.titulos_view_create_projetos')
@endsection
