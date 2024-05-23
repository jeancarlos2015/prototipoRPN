@if(!empty($solicitacoes) && count($solicitacoes)>0)
    <div class="modal fade" id="modal-mensagem-solicitacao">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <h2><i class="fa fa-user-plus fa-2x"></i>Solicitações</h2>
                </div>
                <div class="modal-body">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                        <input name="consulta" id="txt_consulta_solicitacoes" placeholder="Consultar" type="text"
                               class="form-control">
                    </div>
                    <table id="tabela" class="table table-responsive fonte-menor" style="width: 100%;">
                        <thead>
                        <tr>
                            @if(in_array(Auth::getUser()->papel(),['ADMINISTRADOR','PROPRIETARIO']))
                                <th style="width: 25%;">Nome</th>
                                <th style="width: 25%;">Repositório</th>
                                <th style="width: 25%;">Ações</th>
                                <th style="width: 25%;"></th>
                            @else
                                <th style="width: 33%;">Nome</th>
                                <th style="width: 33%;">Repositório</th>
                                <th style="width: 34%;"></th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>
                        @if(Auth::user()->EAdministrador())
                            @foreach($solicitacoes as $solicitacao)
                                @if(!empty($solicitacao->solicitante->name))
                                    <tr id="codsolicitacao{{$solicitacao->codsolicitacao}}">

                                        @if(in_array(Auth::getUser()->papel(),['ADMINISTRADOR','COLABORADOR','PROPRIETARIO']))
                                            <td style="width: 25%;" title="{!! $solicitacao->solicitante->email !!}">

                                                <div class="media" style="cursor: pointer;">
                                                    <img class="d-flex mr-3 rounded-circle"
                                                         src="{{ Gravatar::src($solicitacao->solicitante->email) }}"
                                                         alt="" width="30">

                                                    <div class="media-body">
                                                        {!! $solicitacao->solicitante->name !!}
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 25%;">{!! $solicitacao->repositorio->nome !!}</td>
                                            <td style="width: 25%;" title="{!! $solicitacao->solicitante->email !!}">
                                                <ul style="list-style: none;">
                                                    <li>
                                                        <div class="form-group">
                                                            <a
                                                                onclick="vincularUsuarioRepositorio(
                                                                    '{!! $solicitacao->codrepositorio !!}',
                                                                    'vincular_usuario_repositorio',
                                                                    '{!! $solicitacao->solicitante->email !!}',
                                                                    '{!! $solicitacao->codusuario_solicitante !!}',
                                                                    '{!! $solicitacao->mensagem !!}',
                                                                    '{!! $solicitacao->solicitante->name !!}',
                                                                    '{!! $solicitacao->codsolicitacao !!}'
                                                                    )"
                                                               title="Aceitar Solicitação de {!! $solicitacao->solicitante->email !!}">
                                                                <div class="media" style="cursor: pointer;">
                                                                    <img class="d-flex mr-3 rounded-circle"
                                                                         src="{!! asset('img/user-ico.png') !!} "
                                                                         style="width: 15px">
                                                                </div>
                                                            </a>

                                                        </div>
                                                    </li>
                                                    @if(!empty($solicitacao->mensagem))
                                                        <li>
                                                            <div class="form-group">
                                                                <a onclick="MessageShow('Mensagem','{!! $solicitacao->mensagem !!}','{{ Gravatar::src($solicitacao->solicitante->email) }}')"
                                                                   title="Mensagem de {!! $solicitacao->solicitante->email !!}">
                                                                    <div class="media" style="cursor: pointer;">
                                                                        <i class="fa fa-envelope-open"></i>
                                                                    </div>
                                                                </a>

                                                            </div>
                                                        </li>
                                                    @endif

                                                </ul>

                                            </td>
                                            <td style="width: 25%;">
                                                <div class="media" style="cursor: pointer;" align="right">

                                                    @if($solicitacao->solicitante->online())
                                                        <img class="d-flex mr-3 rounded-circle"
                                                             src="{!! asset('img/on.png') !!} "
                                                             style="width: 15px">
                                                    @else
                                                        <img class="d-flex mr-3 rounded-circle"
                                                             src="{!! asset('img/off.png') !!} "
                                                             style="width: 15px">
                                                    @endif
                                                </div>
                                            </td>
                                        @else
                                            <td style="width: 33%;" title="{!! $solicitacao->solicitante->email !!}">

                                                <div class="media" style="cursor: pointer;">
                                                    <img class="d-flex mr-3 rounded-circle"
                                                         src="{{ Gravatar::src($solicitacao->solicitante->email) }}"
                                                         alt="" width="30">

                                                    <div class="media-body">
                                                        {!! $solicitacao->solicitante->name !!}
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 33%;">{!! $solicitacao->repositorio->nome !!}</td>
                                            <td style="width: 34%;">
                                                <div class="media" style="cursor: pointer;" align="right">

                                                    @if($solicitacao->solicitante->online())
                                                        <img class="d-flex mr-3 rounded-circle"
                                                             src="{!! asset('img/on.png') !!} "
                                                             style="width: 15px">
                                                    @else
                                                        <img class="d-flex mr-3 rounded-circle"
                                                             src="{!! asset('img/off.png') !!} "
                                                             style="width: 15px">
                                                    @endif
                                                </div>
                                            </td>
                                        @endif

                                    </tr>




                                @endif
                            @endforeach
                        @else
                            @foreach($solicitacoes as $solicitacao)
                                @if(Auth::getUser()->codusuario == $solicitacao->codusuario_solicitado)
                                    @if(!empty($solicitacao->solicitante->name))
                                        <tr>

                                            @if(in_array(Auth::getUser()->papel(),['ADMINISTRADOR','COLABORADOR','PROPRIETARIO']))
                                                <td style="width: 25%;"
                                                    title="{!! $solicitacao->solicitante->email !!}">

                                                    <div class="media" style="cursor: pointer;">
                                                        <img class="d-flex mr-3 rounded-circle"
                                                             src="{{ Gravatar::src($solicitacao->solicitante->email) }}"
                                                             alt="" width="30">

                                                        <div class="media-body">
                                                            {!! $solicitacao->solicitante->name !!}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width: 25%;">{!! $solicitacao->repositorio->nome !!}</td>
                                                <td style="width: 25%;"
                                                    title="{!! $solicitacao->solicitante->email !!}">
                                                    <ul style="list-style: none;">
                                                        <li>
                                                            <div class="form-group">
                                                                <a data-toggle="modal"
                                                                   data-target="#modal-mensagem-vinculacao{!! $solicitacao->codsolicitacao !!}"
                                                                   title="Aceitar Solicitação de {!! $solicitacao->solicitante->email !!}">
                                                                    <div class="media" style="cursor: pointer;">
                                                                        <img class="d-flex mr-3 rounded-circle"
                                                                             src="{!! asset('img/user-ico.png') !!} "
                                                                             style="width: 15px">
                                                                    </div>
                                                                </a>

                                                            </div>
                                                        </li>
                                                        @if(!empty($solicitacao->mensagem))
                                                            <li>
                                                                <div class="form-group">
                                                                    <a onclick="MessageShow('Mensagem','{!! $solicitacao->mensagem !!}','{{ Gravatar::src($solicitacao->solicitante->email) }}')"
                                                                       title="Mensagem de {!! $solicitacao->solicitante->email !!}">
                                                                        <div class="media" style="cursor: pointer;">
                                                                            <i class="fa fa-envelope-open-o"></i>
                                                                        </div>
                                                                    </a>

                                                                </div>
                                                            </li>
                                                        @endif

                                                    </ul>

                                                </td>
                                                <td style="width: 25%;">
                                                    <div class="media" style="cursor: pointer;" align="right">

                                                        @if($solicitacao->solicitante->online())
                                                            <img class="d-flex mr-3 rounded-circle"
                                                                 src="{!! asset('img/on.png') !!} "
                                                                 style="width: 15px">
                                                        @else
                                                            <img class="d-flex mr-3 rounded-circle"
                                                                 src="{!! asset('img/off.png') !!} "
                                                                 style="width: 15px">
                                                        @endif
                                                    </div>
                                                </td>
                                            @else
                                                <td style="width: 33%;"
                                                    title="{!! $solicitacao->solicitante->email !!}">

                                                    <div class="media" style="cursor: pointer;">
                                                        <img class="d-flex mr-3 rounded-circle"
                                                             src="{{ Gravatar::src($solicitacao->solicitante->email) }}"
                                                             alt="" width="30">

                                                        <div class="media-body">
                                                            {!! $solicitacao->solicitante->name !!}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width: 33%;">{!! $solicitacao->repositorio->nome !!}</td>
                                                <td style="width: 34%;">
                                                    <div class="media" style="cursor: pointer;" align="right">

                                                        @if($solicitacao->solicitante->online())
                                                            <img class="d-flex mr-3 rounded-circle"
                                                                 src="{!! asset('img/on.png') !!} "
                                                                 style="width: 15px">
                                                        @else
                                                            <img class="d-flex mr-3 rounded-circle"
                                                                 src="{!! asset('img/off.png') !!} "
                                                                 style="width: 15px">
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif

                                        </tr>




                                    @endif
                                @endif
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
