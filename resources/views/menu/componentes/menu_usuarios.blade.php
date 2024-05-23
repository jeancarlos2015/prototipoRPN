@if(Auth::getUser()->usuario_esta_no_repositorio())
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2451"
           data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cogs faa-pulse "></i>
            <span class="nav-link-text">Proprietários</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents2451">
            @if(!empty($entradas))
                @foreach($entradas as $entrada)
                    @if($entrada->tipo=='PROPRIETARIO' && Auth::user()->codusuario != $entrada->codusuario)
                        <li>
                            <a href="#"  title=" @if(Auth::getuser()->TemPermissaoParaEscluir()){!! $entrada->usuario->email !!} - @endif {!! $entrada->tipo !!}"
                               onclick="MostrarModal('#GSCCModal{!! $entrada->codusuario !!}')" style="cursor: pointer;">
                                <div class="media">
                                    <img class="d-flex mr-3 rounded-circle"
                                         src="{{ Gravatar::src($entrada->usuario->email) }}"
                                         alt="" width="30">

                                    <div class="media-body">
                                        {!! $entrada->usuario->name !!}
                                    </div>
                                    @if($entrada->usuario->online())
                                        <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/on.png') !!} "
                                             style="width: 15px">
                                    @else
                                        <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/off.png') !!} "
                                             style="width: 15px">
                                    @endif
                                </div>
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2452"
           data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cogs faa-pulse "></i>
            <span class="nav-link-text">Colaboradores</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents2452">
            @if(!empty($entradas))
                @foreach($entradas as $entrada)
                    @if($entrada->tipo=='COLABORADOR')
                        <li>
                            <a href="#"  title=" @if(Auth::getuser()->TemPermissaoParaEscluir()){!! $entrada->usuario->email !!} - @endif {!! $entrada->tipo !!}"
                               data-toggle="modal"
                               data-target="#GSCCModal{!! $entrada->codusuario !!}">
                                <div class="media">
                                    <img class="d-flex mr-3 rounded-circle"
                                         src="{{ Gravatar::src($entrada->usuario->email) }}"
                                         alt="" width="30">

                                    <div class="media-body">
                                        {!! $entrada->usuario->name !!}
                                    </div>
                                    @if($entrada->usuario->online())
                                        <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/on.png') !!} "
                                             style="width: 15px">
                                    @else
                                        <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/off.png') !!} "
                                             style="width: 15px">
                                    @endif
                                </div>
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents24521"
           data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cogs faa-pulse "></i>
            <span class="nav-link-text">Clientes</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents24521">
            @if(!empty($entradas))
                @foreach($entradas as $entrada)
                    @if($entrada->tipo=='CLIENTE')
                        <li>
                            <a href="#"  title=" @if(Auth::getuser()->TemPermissaoParaEscluir()){!! $entrada->usuario->email !!} - @endif {!! $entrada->tipo !!}"
                               data-toggle="modal"
                               data-target="#GSCCModal{!! $entrada->codusuario !!}">
                                <div class="media">
                                    <img class="d-flex mr-3 rounded-circle"
                                         src="{{ Gravatar::src($entrada->usuario->email) }}"
                                         alt="" width="30">

                                    <div class="media-body">
                                        {!! $entrada->usuario->name !!}
                                    </div>
                                    @if($entrada->usuario->online())
                                        <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/on.png') !!} "
                                             style="width: 15px">
                                    @else
                                        <img class="d-flex mr-3 rounded-circle" src="{!! asset('img/off.png') !!} "
                                             style="width: 15px">
                                    @endif
                                </div>
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </li>
@endif
