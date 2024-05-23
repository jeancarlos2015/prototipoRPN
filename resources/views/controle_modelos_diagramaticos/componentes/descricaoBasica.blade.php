<a href="{!! route($rota_exibicao,[$modelo1->codmodelodiagramatico]) !!}">
    <div class="media">
        @if(!empty($modelo1->usuario->email))
            <img class="d-flex mr-3 rounded-circle"
                 src="{{ Gravatar::src($modelo1->usuario->email) }}"
                 alt="" width="30"/>
        @else
            <img class="d-flex mr-3 rounded-circle"
                 src="{{ Gravatar::src('removido@gmail.com') }}"
                 alt="" width="30"/>
        @endif

        @if(!empty($modelo1->usuario->name))
            <strong>
                {!! $modelo1->usuario->name !!}
            </strong>
        @endif
    </div>
</a>
