@extends('layouts.admin.layouts.layout_principal.main')
@section('content')

    @if(Auth::getuser()->TemPermissaoParaEscluir())
        @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
        @includeIf('layouts.admin.componentes.tables',[
                    'titulos' => $titulos,
                    'regras' => $regras,
                    'nome_botao' => 'Novo',
                    'botao' => 'Novo',
                    'titulo' => 'Regras'
                    ])
    @elseif(Auth::getuser()->Ecliente())
        @includeIf('layouts.admin.componentes.tables',[
                   'titulos' => $titulos,
                   'regras' => $regras,
                   'nome_botao' => 'Novo',
                   'botao' => 'Novo',
                   'titulo' => 'Regras'
                   ])
    @elseif(Auth::getuser()->EAdministrador())
        @includeIf('layouts.admin.componentes.tables',[
                   'titulos' => $titulos,
                   'regras' => $regras,
                   'nome_botao' => 'Novo',
                   'botao' => 'Novo',
                   'titulo' => 'Regras'
                   ])
    @endif

@endsection

@section('titulo')
    @includeIf('controle_regras.componentes.titulos_view_all_regras')
@endsection

@section('modo')
    @if(Auth::user()->existe_repositorio())
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @endif
@endsection