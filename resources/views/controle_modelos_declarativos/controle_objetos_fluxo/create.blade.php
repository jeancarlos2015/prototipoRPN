@extends('layouts.admin.layouts.layout_representacao_declarativa.main')
@section('content')

    @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.form_create')

@endsection

@section('titulo')
 @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.titulos_view_create')
@endsection
