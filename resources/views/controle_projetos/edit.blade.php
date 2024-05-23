@extends('layouts.admin.layouts.layout_projeto.main')
@section('content')

    @includeIf('controle_projetos.componentes.form_projeto_update')
@endsection

@section('modal')
    @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',['rota' => 'vincular_usuario_projeto'])
    @includeIf('controle_repositorios.componentes.modal_listagem_usuarios',
    [
    'entradas' => $projeto->usuarios_projetos,
    'tipo_modal' => 'modal_projeto',
    'titulo' => 'projeto'
    ])
    @includeIf('painel.componentes.modal_mensagens_usuario',['entradas' => $projeto->usuarios_projetos])
    @includeIf('painel.componentes.modal_nome_repositorio',['repositorio' => $projeto->repositorio])
    @includeIf('modais.chat.chat_modal')
@endsection

@section('codigo_js')
    @includeIf('controle_repositorios.componentes.scripts_repositorio')
@endsection

@section('socket_js')
    <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
@endsection
{{--@section('botao_batepapo')--}}
{{--    <li>--}}
{{--        <a data-toggle="modal"--}}
{{--           data-target="#modal-chat2020"> <i class="fa fa-comment-alt fa-2x" style="color: #0a6aa1; cursor: pointer;" title="Chat"></i></a>--}}
{{--    </li>--}}
{{--@endsection--}}


@section('codigo_css')
    <style>
        .fonte-menor {
            font-size: small;
        }
    </style>
@endsection

@section('titulo')
@includeIf('controle_projetos.componentes.titulos_view_edit_projetos')
@endsection
