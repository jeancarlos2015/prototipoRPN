
<a href="{!! route($rota_exibicao,[$modelo1->codmodelodiagramatico]) !!}">
    <div class="media">
        @if(!empty($modelo1->usuario->email))
            <img class="d-flex mr-3 rounded-circle"
                 src="{{ Gravatar::src($modelo1->usuario->email) }}"
                 alt="" width="100">
        @else
            <img class="d-flex mr-3 rounded-circle"
                 src="{{ Gravatar::src('removido@gmail.com') }}"
                 alt="" width="100">
        @endif
        <div class="media-body">
            <strong>Modelo - {!!  $modelo1->nome !!}</strong>
            @if(!empty($modelo1->usuario))
                <div class="text-muted smaller">Responsável: {!! $modelo1->usuario->name !!}</div>
            @endif
            <div class="text-muted smaller">Descrição do Modelo: {!! $modelo1->descricao !!}</div>
            @if(!empty($modelo1->tipo))
                <div class="text-muted smaller">Tipo: {!! $modelo1->tipo !!}</div>
            @endif
            @if(!empty($modelo1->projeto->nome))
                <div class="text-muted smaller">Projeto: {!! $modelo1->projeto->nome !!}</div>
            @endif
            @if(!empty($modelo1->repositorio->nome))
                <div class="text-muted smaller">
                    Repositório: {!! $modelo1->repositorio->nome !!}</div>
            @endif
            <div class="text-muted smaller">
                Usuarios: {!! count($modelo1->usuarios_modelos) !!}</div>
            <div class="text-muted smaller">
                Data de Alteração: {!! $modelo1->updated_at !!}</div>
        </div>
    </div>
</a>