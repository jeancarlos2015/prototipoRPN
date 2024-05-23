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
                        Responsável: {!! strtoupper($representacao_diagramatica->usuario->name) !!}
                    </div>
                    <div class="text-muted smaller">
                        Alteração:   {!! $representacao_diagramatica->updated_at->format('d/m/Y H:i:s')!!}
                    </div>
                @endif
                @if(!empty($representacao_diagramatica->projeto->nome))
                    <div class="text-muted smaller">
                        Processo: {!! strtoupper($representacao_diagramatica->projeto->nome) !!}</div>
                @endif
                @if(!empty($representacao_diagramatica->repositorio->nome ))
                    <div class="text-muted smaller">
                        Repositório: {!! strtoupper($representacao_diagramatica->repositorio->nome) !!}
                    </div>
                @endif


{{--                @if(!empty($representacao_diagramatica))--}}
{{--                    <div class="text-muted smaller">--}}
{{--                        @if($representacao_diagramatica->validado)--}}
{{--                           <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/ok.png') !!} "--}}
{{--                                          style="width: 15px">--}}
{{--                        @else--}}
{{--                           <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/nao-ok.png') !!} "--}}
{{--                                          style="width: 15px">--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                @endif--}}
            </div>
            <div class="media">
                <div style="zoom: 7%">
                    {!! $representacao_diagramatica->existeSVG() ? $representacao_diagramatica->svg_modelo : $representacao_diagramatica->svgPadrao() !!}
                </div>
            </div>
        </div>
    </a>
</div>
