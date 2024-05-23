@extends('layouts.admin.layouts.layout_representacao.main')

@section('content')
    <form action="{!! route('upload')  !!}" class="dropzone">
        @csrf
        @if(!empty($diagrama))
            <input type="hidden" value="{!! $diagrama->codmodelodiagramatico !!}" name="codmodelodiagramatico">
        @endif
    </form>
    @includeIf('layouts.admin.componentes.tables',[
                            'titulos' => ['Arquivo','Ações'],
                            'arquivos' => $diagrama->arquivos,
                            'tipo' => 'arquivo'
            ])

@endsection

@section('titulo')
    @if(!empty($diagrama))
        <div class="card text-white o-hidden h-100" style="background-color: #0b2e13">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-list"></i>
                </div>
                <div class="mr-5 text-center">
                    PROJETO {!! strtoupper($diagrama->modelo->projeto->nome) !!}</div>
                <div class="mr-5 text-center">
                    DIAGRAMAS: {!! $diagrama->modelo->qt_representacoes()!!} </div>
                <div class="mr-5 text-center">EDIÇÃO DO DIAGRAMA {!! $diagrama->nome!!} </div>
            </div>
            <a class="card-footer text-white clearfix small z-1"
               href="{!! URL::previous()!!}">
              <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
            </a>

        </div>
    @endif

@endsection

@section('botoes_listar_atribuir')
    @if(!empty($diagrama))
        @includeIf('controle_repositorios.componentes.botoes_atribuicao_listagem_usuarios')
    @endif
@endsection

@section('modal')
    @if(!empty($diagrama))
        @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios',['rota' => 'vincular_usuario_modelo'])
        @includeIf('controle_repositorios.componentes.modal_listagem_usuarios',
        [
        'entradas' => $diagrama->modelo->usuarios_modelos,
        'tipo_modal' => 'modal_modelo',
        'titulo' => 'Modelo'
        ])
        @includeIf('painel.componentes.modal_mensagens_usuario',['entradas' => $diagrama->modelo->usuarios_modelos])
    @endif
@endsection

@section('menu_usuarios')
    @if(!empty($diagrama))
        @includeIf('menu.componentes.menu_usuarios',[
      'entradas' => $diagrama->modelo->usuarios_modelos,
        ])
    @endif
@endsection

@section('conteudo_script')
    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">


@endsection
