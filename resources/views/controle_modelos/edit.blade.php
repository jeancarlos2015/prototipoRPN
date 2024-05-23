@extends('layouts.admin.layouts.layout_modelo.main')

@section('content')

    @includeIf('controle_modelos.componentes.form_update')
@endsection

@section('titulo')
@includeIf('controle_modelos.componentes.titulos_view_edite')
@endsection



@section('modal')
    @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',['rota' => 'vincular_usuario_modelo'])
    @includeIf('controle_repositorios.componentes.modal_listagem_usuarios',
    [
    'entradas' => $modelo->usuarios_modelos,
    'tipo_modal' => 'modal_modelo',
    'titulo' => 'Modelo'
    ])
    @includeIf('painel.componentes.modal_mensagens_usuario',['entradas' => $modelo->usuarios_modelos])
    @includeIf('painel.componentes.modal_nome_repositorio',['repositorio' => $modelo->repositorio])
@endsection

@section('codigo_js')
    @includeIf('controle_repositorios.componentes.scripts_repositorio')
@endsection


@section('codigo_css')
    <style>
        .fonte-menor {
            font-size: small;
        }
    </style>
@endsection
