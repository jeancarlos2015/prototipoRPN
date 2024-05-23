<div class="card card-body text-left">
    <a href="{!! route('visualizar_modelo_publico',[$representacao_diagramatica->codmodelodiagramatico]) !!}">
        <div class="media">
            @if(!empty($representacao_diagramatica->usuario->email))
                <img class="d-flex mr-3 rounded-circle"
                     src="{{ Gravatar::src($representacao_diagramatica->usuario->email) }}"
                     alt="" width="60">
            @else
                <img class="d-flex mr-3 rounded-circle"
                     src="{{ Gravatar::src('naoexiste@gmail.com') }}"
                     alt="" width="60">
            @endif
            <div class="media-body">
                <strong>Modelo - {!!  strtolower($representacao_diagramatica->nome) !!}</strong>
                @if(!empty($representacao_diagramatica->usuario->name))
                    <div class="text-muted smaller">
                        Responsável: {!! strtoupper($representacao_diagramatica->usuario->name) !!}</div>
                @endif
                {{--<div class="text-muted smaller">Descrição do--}}
                    {{--Modelo: {!! strtoupper($representacao_diagramatica->descricao) !!}</div>--}}
                {{--<div class="text-muted smaller">--}}
                    {{--Tipo: {!! strtoupper($representacao_diagramatica->tipo) !!}</div>--}}
                {{--@if(!empty($representacao_diagramatica->projeto->nome ))--}}
                    {{--<div class="text-muted smaller">--}}
                        {{--Projeto: {!! strtoupper($representacao_diagramatica->projeto->nome) !!}</div>--}}
                {{--@endif--}}
                @if(!empty($representacao_diagramatica->repositorio->nome ))
                    <div class="text-muted smaller">
                        Repositório: {!! strtoupper($representacao_diagramatica->repositorio->nome) !!}
                    </div>
                @endif
                {{--<div class="text-muted smaller">--}}
                    {{--Data da Criação: {!! $representacao_diagramatica->created_at !!}</div>--}}
                {{--<div class="text-muted smaller">--}}
                    {{--Data da Atualização: {!! $representacao_diagramatica->updated_at !!}</div>--}}

            </div>
        </div>
    </a>
</div>
