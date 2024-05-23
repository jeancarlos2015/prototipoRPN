@foreach(Auth::user()->usuarios_repositorios as $usuario_repositorio)
    @if(Auth::user()->usuario_esta_no_repositorio() && Auth::user()->repositorio->codrepositorio != $usuario_repositorio->codrepositorio)
        <tr>


            <td colspan="2">
                <div class="media" style="cursor: pointer;">
                    <img class="d-flex mr-3 rounded-circle"
                         src="{{ Gravatar::src($usuario_repositorio->usuario->email) }}"
                         alt="" width="30">

                    <div class="media-body">

                        <i class="fa fa-database faa-pulse "></i>     {!! $usuario_repositorio->repositorio->nome !!}<br>
                        <i class="fa fa-user-circle-o"></i>  {!! $usuario_repositorio->tipo !!}

                    </div>
                </div>
            </td>

            <td style="width: 40%">
                @if(Auth::user()->usuario_esta_no_repositorio() && Auth::user()->repositorio->codrepositorio == $usuario_repositorio->codrepositorio)
                    <strong>
                        <a href="{!! route('delete_vinculo_repositorio')!!}"
                           style="cursor: pointer;">
                            <img class="d-flex mr-3 rounded-circle"
                                 src="{!! asset('img/ok.png') !!} "
                                 alt="" width="50" title="Sair">
                        </a>
                    </strong>
                @else
                    <a onclick="trocarRepositorio('{!! $usuario_repositorio->codrepositorio !!}')"
                       style="cursor: pointer;">
                        <img id="imagemRepositorioModelagem{!! $usuario_repositorio->codrepositorio !!}" class="d-flex mr-3 rounded-circle"
                             src="{!! asset('img/door-ico.ico') !!} "
                             alt="" width="50" title="Entrar">
                    </a>
                @endif

            </td>
        </tr>
    @endif
@endforeach
