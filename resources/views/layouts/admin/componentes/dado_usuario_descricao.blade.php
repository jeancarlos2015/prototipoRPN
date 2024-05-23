<a href="{!! route($rota_edicao,[$usuario->codusuario]) !!}">
    <div class="media">

        <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($usuario->email) }}"
             alt=""
             width="100">
        <div class="media-body">
            <strong>{!!  $usuario->name !!}</strong>
            @if(!empty($usuario->tipo))
                <div class="text-muted smaller">Tipo: {!! $usuario->tipo !!}</div>
            @else
                <div class="text-muted smaller">Tipo: Padrão</div>
            @endif
            @if(!empty($usuario->repositorio))
                <div class="text-muted smaller">Repositório Atual: {!! $usuario->repositorio->nome !!}</div>
            @endif
            @if(!empty($usuario->papel()))
                <div class="text-muted smaller">Papel Atual: {!! $usuario->papel() !!}</div>
            @endif
            @if(!empty($usuario->usuarios_repositorios))
                <div class="text-muted smaller">
                    Repositórios Vinculados: {!! count($usuario->usuarios_repositorios) !!}</div>
            @else
                <div class="text-muted smaller">Repositório: Nenhuma</div>
            @endif

        </div>
    </div>
</a>
