@extends('layouts.admin.layouts.layout_modelo.main')

@section('content')

    @if(Auth::user()->usuario_esta_no_repositorio())
        @if(Auth::getUser()->Enormal())

            @includeIf('layouts.admin.componentes.tables',[
                         'titulos' => ['Modelo','Ações'],
                         'modelos' => $repositorio->modelos,
                         'rota_edicao' => 'controle_modelos.edit',
                         'rota_exclusao' => 'controle_modelos.destroy',
                         'rota_cricao' => 'controle_modelos.create',
                         'rota_exibicao' => 'controle_modelos_diagramaticos_index',

                         'nome_botao' => 'Novo',
                         'botao' => 'Novo',
                         'titulo' => 'Modelos - Clique no modelo desejado para gerenciar suas representações!!',
                         'tipo' => 'modelo'
         ])
        @endif
    @else
        @includeIf('layouts.admin.componentes.tables',[
                       'titulos' => Auth::user()->titulos_modelo(),
                       'modelos' => Auth::user()->todos_modelos(),
                       'rota_edicao' => 'controle_modelos.edit',
                       'rota_exclusao' => 'controle_modelos.destroy',
                       'rota_cricao' => 'controle_modelos.create',
                       'rota_exibicao' => 'controle_modelos_diagramaticos_index',

                       'nome_botao' => 'Novo',
                       'botao' => 'Novo',
                       'titulo' => 'Modelos - Clique no modelo desejado para gerenciar suas representações!!',
                       'tipo' => 'modelo'
       ])
    @endif

@endsection

@section('codigo_css')
    <style>
        .fonte-menor {
            font-size: small;
        }
    </style>
@endsection

@section('titulo')
 @includeIf('controle_modelos.componentes.titulos_view_all')
@endsection


@section('modo')
    @if(Auth::user()->existe_repositorio())
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @endif
@endsection

@section('modal')
        @includeIf('painel.modais.modais')
@endsection
