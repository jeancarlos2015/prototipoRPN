

@extends('layouts.home.main')
@section('content')

    @includeIf('modelos_publicos.componentes.tabela.tabela')
@endsection

@section('codigo_css')
    <style>
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
    <link href="{!! asset('vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('vendor/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('vendor/datatables/dataTables.bootstrap4.css') !!}" rel="stylesheet">
@endsection


@section('codigo_js')

{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>--}}
<script src="{!! asset('vendor/mordernize/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset('vendor/mordernize/2.8.3/modernizr.js') !!}"></script>
    <script src="{!! asset('vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
    <script src="{!! asset('vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
    <script src="{!! asset('vendor/jquery-easing/jquery.easing.min.js') !!}"></script>
    <script src="{!! asset('vendor/datatables/jquery.dataTables.js') !!}"></script>
    <script src="{!! asset('bootstrap/3.3.7/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('vendor/datatables/dataTables.bootstrap4.js') !!}"></script>
    <script src="{!! asset('js/sb-admin.min.js') !!}"></script>

    <script src="{!! asset('js/sb-admin-datatables.min.js') !!}"></script>
    <script>
        //paste this code under the head tag or in a separate js file.
        // Wait for window load
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>
@endsection

@section('nav')
    @includeIf('layouts.home.nav',['pagina' => 'modelospublicos'])
@endsection

@section('meta_inicio')
    <meta name="description"
        content="Esta página visa exibir todos os modelos bpmns na forma de xml e também na forma svg para que o usuário possa identificar o modelo que melhor se adequa ao problema do mundo real ao qual visa solucionar.">
    <meta name="keywords" content="Modelos públicos, XML, BPMN, SVG">
    <meta name="robots"
        content="Exibir modelos bpmn na forma de BPMN (XML) e SVG">
@endsection
