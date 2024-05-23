@extends('relatorios.relatorio_projeto.layout.layout_relatorio')

@section('content')
    <div style="zoom: 75%">
        <div>
            <a href="{!! URL::previous() !!}">
                {{--<img src="{!! asset('img/voltar.png') !!} " style="width: 50px">--}}
                <i class="fa fa-reply"></i>
            </a>
        </div>
        @if (!empty($repositorio))
            @foreach($repositorio->projetos as $projeto)
                @includeIf('relatorios.relatorio_projeto.componentes.header',['projeto' => $projeto])
                <div class="card-body">
                    @if(Auth::getUser()->usuario_esta_no_repositorio())
                        @includeIf('relatorios.relatorio_projeto.componentes.modelos',['projeto' => $projeto])

                        @includeIf('relatorios.relatorio_projeto.componentes.diagramas',['projeto' => $projeto])

                        @includeIf('relatorios.relatorio_projeto.componentes.objetos_fluxos',['projeto' => $projeto])

                        @includeIf('relatorios.relatorio_projeto.componentes.regras',['projeto' => $projeto])

                        @includeIf('relatorios.relatorio_projeto.componentes.usuarios_projetos',['projeto' => $projeto])
                    @endif
                </div>
            @endforeach

        @elseif(!empty($projeto))
            @includeIf('relatorios.relatorio_projeto.componentes.header')
            <div class="card-body">
                @if(Auth::getUser()->usuario_esta_no_repositorio())
                    @includeIf('relatorios.relatorio_projeto.componentes.modelos')

                    @includeIf('relatorios.relatorio_projeto.componentes.diagramas')

                    @includeIf('relatorios.relatorio_projeto.componentes.objetos_fluxos')

                    @includeIf('relatorios.relatorio_projeto.componentes.regras')

                    @includeIf('relatorios.relatorio_projeto.componentes.usuarios_projetos')
                @endif
            </div>
        @endif

    </div>


@endsection
