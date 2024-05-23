@extends('layouts.admin.layouts.layout_representacao_declarativa.main')

@section('content')
    @if(Auth::getUser()->ECliente())
        @includeIf('layouts.admin.componentes.tables',[
                               'titulos' => $titulos,
                               'regras' => $objetos_fluxos,
                               'rota_exibicao' => 'controle_objetos_fluxos.show',
                               'nome_botao' => 'Novo',
                               'titulo' =>'Objetos de Fluxo'
               ])


    @elseif(Auth::getUser()->EColaborador())
        @if(!empty($modelo_declarativo))
            @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
        @endif
        @includeIf('layouts.admin.componentes.tables',[
                        'titulos' => $titulos,
                        'regras' => $objetos_fluxos,
                        'rota_edicao' => 'controle_objetos_fluxos.edit',
                        'rota_exibicao' => 'controle_objetos_fluxos.show',
                        'nome_botao' => 'Novo',
                        'titulo' =>'Objetos de Fluxo'
        ])
        @if(!empty($modelo_declarativo))
            @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.links_padroes_recomendacao')
        @endif
    @elseif(Auth::getUser()->TemPermissaoParaEscluir())
        @if(!empty($modelo_declarativo))
            @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
        @endif
        @includeIf('layouts.admin.componentes.tables',[
                        'titulos' => $titulos,
                        'regras' => $objetos_fluxos,
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
    <div class="card text-white o-hidden h-100" style="background-color: #0b2e13">
        <div class="card-body">
            <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
            </div>
            <div class="mr-5 text-center">OBJETOS DE FLUXOS </div>
        </div>
        <a class="card-footer text-white clearfix small z-1"
           href="{!! URL::previous()!!}">
             <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
        </a>
    </div>
@endsection

@section('modo')
    @if(Auth::user()->existe_repositorio())
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @endif
@endsection

@section('modo')
    @if(Auth::user()->existe_repositorio())
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @endif
@endsection