@if(!empty($entradas))
    <div class="dropdown">
        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            Proprietários
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach($entradas as $entrada)
                @if($entrada->tipo=='PROPRIETARIO' && Auth::user()->codusuario != $entrada->codusuario)


                    <a class="dropdown-item" href="#"
                       title=" @if(Auth::getuser()->TemPermissaoParaEscluir()){!! $entrada->usuario->email !!} - @endif {!! $entrada->tipo !!}"
                       onclick="exibirFormularioMensagen(
                           '{{$entrada->codusuario}}',
                           '{{$entrada->usuario->email}}',
                           '{{$entrada->usuario->name}}',
                           '{{$entrada->usuario->papel()}}',
                           '{{$entrada->usuario->created_at->format('d/m/Y')}}'
                           )">
                        <div class="media">
                            <img class="d-flex mr-3 rounded-circle"
                                 src="{{ Gravatar::src($entrada->usuario->email) }}"
                                 alt="" width="30">

                            <div class="media-body">
                                {!! $entrada->usuario->name !!}
                            </div>
                            <div class="media-right">
                                @if($entrada->usuario->online())
                                    <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/on.png') !!} "
                                         style="width: 15px; margin-left: 10px;">
                                @else
                                    <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/off.png') !!} "
                                         style="width: 15px; margin-left: 10px;">
                                @endif
                            </div>

                        </div>
                    </a>
                @endif
            @endforeach


        </div>
    </div>

@endif
