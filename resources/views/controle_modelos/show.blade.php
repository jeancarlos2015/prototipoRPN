@extends('layouts.admin.layouts.layout_modelo.main')

@section('content')

    @includeIf('layouts.admin.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'rota' => 'painel',
                    'sub_titulo' => 'Repositório/'.$modelo_viwer->modelo->repositorio->nome.'/Processos/'.$modelo_viwer->modelo->projeto->nome.'/Representações'
    ])

    @if(Auth::getuser()->EstaLiberado() || $modelo_viwer->modelo->publico)
        @includeIf('layouts.admin.componentes.botao',['tipo' => 'diagramatico'])
        @includeIf('layouts.admin.componentes.botao',['tipo' => 'declarativo'])
    @endif

@endsection
@section('menu_usuarios')
    @includeIf('menu.componentes.menu_usuarios',[
    'entradas' => $modelo_viwer->modelo->usuarios_modelos
    ])
    @if(Auth::getUser()->usuario_esta_no_repositorio())
        @if(collect(Auth::getUser()->solicitacoes_repositorio())->count()>0)
            @includeIf('menu.componentes.menu_solicitacoes',[
            'solicitacoes' => Auth::getUser()->solicitacoes_repositorio()
            ])
        @endif
    @endif
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
            'descricao_titulo_menu' => 'Criação do modelo',
            'nome_titulo_menu' => 'Criação do modelo'
        ])
@endsection

@section('titulo')
    @includeIf('controle_modelos.componentes.titulos_view_show')
    @includeIf('controle_modelos.componentes.titulos')
@endsection

@section('modal')
    @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',['rota' => 'vincular_usuario_modelo'])
    @includeIf('controle_repositorios.componentes.modal_listagem_usuarios',
    [
    'entradas' => $modelo_viwer->modelo->usuarios_modelos,
    'tipo_modal' => 'modal_modelo',
    'titulo' => 'Modelo',
    'modelo' => $modelo_viwer->modelo
    ])
    @includeIf('painel.componentes.modal_mensagens_usuario',['entradas' => $modelo_viwer->modelo->usuarios_modelos])
    @includeIf('painel.componentes.modal_nome_repositorio',['repositorio' => $modelo_viwer->modelo->repositorio])
@endsection

@section('botoes_listar_atribuir')
    @includeIf('controle_repositorios.componentes.botoes_atribuicao_listagem_usuarios')
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
@section('menu_modelo')
    @includeIf('controle_modelos.componentes.menu_modelo')
@endsection

@section('socket_js')
    <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
    <script src="{!! asset('vendor/jquery/jquery.min.js') !!}"></script>
@endsection
{{--@section('botao_batepapo')--}}
{{--    --}}{{--    <li>--}}

{{--    --}}{{--        <input type="image" src="{!! asset('img/batepapo.png') !!}" alt="Submit" width="25" data-toggle="modal"--}}
{{--    --}}{{--               data-target="#modal-chat2020" title="Sala de Bate Papo">--}}
{{--    --}}{{--    </li>--}}
{{--@endsection--}}
