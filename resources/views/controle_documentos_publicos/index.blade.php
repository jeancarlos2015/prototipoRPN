@extends('layouts.home.main')
@section('content')
    @includeIf('controle_documentos_publicos.componentes.tabela.tabela')
@endsection

@section('codigo_css')
    <link href="{!! asset('vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('vendor/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('vendor/datatables/dataTables.bootstrap4.css') !!}" rel="stylesheet">
@endsection


@section('codigo_js')
{{--    <script src="{!! asset('vendor/jquery/jquery.min.js') !!}"></script>--}}
<script src="{!! asset('vendor/mordernize/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset('vendor/mordernize/2.8.3/modernizr.js') !!}"></script>
    <script src="{!! asset('vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
    <script src="{!! asset('vendor/jquery-easing/jquery.easing.min.js') !!}"></script>
    <script src="{!! asset('vendor/datatables/jquery.dataTables.js') !!}"></script>
    <script src="{!! asset('bootstrap/3.3.7/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('vendor/datatables/dataTables.bootstrap4.js') !!}"></script>
    <script src="{!! asset('js/sb-admin.min.js') !!}"></script>
    <script src="{!! asset('js/sb-admin-datatables.min.js') !!}"></script>
@endsection

@section('nav')
    @includeIf('layouts.home.nav',['pagina' => 'documentospublicos'])
@endsection
