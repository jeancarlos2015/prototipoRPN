<!DOCTYPE html>
<html>

<head>
    <title>RPN</title>
    @Auth
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endauth
    <style>
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
        }
    </style>
    @yield('css')
    <link rel="stylesheet" href="{!! asset('modeler/vendor/bpmn-js/assets/diagram-js.css') !!}"/>
    <link rel="stylesheet" href="{!! asset('modeler/vendor/bpmn-js/assets/bpmn-font/css/bpmn-embedded.css') !!}"/>
    <link rel="stylesheet" href="{!! asset('modeler/css/app.css"') !!}"/>
    <style type="text/css">
        html,
        body {
            height: 100%;
            padding: 0;
            margin: 0;
        }

        #js-canvas {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .djs-palette {
            margin-top: 5%;
        }

        #js-canvas > div {
            height: 100%;
        }

        .header {
            position: fixed;
            left: 10px;
            top: 10px;

            border: solid 1px #999;
            background: #EEE;
            border-radius: 5px;
            z-index: 100;
        }

        .header h1 {
            margin: 10px;
            padding: 0;
        }

        .toolbar {
            position: fixed;
            left: 10px;
            bottom: 10px;
        }

        .toolbar .entry {
            background: #EEE;
            border: solid 1px #999;
            border-radius: 5px;
            padding: 5px;
            margin-right: 20px;

            display: inline-block;
        }

        #btnSalvarDiagrama, #iconePlus {
            cursor: pointer;
        }

        img {
            display: none;
        }

        button {
            opacity: 100%;
        }

        .djs-palette {
            zoom: 67%;
        }
        /* Paste this css to your style sheet file or under head tag */
        /* This only works with JavaScript,
        if it's not present, don't show loader */
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('{!! asset('images/gifs/Preloader_11.gif') !!}') center no-repeat #fff;
        }
    </style>
    @includeIf('modais.chat.chat_modal')
    @yield('modais')
    @includeIf('controle_modelos_diagramaticos.layout_diagrama.nav')

</head>

<body id="idambienteModelagemBody">
<div class="se-pre-con"></div>
<textarea id="diagramaBaixado" hidden> {!! $modelo->xml_modelo !!} </textarea>
<input type="text" id="codmodelodiagramatico" value="{!! $modelo->codmodelodiagramatico !!}" hidden>
<div class="content" id="js-drop-zone">

    <div class="canvas" id="js-canvas" style="background-color: #EAEAEA"></div>


</div>


<div class="toolbar">

    <div class="entry" id="download-diagram" style="display:none;">
        <a id="js-download-diagram" href title="download BPMN diagram">
            <div style="font-size: x-small">BPMN</div>
            <i id="donwload-bpmn-ico" class="fa fa-download faa-pulse  fa-2x" aria-hidden="true"></i>
        </a>
    </div>

    <div class="entry" id="download-svg" style="display:none;">
        <a id="js-download-svg" href title="download as SVG image">
            <div style="font-size: x-small">SVG</div>
            <i id="download-svg-ico" class="fa fa-download faa-pulse  fa-2x" aria-hidden="true"></i>
        </a>
    </div>

    <div class="entry" id="btnSalvarDiagramaEntry">
        <i id="btnSalvarDiagrama" class="fas fa-save fa-3x" title="Salvar Diagrama"></i>
    </div>
    <div class="entry" id="zoom-paleta-diagrama">
        <input style="zoom: 70%;" id="my-range" type="range" step="0.25" min="1.5" max="4"/>
    </div>
{{--    <div class="entry" style="border: 0; padding: 0" id="idDivTrocarTipoPublicoPrivadoModelo">--}}
{{--        <input id="idTrocarTipoPublicoPrivadoModelo" type="checkbox" style="width: 15%" checked data-toggle="toggle"--}}
{{--               data-on="Pubico" data-off="Privado" data-onstyle="success" data-offstyle="warning">--}}
{{--    </div>--}}
    <div class="entry" id="idDivTrocarTipoPublicoPrivadoModelo">
        <input id="idTrocarTipoPublicoPrivadoModelo" type="checkbox" data-toggle="toggle" data-on="Publico" data-off="Privado" data-onstyle="success" data-offstyle="info">
    </div>
</div>

@yield('scripts')
<script src="{!! asset('modeler/app.js') !!}"></script>


</body>

</html>
