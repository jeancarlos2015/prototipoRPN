<a href="{!! route($rota_exibicao,[$modelo1->codmodelo]) !!}">
    <div class="media">
        @if(!empty($modelo1->usuario->email))
            <img class="d-flex mr-3 rounded-circle"
                 src="{{ Gravatar::src($modelo1->usuario->email) }}"
                 alt="" width="100">
        @else
            <img class="d-flex mr-3 rounded-circle"
                 src="{{ Gravatar::src('removido@gmail.com') }}"
                 alt="" width="50">
        @endif

        <div class="media-body">
            <strong>{!!  $modelo1->nome !!}</strong>
            @if(Auth::user()->EAdministrador())
                <div class="text-muted smaller">
                    Repositório: {!! $modelo1->repositorio->nome !!}</div>
            @endif
            <div class="text-muted smaller">Responsável: {!! $modelo1->usuario->name !!}</div>
            {{--                                <div class="text-muted smaller">Descrição do--}}
            {{--                                    modelo: {!! $modelo1->descricao !!}</div>--}}
            <div class="text-muted smaller">
                Alteração: {!! $modelo1->updated_at->format('d M Y') !!}
            </div>
            <div class="text-muted smaller">
                Processo: {!! $modelo1->projeto->nome !!}
            </div>

            <div class="text-muted smaller">
                Usuários : {!! $modelo1->qt_usuarios() !!}</div>
            <div class="text-muted smaller">
                @if($modelo1->validado())
                    Validado :
                    <img class="d-flex mr-3 rounded-circle"
                         src="{!! asset('img/ok.png') !!} "
                         style="width: 15px">
                @else
                    Não Validado :
                    <img class="d-flex mr-3 rounded-circle"
                         src="{!! asset('img/nao-ok.png') !!} "
                         style="width: 15px">
                @endif

            </div>

            <div class="text-muted smaller">
                Representações: {!! $modelo1->qt_representacoes() !!}</div>

            {{--                                <div class="text-muted smaller">--}}
            {{--                                    Tipo: @if($modelo1->publico) Público @else Privado @endif </div>--}}
        </div>
    </div>
</a>
