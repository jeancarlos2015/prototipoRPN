@foreach(Auth::user()->usuarios_repositorios as $usuario_repositorio)
        <tr>


            <td colspan="2">
                <div class="media" style="cursor: pointer;">
                    <img class="d-flex mr-3 rounded-circle"
                         src="{{ Gravatar::src($usuario_repositorio->usuario->email) }}"
                         alt="" width="30">

                    <div class="media-body">

                        <i class="fa fa-database faa-pulse "></i>     {!! $usuario_repositorio->repositorio->nome !!}<br>
                        <i class="fa fa fa-user-circle-o"></i>{!! $usuario_repositorio->tipo !!}


                    </div>
                </div>
            </td>

            <td style="width: 40%">

                <a onclick="trocarRepositorio('{!! $usuario_repositorio->codrepositorio !!}')"
                   style="cursor: pointer;">
                    <img id="imagemRepositorioModelagem{!! $usuario_repositorio->codrepositorio !!}" class="d-flex mr-3 rounded-circle"
                         src="{!! asset('img/door-ico.ico') !!} "
                         alt="" width="50" title="Entrar">
                </a>
            </td>

        </tr>
@endforeach
