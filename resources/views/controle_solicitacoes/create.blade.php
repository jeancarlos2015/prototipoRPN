@extends('layouts.admin.layouts.layout_modelo.main')

@section('content')

    @includeIf('controle_modelos.componentes.form_create')
    @includeIf('painel.componentes.modal_nome_repositorio',['repositorio' => $projeto->repositorio])
    @if(!empty($modelo))
        <div class="alert alert-warning">
            <strong>Warning!</strong> O modelo já existe, para acessá-lo clique neste <a
                    href="{!! route('controle_modelos.edit',[$modelo->codmodelo]) !!}" class="link">Link</a>.
        </div>

    @endif
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Você está no modo de Edição de modelo. As alterações que você fizer aqui deverão ser salvas.',
        'nome_titulo_menu' => 'Modo De Criação Do Modelo'
    ])
@endsection



@section('titulo')

    @includeIf('controle_solicitacoes.componentes.titulos_view_create_solicitacoes')
@endsection

