@extends('layouts.admin.layouts.layout_representacao.main')

@section('content')

    @includeIf('controle_modelos_diagramaticos.componentes.form_diagramatico_update')
@endsection

@section('titulo')
   @includeIf('controle_modelos_diagramaticos.componentes.titulos_edit')
@endsection

@section('botoes_listar_atribuir')
    @includeIf('controle_repositorios.componentes.botoes_atribuicao_listagem_usuarios')
@endsection

@section('modal')
    @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',['rota' => 'vincular_usuario_modelo'])
    @includeIf('controle_repositorios.componentes.modal_listagem_usuarios',
    [
    'entradas' => $representacao_diagramatica->modelo->usuarios_modelos,
    'tipo_modal' => 'modal_modelo',
    'titulo' => 'Modelo'
    ])
    @includeIf('painel.componentes.modal_mensagens_usuario',['entradas' => $representacao_diagramatica->modelo->usuarios_modelos])
@endsection

@section('menu_usuarios')
    @includeIf('menu.componentes.menu_usuarios',[
  'entradas' => $representacao_diagramatica->modelo->usuarios_modelos,
    ])
@endsection
