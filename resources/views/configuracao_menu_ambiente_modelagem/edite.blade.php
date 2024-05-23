@extends('layouts.admin.layouts.layout_vazio.main')

@section('content')

    @includeIf('layouts.admin.componentes.breadcrumb',
    [
    'titulo' => 'Todos as Configurações'
    ])


    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Configuração do Ambiente do Modelagem
            </div>
        </div>
        <div class="card-body">
            @if (Auth::getUser()->ExisteConfiguracaoAmbienteModelagem())
                @includeIf('configuracao_menu_ambiente_modelagem.componentes.form_put')
            @else
                Não existe nenhuma configuração criada
            @endif
        </div>

    </div>

@endsection


{{--@section('modo')--}}

{{--    @includeIf('controle_documentacao.componentes.titulo_menu_superior',[--}}
{{--    'titulo' => 'Edição da Configuração',--}}
{{--    'descricao' => 'Visualização da configuração'--}}
{{--    ])--}}
{{--@endsection--}}

{{--@section('modal')--}}
{{--    @includeIf('painel.modais.modais')--}}

{{--@endsection--}}
