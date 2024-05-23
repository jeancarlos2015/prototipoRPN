@extends('layouts.admin.layouts.layout_projeto.main')
@section('content')


    @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
    @includeIf('layouts.admin.componentes.tables',[
                       'titulos' => $titulos,
                       'projetos' => $projetos,
                       'rota_edicao' => 'controle_projetos.edit',
                       'rota_exclusao' => 'controle_projetos.destroy',
                       'rota_cricao' => 'controle_projetos.create',
                       'rota_exibicao' => 'controle_projetos.show',
                       'rota_relatorio' => 'gerar_relatorio_projeto',
                       'nome_botao' => 'Novo',
                       'botao' => 'Novo',
                       'titulo' => 'Processos - Clique no projeto desejado para gerenciar seus modelos!!'
       ])
@endsection


@section('modal')
@includeIf('painel.modais.modais')
@if (Auth::getUser()->usuario_esta_no_repositorio())
    @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',[
             'rota' => 'vincular_usuario_repositorio',
             'codigo' => Auth::getUser()->codrepositorio
             ])


@endif

@endsection

@section('codigo_js')
    @includeIf('controle_repositorios.componentes.scripts_repositorio')
@endsection
@section('titulo')

  @includeIf('controle_projetos.componentes.titulos_view_index_projetos')
@endsection
@section('botoes_listar_atribuir')
    @includeIf('controle_repositorios.componentes.botoes_atribuicao_listagem_usuarios')

@endsection
@section('modo')
    @if(Auth::user()->existe_repositorio())
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @endif
@endsection
@section('codigo_css')
    <style>
        .fonte-menor {
            font-size: small;
        }
    </style>
@endsection

@section('menu_usuarios')
    @if(Auth::getuser()->EstaLiberado())
        @if(!empty($repositorio))
            @includeIf('menu.componentes.menu_usuarios',[
            'entradas' => $repositorio->usuarios_repositorios
            ])
        @endif
        @if(Auth::getUser()->usuario_esta_no_repositorio())
            @if(collect(Auth::user()->solicitacoes_repositorio())->count()>0)
                @includeIf('menu.componentes.menu_solicitacoes',[
                'solicitacoes' => Auth::user()->solicitacoes_repositorio()
                ])
            @endif
        @endif
    @endif
@endsection


@section('modo')
    @if(Auth::user()->existe_repositorio())
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @endif
@endsection

@section('socket_js')
    <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
{{--    <script src="{!! asset('vendor/jquery/jquery.min.js') !!}"></script>--}}
@endsection
{{--@section('botao_batepapo')--}}
{{--    <li>--}}
{{--        <a data-toggle="modal"--}}
{{--           data-target="#modal-chat2020"> <i class="fa fa-comment-alt fa-2x" style="color: #0a6aa1; cursor: pointer;" title="Chat"></i></a>--}}
{{--    </li>--}}
{{--@endsection--}}

