@extends('layouts.admin.layouts.layout_principal.main')
@section('content')

    @if(Auth::getuser()->TemPermissaoParaEscluir())
        @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
        @includeIf('layouts.admin.componentes.tables',[
                        'titulos' => $titulos,
                        'regras' => $modelo->regras,
                        'rota_edicao' => 'controle_regras.edit',
                        'rota_exclusao' => 'controle_regras.destroy',
                        'rota_criacao' => 'controle_regras.create',
                        'rota_exibicao' => 'controle_regras.show',
                        'nome_botao' => 'Novo',
                        'botao' => 'Novo',
                        'titulo' => 'Regras'
        ])
    @elseif(Auth::getuser()->Ecliente())
        @includeIf('layouts.admin.componentes.tables',[
                    'titulos' => $titulos,
                    'regras' => $modelo->regras,
                    'rota_exibicao' => 'controle_regras.show',
                    'nome_botao' => 'Novo',
                    'botao' => 'Novo',
                    'titulo' => 'Regras'
    ])
    @elseif(Auth::getuser()->EColaborador())
        @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
        @includeIf('layouts.admin.componentes.tables',[
                        'titulos' => $titulos,
                        'regras' => $modelo->regras,
                        'rota_edicao' => 'controle_regras.edit',
                        'rota_criacao' => 'controle_regras.create',
                        'rota_exibicao' => 'controle_regras.show',
                        'nome_botao' => 'Novo',
                        'botao' => 'Novo',
                        'titulo' => 'Regras'
        ])
    @endif
@endsection

@section('titulo')
    @includeIf('controle_regras.componentes.titulos_view_index_regras')
@endsection

@section('menu_usuarios')
    @includeIf('menu.componentes.menu_usuarios')
@endsection

@section('modo')
    @if(Auth::user()->existe_repositorio())
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @endif
@endsection
