@extends('layouts.admin.layouts.layout_representacao.main')

@section('content')

    @includeIf('layouts.admin.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' => 'Painel/Todos Modelos / Modelos'
   ])
    @includeIf('layouts.admin.componentes.tables',[
                      'titulos' => $titulos,
                      'modelos' => $modelos,
                      'rota_exclusao' => 'deletar_diagrama',
                      'rota_exibicao' => 'exibir_diagrama',
                      'rota_edicao' => 'editar_diagrama',
                      'nome_botao' => 'Novo',
                      'titulo' =>'Diagramas BPMN'
      ])
    @includeIf('controle_modelos_diagramaticos.componentes.modal_form_diagramas_comentario',['diagramas' => $modelos])
@endsection

@section('titulo')
    @includeIf('controle_modelos_diagramaticos.componentes.titulos_index_todos_modelos')
@endsection
