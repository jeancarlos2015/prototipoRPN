@if(Auth::getUser()->usuario_esta_no_repositorio())
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2445"
           data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cogs faa-pulse "></i>
            <span class="nav-link-text">Solicitações</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents2445">
            @if(!empty($solicitacoes) && count($solicitacoes)>0)
                @foreach($solicitacoes as $solicitacao)
                    @if(!empty($solicitacao->solicitante->name))
                        <li>
                            <a data-toggle="modal"
                               data-target="#modal-mensagem-vinculacao{!! $solicitacao->codsolicitacao !!}"
                               title="Remover {!! $solicitacao->solicitante->email !!}">
                                <div class="media" style="cursor: pointer;">
                                    <img class="d-flex mr-3 rounded-circle"
                                         src="{{ Gravatar::src($solicitacao->solicitante->email) }}"
                                         alt="" width="30">

                                    <div class="media-body">
                                        {!! $solicitacao->solicitante->name !!}
                                    </div>
                                    @if($solicitacao->solicitante->online())
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
