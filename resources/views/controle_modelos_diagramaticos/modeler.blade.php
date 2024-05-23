@extends('controle_modelos_diagramaticos.layout_diagrama_novo.main')
@section('css')
    @includeIf('layouts.admin.layouts.layout_principal.head')
@endsection

@section('scripts')
    <input id="idCodModeloModeler" value="{!! $modelo->codmodelo !!}" hidden>
    @includeIf('layouts.admin.layouts.layout_principal.scripts')
    @includeIf('controle_modelos_diagramaticos.componentes.script_menu')
@endsection
@section('modais')
    @includeIf('painel.componentes.modal_nome_repositorio',['diagrama' => $modelo])
    @includeIf('painel.componentes.modal_mensagens_usuario',['entradas' => $modelo->modelo->usuarios_modelos])
    @includeIf('controle_modelos_diagramaticos.componentes.descricao_modelo3')
    @if ($modelo->eProprietario())
        @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios_diagrama',
                    [
                        'rota' => 'vincular_usuario_modelo',
                        'codigo' => $modelo->codmodelo
                    ])
    @else
        @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',
                    [
                        'rota' => 'vincular_usuario_modelo',
                        'codigo' => $modelo->codmodelo
                    ])
    @endif

    @includeIf('controle_repositorios.componentes.modal_listagem_usuarios',
     [
     'entradas' => $modelo->repositorio->usuarios_repositorios,
     'tipo_modal' => 'modal_repositorio',
     'titulo' => 'repositorio'
     ])
    @includeIf('painel.componentes.modal_mensagens_usuario',['entradas' => $modelo->modelo->usuarios_modelos])
    @includeIf('modais.repositorios.repositorios')

    @includeIf('modais.validadores.validadores',['diagrama' => $modelo,'rota'=> 'vincular_usuario_modelo', 'codigo'=> $modelo->codmodelo])
    @includeIf('modais.AcessosRecentes.AcessosRecentes')
    @include('modais.transferencia.modal_transferencia_diagrama',['diagrama' => $modelo])
    @includeIf('modais.versionamento.versionamento',['diagrama' => $modelo])
@endsection


@section('modo')
    @includeIf('menu.componentes.menu_usuarios_superior',['diagrama' => $modelo])

    @includeIf('controle_modelos_diagramaticos.componentes.voltar',['modelo' => $modelo])

@endsection

@section('dropdown_menu_ambiente_modelagem')
    @includeIf('controle_modelos_diagramaticos.componentes.menu',['tipo' => 'visualizacao','diagrama' => $modelo])
@endsection

@section('head_body')
    @includeIf('controle_modelos_diagramaticos.layout_diagrama.head_body')
@endsection

@section('nav_menu_superior_modelo')
    @includeIf('menu.nav_menu_superior')
@endsection
