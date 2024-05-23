@extends('layouts.admin.layouts.layout_representacao_declarativa.main')

@section('content')

    @if(Auth::getuser()->EProprietario() || Auth::getuser()->EAdministrador())
        @includeIf('layouts.admin.componentes.breadcrumb',[
                        'titulo' => 'PainelPrincipalViwer',
                        'rota' => 'painel',
                        'sub_titulo' => 'Repositório/'.$modelo->repositorio->nome.'Processos/'.$modelo->projeto->nome.'/Modelos'
        ])
        @if(!empty($modelo->repositorio))
            @includeIf('layouts.admin.componentes.botao',['tipo' => 'declarativo'])
        @endif
        @includeIf('layouts.admin.componentes.tables',[
                        'titulos' => $titulos,
                        'modelos' => $modelos,
                        'rota_edicao' => 'controle_modelos_declarativos.edit',
                        'rota_exclusao' => 'controle_modelos_declarativos.destroy',
                        'rota_cricao' => 'controle_modelos_declarativos.create',
                        'rota_exibicao' => 'controle_modelos_declarativos.show',
                        'nome_botao' => 'Novo',
                        'titulo' =>'Modelos Declarativos'
        ])
    @elseif(Auth::getuser()->EColaborador())
        @includeIf('layouts.admin.componentes.breadcrumb',[
                        'titulo' => 'Painel',
                        'rota' => 'painel',
                        'sub_titulo' => 'Repositório/'.$modelo->repositorio->nome.'Processos/'.$modelo->projeto->nome.'/Modelos'
        ])
        @if(!empty($modelo->repositorio))
            @includeIf('layouts.admin.componentes.botao',['tipo' => 'declarativo'])
        @endif
        @includeIf('layouts.admin.componentes.tables',[
                        'titulos' => $titulos,
                        'modelos' => $modelos,
                        'rota_edicao' => 'controle_modelos_declarativos.edit',
                        'rota_cricao' => 'controle_modelos_declarativos.create',
                        'rota_exibicao' => 'controle_modelos_declarativos.show',
                        'nome_botao' => 'Novo',
                        'titulo' =>'Modelos Declarativos'
        ])
    @elseif(Auth::getuser()->Ecliente())
        @includeIf('layouts.admin.componentes.breadcrumb',[
                        'titulo' => 'Painel',
                        'rota' => 'painel',
                        'sub_titulo' => 'Repositório/'.$modelo->repositorio->nome.'Processos/'.$modelo->projeto->nome.'/Modelos'
        ])
        @includeIf('layouts.admin.componentes.tables',[
                       'titulos' => $titulos,
                       'modelos' => $modelos,
                       'rota_exibicao' => 'controle_modelos_declarativos.show',
                       'nome_botao' => 'Novo',
                       'titulo' =>'Modelos Declarativos'
       ])
    @endif

@endsection

@section('titulo')
    <div class="text-center">
        <h3> Lista de Representações Declarativas </h3>
        <h4> Repositório {!! $modelo->repositorio->nome !!} </h4> <br>
        @if($modelo->projeto->publico)
            <strong> Processo Público -  {!!$modelo->projeto->nome !!} </strong> <br>
        @else
            <strong> Processo Privado -  {!!$modelo->projeto->nome !!} </strong> <br>
        @endif
        <strong> Modelo {!!$modelo->nome !!} </strong> <br>
    </div>
@endsection

@section('menu_usuarios')
    @includeIf('menu.componentes.menu_usuarios')
@endsection
