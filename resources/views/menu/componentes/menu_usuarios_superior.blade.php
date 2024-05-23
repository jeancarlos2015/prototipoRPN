<div class="dropdown">
    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        Validadores
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @if(!empty($diagrama))
            @foreach($diagrama->validadores() as $usuario)
                <a class="dropdown-item text-left"
                   onclick="exibirFormularioMensagenValidador(
                           '{{$usuario->papel()}}',
                           '{{$usuario->created_at->format('d/m/Y')}}',
                            '{{$usuario}}',
                            '{!! $diagrama->codmodelo !!}'
                           )"
                   href="#">
                    <div class="media">
                        @if($usuario->online())
                            <div class="media-body">
                                <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/on.png') !!} "
                                     style="width: 10px">
                            </div>
                        @else
                            <div class="media-body">
                                <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/off.png') !!} "
                                     style="width: 10px">
                            </div>
                        @endif
                    </div>
                    <div class="media">
                        <img class="d-flex mr-3 rounded-circle"
                             src="{{ Gravatar::src($usuario->email) }}"
                             alt="" width="30">

                        <div class="media-body">
                            {!! $usuario->name !!}
                        </div>


                    </div>
                </a>
            @endforeach
        @endif

    </div>
</div>

<div class="dropdown">
    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        Participantes
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @if(!empty($diagrama))
            @foreach($diagrama->participantes() as $usuario)
                <a class="dropdown-item text-left"
                   onclick="exibirFormularioMensagen(
                       '{{$usuario->codusuario}}',
                       '{{$usuario->email}}',
                       '{{$usuario->name}}',
                       '{{$usuario->papel()}}',
                       '{{$usuario->created_at->format('d/m/Y')}}'
                       )"
                   href="#">
                    <div class="media">
                        @if($usuario->online())
                            <div class="media-body">
                                <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/on.png') !!} "
                                     style="width: 10px">
                            </div>
                        @else
                            <div class="media-body">
                                <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/off.png') !!} "
                                     style="width: 10px">
                            </div>
                        @endif
                    </div>
                    <div class="media">
                        <img class="d-flex mr-3 rounded-circle"
                             src="{{ Gravatar::src($usuario->email) }}"
                             alt="" width="30">

                        <div class="media-body">
                            {!! $usuario->name !!}
                        </div>


                    </div>
                </a>
            @endforeach
        @endif

    </div>
</div>
