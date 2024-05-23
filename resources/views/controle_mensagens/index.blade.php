@extends('layouts.admin.layouts.layout_usuario.main')
@section('content')



            @includeIf('layouts.admin.componentes.botao',
            [
            'tipo' => $tipo,
            'botao_usuario' => 'Nova Mensagem',
            'rota' => 'controle_mensagens_create'
            ])



            @includeIf('layouts.admin.componentes.tables',[
                                  'titulos' => $titulos,
                                  'mensagens' => $mensagens,
                                  'rota_edicao' => 'controle_mensagens_edit',
                                  'rota_exclusao' => 'controle_mensagens_destroy',
                                  'rota_exibicao' => 'controle_mensagens_show',
                                  'nome_botao' => 'Novo',
                                  'titulo' =>'Mensagens'
                  ])



@endsection


@section('modal')
    {{--@if(Auth::getUser()->usuario_esta_no_repositorio())--}}
        {{--@includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',[--}}
        {{--'rota_vinculo' => 'vincular_usuario_repositorio',--}}
        {{--'titulo' => 'repositorio',--}}
        {{--'repositorio' => Auth::user()->repositorio--}}
        {{--])--}}
        {{--@includeIf('controle_repositorios.componentes.modal_lisatagem_usuarios',--}}
        {{--[--}}
        {{--'entradas' => Auth::user()->repositorio->usuarios_repositorios,--}}
        {{--'tipo_modal' => 'modal_repositorio',--}}
        {{--'titulo' => 'repositorio'--}}
        {{--])--}}
    {{--@endif--}}

@endsection

@section('botoes_listar_atribuir')

    <div class="card text-white o-hidden h-100" style="background-color: #2C3E50">
        <div class="card-body">
            <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
            </div>
            <div class="mr-5 text-center">CONTROLE DE MENSAGENS</div>
            @if(!empty($mensagens))
                <div class="mr-5 text-center">{!! count($mensagens)!!} Mensagens</div>
            @else
                <div class="mr-5 text-center">0 Mensagens</div>
            @endif
        </div>
        <a class="card-footer text-white clearfix small z-1"
           href="{!! URL::previous()!!}">
              <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
        </a>

    </div>
@endsection

@section('menu_usuarios')
    @if(Auth::getuser()->TemPermissaoParaEscluir())
        @if(Auth::getUser()->usuario_esta_no_repositorio())
            @includeIf('menu.componentes.menu_usuarios',[
            'entradas' => Auth::user()->repositorio->usuarios_repositorios
            ])
            @if(collect(Auth::user()->solicitacoes)->count()>0)
                @includeIf('menu.componentes.menu_solicitacoes',[
                'solicitacoes' => Auth::user()->solicitacoes
                ])
            @endif
        @endif
    @endif
@endsection