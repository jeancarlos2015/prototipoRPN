@extends('layouts.admin.layouts.layout_repositorio.main')
@includeIf('controle_repositorios.componentes.menu_edite_repositorio')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'sub_titulo' => 'Repositórios',
                    'rota' => 'painel'
    ])
    @includeIf('controle_repositorios.componentes.form_repositorio_update')

@endsection

@section('modal')
    @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',['rota' => 'vincular_usuario_repositorio'])
    @includeIf('controle_repositorios.componentes.modal_listagem_usuarios',
    [
    'entradas' => $repositorio->usuarios_repositorios,
    'tipo_modal' => 'modal_repositorio',
    'titulo' => 'repositorio'
    ])
    @includeIf('painel.componentes.modal_mensagens_usuario',['entradas' => $repositorio->usuarios_repositorios])
    @includeIf('modais.chat.chat_modal')
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

@section('titulo')

    @includeIf('controle_repositorios.componentes.titulos_view_edite_repositorios')
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
