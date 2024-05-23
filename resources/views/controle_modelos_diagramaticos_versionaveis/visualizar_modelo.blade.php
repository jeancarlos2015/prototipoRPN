@extends('controle_modelos_diagramaticos.layout_diagrama.main')

@section('content')


    <div id="canvas" style="background-color: #EAEAEA"></div>
    <script>

        window.onload = function () {
            openDiagramVersionavel('{!! $modelo->coddiagramaversionavel  !!}');
        }

    </script>
    @includeIf('painel.componentes.modal_mensagens_usuario',['entradas' => $modelo->modelo->usuarios_modelos])


@endsection


@section('modal')
    @if(Auth::getuser()->TemPermissaoParaEscluir())
        @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',['rota' => 'vincular_usuario_modelo'])
    @endif
    @includeIf('controle_repositorios.componentes.modal_envio_mensagens',['usuarios' => $modelo->modelo->usuarios_do_modelo()])
    @includeIf('painel.componentes.modal_nome_repositorio',['diagrama' => $modelo])
@endsection

@section('bpmn_model_js')
    <script src="{{asset('js/bpmn-navigated-viewer.development.js')}}"></script>
@endsection

@section('versao_diagrama')
<a class="nav-link" href="#" title="Modelo {!! $modelo->nome !!}" style="float: left;">VERSÃO  {!! $modelo->coddiagramaversionavel!!} </a>
@endsection

@section('dropdown_menu_ambiente_modelagem')
    @includeIf('controle_modelos_diagramaticos_versionaveis.componentes.menu_diagrama_versionavel')
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
