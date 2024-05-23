@extends('layouts.admin.layouts.layout_representacao_declarativa.main')

@section('content')

    @if(!Auth::getuser()->ECliente())
        @includeIf('controle_modelos_declarativos.controle_regras.componentes.form_create',[
        'objetos_fluxos' => $modelo->objetos_fluxos
        ])
    @endif
@endsection

@section('titulo')

    <div class="card text-white o-hidden h-100" style="background-color: #6b4214">
        <div class="card-body">
            <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
            </div>
            <div class="mr-5 text-center">MODELO {!! $modelo->nome !!}</div>
        </div>
        <a class="card-footer text-white clearfix small z-1"
           href="{!! URL::previous() !!}">
             <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
        </a>
    </div>
@endsection