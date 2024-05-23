@extends('controle_modelos_diagramaticos.layout_diagrama.main')

@section('content')

    <div id="canvas" style="background-color: #EAEAEA"></div>
    @includeIf('controle_modelos_diagramaticos.componentes.descricao_modelo3')
    <script>

        window.onload = function () {
            openDiagram('{!! $modelo->codmodelodiagramatico  !!}');
        }

    </script>
    @includeIf('painel.componentes.modal_mensagens_usuario',['entradas' => $modelo->modelo->usuarios_modelos])

@endsection
@section('script_js')
    <script>
        $(document).ready(function () {
            $('.navbar').mouseleave(function (event) {
                $('.navbar').hide();
                $("#idAmbienteVisualizacaoDiagramaBody").css({top: '0px'});
                $("#canvas").css({top: '0px'});
                $("html").css({top: '0px'});
            });

            $('#idAmbienteVisualizacaoDiagramaBody').mouseleave(function (event) {
                $('.navbar').show();
                $("#idAmbienteVisualizacaoDiagramaBody").css({top: '65px'});
                $("#canvas").css({top: '65px'});
                $("html").css({top: '65px'});
            });
        });
    </script>
@endsection
@section('modo')


    @if(Auth::getuser()->EstaLiberado())
        @includeIf('painel.componentes.alerta',['logs' => $logs])
        @includeIf('painel.componentes.mensagens',['mensagens' => $mensagens])
    @endif




    @includeIf('controle_modelos_diagramaticos.componentes.voltar',['modelo' => $modelo])
    @includeIf('controle_modelos_diagramaticos.componentes.estilo')
    @includeIf('componentes.descricao',[
            'visualizacao_modelo' => 'Você está no modo de visualização de modelo. As alterações que você fizer aqui não poderão ser salvas.',
            'nome_modelo' => 'Modelo:'.$modelo->modelo->nome
        ])

@endsection
@section('bpmn_model_js')
    <script src="https://unpkg.com/bpmn-js@6.5.1/dist/bpmn-navigated-viewer.development.js"></script>

@endsection

@section('menu_usuarios_superior')

    @includeIf('menu.componentes.menu_usuarios_superior',[
    'diagrama' => $modelo
    ])

@endsection


@section('modal')
    @if ($modelo->eProprietario())
        @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios_diagrama',
                    [
                        'rota' => 'vincular_usuario_modelo',
                        'codigo' => $modelo->codmodelo
                    ])
    @else
        @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',
                    [
                        'rota' => 'vincular_usuario_modelo',
                        'codigo' => $modelo->codmodelo
                    ])
    @endif
    @includeIf('modais.validadores.validadores',['diagrama' => $modelo,'rota'=> 'vincular_usuario_modelo', 'codigo'=> $modelo->codmodelo])

    @include('modais.transferencia.modal_transferencia_diagrama',['diagrama' => $modelo])
    @includeIf('modais.repositorios.repositorios')
    @includeIf('modais.versionamento.versionamento',['diagrama' => $modelo])
@endsection

@section('socket_js')
    {{--    <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>--}}
    {{--    <script src="{!! asset('vendor/jquery/jquery.min.js') !!}"></script>--}}

@endsection

@section('dropdown_menu_ambiente_modelagem')

    @includeIf('controle_modelos_diagramaticos.componentes.menu',['tipo' => 'edicao','diagrama' => $modelo])

@endsection

@section('head_body')

    <link rel="stylesheet" href="https://unpkg.com/bpmn-js@2.4.1/dist/assets/diagram-js.css">
    {{--    <link rel="stylesheet" href="https://unpkg.com/bpmn-js@2.4.1/dist/assets/bpmn-font/css/bpmn.css">--}}
    <link href="{{asset('css/bpmn/bpmn.css')}}" rel="stylesheet">
    <style>


        html, body, #canvas {
            top: 0;
        }
    </style>
@endsection

@section('nav_menu_superior_modelo')
    @includeIf('controle_modelos_diagramaticos.componentes.nav_menu_superior_modelo')
@endsection
