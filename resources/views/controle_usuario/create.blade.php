@extends('layouts.admin.layouts.layout_usuario.main')
@section('content')

        @includeIf('controle_usuario.componente.form_usuario_create')


    @includeIf('controle_usuario.componente.alerta_usuario')
@endsection

@section('titulo')
    @includeIf('controle_usuario.componente.titulos_view_create_usuarios')
@endsection
