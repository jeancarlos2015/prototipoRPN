@extends('layouts.home.main')
@section('content')
@endsection

@section('nav')
    @includeIf('layouts.home.nav',['pagina' => 'inicio'])
@endsection

@section('meta_inicio')
    <meta name="description"
        content="Repositório de processos de negócio é uma base de armazenamento de diagramas bpmn e modelos declarativos tendo também um ambiente de modelagem de diagrama bpmn não sendo necessário o uso de ambientes externos para o mesmo fim.">
    <meta name="keywords" content="BPMN, Digrama, RPN, Repositório, Processo, Negócio">
    <meta name="author" content="Jean Carlos Penas, Mateus Conrad">
    <meta name="robots"
        content="Repositório de processos de negócio, Diagramas BPMN, Modelos declarativos, Padrões BPMN, Base de modelos BPMN, BPMN 2.0">
@endsection
