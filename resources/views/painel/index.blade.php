@extends('layouts.admin.layouts.layout_principal.main')
@section('content')
    @includeIf('painel.componentes.titulos_painel')
    @if(Auth::getUser()->Existemsolicitacoes())
        @includeIf('modais.solicitacoes.modal_solicitacoes',['solicitacoes' => Auth::getUser()->solicitacoes_painel()])
    @endif
    @includeIf('painel.conteudo.conteudo')
@endsection
@section('codigo_css')
    @includeIf('painel.componentes.para_baixo')
@endsection

@section('cards')
    @includeIf('painel.componentes.cards',[
    'quantidades' => Auth::getUser()->quantidades(),
    'rotas' => Auth::getUser()->rotas(),
    ])
@endsection

@section('modal')

    @if (Auth::getUser()->usuario_esta_no_repositorio())
        @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',[
                 'rota' => 'vincular_usuario_repositorio',
                 'codigo' => Auth::getUser()->codrepositorio
                 ])
    @endif

@endsection





@section('menu_usuarios')
    @if( Auth::getuser()->TemPermissaoParaEscluir())

        @if(Auth::getUser()->usuario_esta_no_repositorio())
            @includeIf('menu.componentes.menu_usuarios',[
            'entradas' => Auth::getUser()->usuarios_dos_repositorios()
            ])



        @endif
    @endif

    @if(count(Auth::getUser()->solicitacoes_painel())>0)

        @includeIf('menu.componentes.menu_solicitacoes',[
        'solicitacoes' => Auth::getUser()->solicitacoes_painel()
        ])

    @endif
@endsection


@section('modo')
    @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @if(Auth::getUser()->usuario_esta_no_repositorio())
        @includeIf('layouts.admin.layouts.sub_componentes.menu_solicitar_a_usuarios',[
        'entradas' => Auth::getUser()->usuarios_dos_repositorios()
        ])

    @endif
    @if(Auth::getuser()->EstaLiberado())
        @includeIf('painel.componentes.alerta',['logs' => Auth::getUser()->LogsUsuarios()])

        @includeIf('painel.componentes.mensagens',['mensagens' => Auth::getUser()->MensagensUsuario()])
    @endif
{{--    @includeIf('modais.criacao_repositorio.criacao_repositorio')--}}
@endsection


@section('codigo_js')
    @includeIf('painel.scripts.scripts')
    @if(!empty(getenv('homologacao')) && !Auth::user()->EAdministrador())
        <script>

            $(document).ready(function () {
                $('#modal-mensagem4343432').modal('show');
            })
        </script>
    @endif

@endsection

@section('codigo_css')
    <style>
        .form-control-custom {
            display: block;
            width: 100%;
            /* height: calc(2.25rem + 2px); */
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>

@endsection



@section('socket_js')
    <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
    <script src="{!! asset('vendor/mordernize/jquery/jquery.min.js') !!}"></script>
@endsection

@section('meta_inicio')
    <meta name="description"
        content="Esta página visa exibir todas as funcionalidades do BPMN.">
    <meta name="keywords" content="Usuários BPMN, Diagramas BPMN, DashBoard">
    <meta name="robots"
        content="Painel contendo um paronama geral dos modelos, usuários, Diagramas, Modelos, Processos e Repositórios.">
@endsection
