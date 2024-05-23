@extends('layouts.admin.layouts.layout_principal.main')

@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' => 'Painel/Todos Modelos / Modelos'
   ])

    @includeIf('layouts.admin.componentes.tables',[
                           'titulos' => $titulos,
                           'modelos' => $modelos,
                           'rota_exclusao' => 'deletar_historico_diagrama',
                           'rota_exibicao' => 'exibir_historicos_diagrama',
                           'rota_edicao' => 'editar_diagrama',
                           'nome_botao' => 'Novo',
                           'titulo' =>'Modelos'
           ])

@endsection

@section('titulo')
    <div class="text-center">
        <h3>Todas Representações BPMN </h3>
    </div>
@endsection

