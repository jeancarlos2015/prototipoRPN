@extends('layouts.admin.layouts.layout_representacao_declarativa.main')

@section('content')
    @includeIf('controle_modelos_declarativos.modelos_declarativos.componentes.form_create')
    @if(!empty($representacao_declarativa))
        <div class="alert alert-warning">
            <strong>Warning!</strong> O modelo já existe, para acessá-lo clique neste <a
                    href="{!! route('controle_modelos_declarativos.show',[$representacao_declarativa->codmodelodeclarativo]) !!}"
                    class="link">Link</a>.
        </div>
    @endif
@endsection

@section('titulo')
    @if(!empty($modelo))
        <div class="card text-white o-hidden h-100" style="background-color: #985f0d">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-list"></i>
                </div>
                <div class="mr-5 text-center">PROCESSO {!! strtoupper($modelo->projeto->nome) !!}</div>
                <div class="mr-5 text-center">DIAGRAMAS: {!! $modelo->qt_representacoes()!!} </div>
                <div class="mr-5 text-center">NOVA REPRESENTAÇÃO DECLARATIVA</div>
            </div>
            <a class="card-footer text-white clearfix small z-1"
               href="{!! route('painel') !!}">
             <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
            </a>
        </div>
    @else
        <div class="card text-white o-hidden h-100" style="background-color: #985f0d">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-list"></i>
                </div>
                <div class="mr-5 text-center">PARA CRIAR UMA REPRESENTAÇÃO É NECESSÁRIO QUE ESTEJA EM UM REPOSITÓRIO</div>

            </div>
            <a class="card-footer text-white clearfix small z-1"
               href="{!! route('painel') !!}">
             <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
            </a>
        </div>
    @endif
@endsection
