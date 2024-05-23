<head>
    <meta charset="UTF-8" />
    <title>RPN</title>
{{--    <script src="{!! asset('js/custom-viewer.bundled.js') !!}"></script>--}}
{{--    <script src="{{asset('js/jquery.js')}}"></script>--}}
<!-- viewer -->
    <!-- viewer distro (with pan and zoom) -->
    <script src="https://unpkg.com/bpmn-js@6.5.1/dist/bpmn-navigated-viewer.development.js"></script>

    <!-- needed for this example only -->
    <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.js"></script>

{{--    <!-- jquery (required for example only) -->--}}
{{--    <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.js"></script>--}}
    <!-- example styles -->
    <style>
        html, body, #canvas {
            height: 100%;
            padding: 0;
            margin: 0;
            top: 65px;
        }

        .diagram-note {
            background-color: rgba(66, 180, 21, 0.7);
            color: White;
            border-radius: 5px;
            font-family: Arial;
            font-size: 12px;
            padding: 5px;
            min-height: 16px;
            width: 50px;
            text-align: center;
        }

        .descricao-label {
            position: fixed;
            bottom: 65%;
            left: 83%;
            padding: 20px 30px;
            background-color: #0b2e13;
            color: white;
            text-align: left;
            font-size: small;
        }

        .needs-discussion:not(.djs-connection) .djs-visual > :nth-child(1) {
            stroke: rgba(66, 180, 21, 0.7) !important; /* color elements as red */
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

    @includeIf('layouts.admin.layouts.layout_principal.css')
</head>
