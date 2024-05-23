<a href="{!! route($rota_exibicao,[$modelo1->codmodelodiagramatico]) !!}">
    <div class="media">
        <img class="d-flex mr-3 rounded-circle"
             src="{{ asset('img/diagram1.png')}}"
             alt="" width="30">
        <div class="media-body">
            <strong>{!!  $modelo1->nome !!}</strong>
            <div class="text-muted smaller">
                Usuários : {!! count($modelo1->usuarios_modelos) !!}</div>
            <div class="text-muted smaller">
                Alteração: {!! $modelo1->updated_at->format('d M Y') !!}
            </div>
            <div class="text-muted smaller">
                @if(!empty($modelo1->validador))
                    Validador: {!! $modelo1->validador->name !!}
                @endif
            </div>
            <div class="text-muted smaller">

                @if($modelo1->validado)
                    Validado:    <img src="{!! asset('img/ok.png') !!} " style="width: 15px">
                @else
                    Não Validado:    <img src="{!! asset('img/nao-ok.png') !!} "
                                          style="width: 15px">
                @endif
            </div>

        </div>
    </div>
</a>
