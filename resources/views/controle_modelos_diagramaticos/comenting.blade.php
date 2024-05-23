<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    @Auth
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endauth
    <link href="{!! asset('comentando/diagram-js.css') !!}" rel="stylesheet">
    <link href="{!! asset('comentando/comments.css') !!}" rel="stylesheet">
    <link href="{!! asset('comentando/style.css') !!}" rel="stylesheet">

    <style type="text/css">
        html, body {
            height: 100%;
            padding: 0;
            margin: 0;
        }

        #canvas {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        #canvas > div {
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

        #btnSalvarDiagrama{
            width:150px;
        }
        #canvas img{
            display: none;
        }
    </style>
    <title>RPN</title>
</head>
<body>



<div id="canvas"></div>
{{--{!! dd($diagrama) !!}--}}
<textarea id="diagramaBaixado" hidden>
{!! isset($diagrama->xml_modelo_comentado) ? $diagrama->xml_modelo_comentado : $diagrama->xml_modelo !!}
{{--{!! $diagrama->xml_modelo !!}--}}
</textarea>

<input type="text" id="codmodelodiagramatico" value="{!! $diagrama->codmodelodiagramatico !!}" hidden>
<div class="toolbar">

    <div class="entry">
        <a href data-download download="digrama-comentado.bpmn">Download</a>
    </div>

    <div class="entry">
        <input type="file" data-open-file value="open" />
    </div>

    <div class="entry">
        <input class="btn btn-primary" type="button" value="Salvar Diagrama" id="btnSalvarDiagrama">
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{!! asset('comentando/app.js') !!}"></script>

</body>
</html>
