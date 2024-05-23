@extends('controle_modelo_declarativo1.layouts.wizard1.main')

@section('content')
    @if(count($modelo->objetos_fluxos)>0)
        <div class="top-content" style="margin-top: 5%">
            <div class="container">

                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1>RPN - EXECUÇÃO DO MODELO {!! $modelo->nome !!}</h1>
                        <div class="description">
                            <p>
                                Este Projeto é de caráter acadêmico
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">
                        @includeIf('controle_checklist_modelo.form',[
                        'objetos' => $modelo->objetos_fluxos
                        ])
                    </div>
                </div>

            </div>
        </div>
    @else
        @if(Auth::check())
            <div class="top-content" style="margin-top: 5%">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1>Não existem tarefas, solicite a criação do checklist</h1>
                            {{--<a href="#" class="btn btn-danger">Solicitar</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="top-content" style="margin-top: 5%">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1>Não existe um cheklist para este modelo, então é necessário que se torne um membro do repositorio {!! $modelo->repositorio->nome !!} para solicitar a criação do checklist</h1>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endif
@endsection