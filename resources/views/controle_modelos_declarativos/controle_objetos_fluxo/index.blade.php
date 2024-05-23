@extends('layouts.admin.layouts.layout_representacao_declarativa.main')

@section('content')
    @if(Auth::getuser()->Ecliente())
        @includeIf('layouts.admin.componentes.tables',[
                     'titulos' => $titulos,
                     'objetos_fluxos' => $modelo_declarativo->objetos_fluxos,
                     'rota_exibicao' => 'controle_objetos_fluxos.show',
                     'nome_botao' => 'Novo',
                     'titulo' =>'Objetos de Fluxo'
     ])
    @elseif(Auth::getuser()->EColaborador())

        @if(!empty($modelo_declarativo))
            @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
        @endif
        @includeIf('layouts.admin.componentes.tables',[
                        'titulos' => $titulos,
                        'objetos_fluxos' => $modelo_declarativo->objetos_fluxos,
                        'rota_edicao' => 'controle_objetos_fluxos.edit',
                        'rota_exibicao' => 'controle_objetos_fluxos.show',
                        'nome_botao' => 'Novo',
                        'titulo' =>'Objetos de Fluxo'
        ])
        @if(!empty($modelo_declarativo))
            @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.links_padroes_recomendacao')
        @endif
    @elseif(Auth::getuser()->EProprietario() || Auth::getuser()->EAdministrador())
        @if(!empty($modelo_declarativo))
            @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
        @endif
        @includeIf('layouts.admin.componentes.tables',[
                        'titulos' => $titulos,
                        'objetos_fluxos' => $modelo_declarativo->objetos_fluxos,
                        'rota_edicao' => 'controle_objetos_fluxos.edit',
                        'rota_exclusao' => 'controle_objetos_fluxos.destroy',
                        'rota_exibicao' => 'controle_objetos_fluxos.show',
                        'nome_botao' => 'Novo',
                        'titulo' =>'Objetos de Fluxo'
        ])
        @if(!empty($modelo_declarativo))
            @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.links_padroes_recomendacao')
        @endif
    @endif
@endsection

@section('titulo')
   @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.titulos_view_index')
@endsection

@section('menu_usuarios')
    @includeIf('menu.componentes.menu_usuarios')
@endsection