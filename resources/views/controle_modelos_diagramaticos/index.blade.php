@extends('layouts.admin.layouts.layout_representacao.main')
@if(!empty($modelo))
@section('content')



    @if(!empty($modelo->repositorio))
        @includeIf('layouts.admin.componentes.botao',
        [
        'tipo' => 'diagramatico',
        'modelo' => $modelo
        ])
        @includeIf('layouts.admin.componentes.botao',
        [
        'tipo' => 'declarativo',
        'modelo' => $modelo
        ])
    @endif

    @if(!empty($modelo->representacoes_diagramaticas))
        @includeIf('layouts.admin.componentes.tables',[
                          'titulos' => ['Diagrama','Autor','Ações'],
                          'modelos' => $modelo->representacoes_diagramaticas,
                          'rota_edicao' => 'editar_diagrama',
                          'rota_exclusao' => 'deletar_diagrama',
                          'rota_cricao' => 'criar_diagrama',
                          'rota_exibicao' => 'exibir_diagrama',
                          'nome_botao' => 'Novo',
                          'titulo' =>'Diagramas BPMN',
                          'tipo' => 'diagramatico'
          ])
    @endif
@endsection

@section('modal')
@includeIf('painel.modais.modais')
@if (Auth::getUser()->usuario_esta_no_repositorio())

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
@endif
@endsection

@section('botoes_listar_atribuir')

    @includeIf('controle_repositorios.componentes.botoes_atribuicao_listagem_usuarios')

@endsection

@section('titulo')
@includeIf('controle_modelos_diagramaticos.componentes.titulos_index')
@endsection
@section('menu_usuarios')
    @includeIf('menu.componentes.menu_usuarios',[
        'entradas' => $modelo->usuarios_modelos
    ])

    @if(Auth::getUser()->usuario_esta_no_repositorio())
        @if(collect(Auth::user()->solicitacoes_repositorio())->count()>0)
            @includeIf('menu.componentes.menu_solicitacoes',[
            'solicitacoes' => Auth::user()->solicitacoes_repositorio()
            ])
        @endif
    @endif

@endsection
@else
    <h3>Não existe Nenhum Modelo para ser mostrado</h3>
@endif


@section('codigo_js')
    <script>
        function mensagem() {
            alert("É necessário que esteja em um repositório!!!");
        }
    </script>

@endsection

@section('modo')
    @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @if(!empty(Auth::getUser()->usuarios_repositorios))
        @includeIf('layouts.admin.layouts.sub_componentes.menu_solicitar_a_usuarios',[
        'entradas' => Auth::getUser()->usuarios_repositorios
        ])
    @endif
@endsection
