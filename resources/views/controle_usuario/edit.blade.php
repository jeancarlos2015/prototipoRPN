@extends('layouts.admin.layouts.layout_usuario.main')
@section('content')

    @includeIf('controle_usuario.componente.cards')

@endsection

@section('titulo')
  @includeIf('controle_usuario.componente.titulos_view_edit_usuarios')
@endsection
