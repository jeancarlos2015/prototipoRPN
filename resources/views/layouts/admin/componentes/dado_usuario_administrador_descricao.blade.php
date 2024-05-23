@if(!empty($rota_edicao) && $usuario->permissao())

    <a href="{!! route($rota_edicao,[$usuario->codusuario]) !!}">
        <div class="media">

            <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($usuario->email) }}"
                 alt=""
                 width="100">

            <div class="media-body">

                <strong>{!!  $usuario->name !!}</strong>
                @if(!empty($usuario->usuarios_repositorios))
                    <div class="text-muted smaller">
                        Repositórios Vinculados: {!! count($usuario->usuarios_repositorios) !!}</div>
                @else
                    <div class="text-muted smaller">Repositório: Nenhuma</div>

                @endif
                <div class="text-muted smaller"> Email: {!!  $usuario->email !!}</div>
                @if($usuario->online())
                    <div class="text-muted smaller"><i class="fa fa-circle fa-2x" style="color: green;"></i></div>
                @endif
            </div>
        </div>
    </a>
@else
    <div class="media">

        <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($usuario->email) }}"
             alt=""
             width="100">

        <div class="media-body">

            <strong>{!!  $usuario->name !!}</strong>
            @if(!empty($usuario->usuarios_repositorios))
                <div class="text-muted smaller">
                    Repositórios Vinculados: {!! count($usuario->usuarios_repositorios) !!}</div>
            @else
                <div class="text-muted smaller">Repositório: Nenhuma</div>

            @endif
            <div class="text-muted smaller"> Email: {!!  $usuario->email !!}</div>
            @if($usuario->online())
                <div class="text-muted smaller"><i class="fa fa-circle fa-2x" style="color: green;"></i></div>
            @endif
        </div>
    </div>
@endif
