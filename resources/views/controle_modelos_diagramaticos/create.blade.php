@extends('layouts.admin.layouts.layout_representacao.main')
@if(!empty($modelo))
@section('content')

    @includeIf('controle_modelos_diagramaticos.componentes.form_diagramatico_create',[
    'dados' => $modelo->dados(),
    'modelo' => $modelo
    ])
    @if(!empty($mensagem))
        <div class="alert alert-warning">
            <strong>Warning!</strong> {!! $mensagem !!}
        </div>
    @endif
@endsection

@section('titulo')
  @includeIf('controle_modelos_diagramaticos.componentes.titulos_create')
@endsection

@section('codigo_css')
    <link href="{!! asset('plugins/dropzone-master/dist/dropzone.css') !!}" rel="stylesheet" type="text/css">
@endsection

@section('codigo_js')
    <script src="{!! asset('plugins/dropzone-master/dist/dropzone.js') !!}"></script>
@endsection
@else
@section('content')
    <h4>Houve um Problema e ele será resolvido!!</h4>
@endsection
@endif
