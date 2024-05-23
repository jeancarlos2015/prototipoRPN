@extends('layouts.admin.layouts.layout_modelo.main')

@section('content')

    @if($projeto->TemRepositorio())
        @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
    @endif

    @includeIf('layouts.admin.componentes.tables',[
                          'titulos' => ['Autor','Ações'],
                          'modelos' => $projeto->modelos,

                          'rota_edicao' => 'controle_modelos.edit',
                          'rota_exclusao' => 'controle_modelos.destroy',
                          'rota_cricao' => 'controle_modelos.create',
                          'rota_exibicao' => 'controle_modelos_diagramaticos_index',

                          'nome_botao' => 'Novo',
                          'botao' => 'Novo',
                          'titulo' => 'Modelos - Clique no modelo desejado para gerenciar suas representações!!',
                          'tipo' => 'modelo'
          ])

@endsection

@section('modal')
@includeIf('painel.modais.modais')
@if (Auth::getUser()->usuario_esta_no_repositorio())


    @if ($projeto->eProprietario())
        @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios_diagrama',
                    [
                        'rota' => 'vincular_usuario_projeto',
                        'codigo' => $projeto->codprojeto
                    ])
    @else
        @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',[
              'rota' => 'vincular_usuario_projeto',
              'codigo' => $projeto->codprojeto
              ])
    @endif
@endif

@endsection

@section('informacoes_tela')
@includeIf('controle_modelos.componentes.titulos_view_index')
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

@section('menu_usuarios')
    @includeIf('menu.componentes.menu_usuarios',[
    'entradas' => $projeto->usuarios_projetos
    ])
    @if(Auth::getUser()->usuario_esta_no_repositorio())
        @if(collect(Auth::user()->solicitacoes_repositorio())->count()>0)
            @includeIf('menu.componentes.menu_solicitacoes',[
            'solicitacoes' => Auth::user()->solicitacoes_repositorio()
            ])
        @endif
    @endif
@endsection

@section('modo')
    @if(Auth::getUser()->EAdministrador())
        @includeIf('componentes.icone',[
            'id' => $projeto->codprojeto,
           'rota' => 'gerar_relatorio_projeto',
           'ico' => 'fa fa-address-card',
           'nome' => 'Relatório',
           'descricao_titulo_menu'=> 'Relatório'
        ])
    @ENDIF
    @if(Auth::getUser()->existe_repositorio())
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @endif
@endsection

@section('socket_js')
    <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
{{--    <script src="{!! asset('vendor/jquery/jquery.min.js') !!}"></script>--}}
@endsection
@section('botao_batepapo')
{{--    <li>--}}

{{--        <input type="image" src="{!! asset('img/batepapo.png') !!}" alt="Submit" width="25" data-toggle="modal"--}}
{{--               data-target="#modal-chat2020" title="Sala de Bate Papo">--}}
{{--    </li>--}}
@endsection
