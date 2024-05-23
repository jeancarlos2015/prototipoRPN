
    <div class="modal fade" id="modal-atribuicao-usuarios">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <h2><i class="fa fa-user-plus faa-pulse  fa-2x"></i>Usuarios</h2>
                </div>
                <div class="modal-body">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search faa-pulse "></i></span>
                        <input name="consulta" id="txt_consulta" placeholder="Consultar" type="text"
                               class="form-control">
                    </div>
                    <table id="tabela" class="table table-responsive fonte-menor" style="width: 100%;">
                        <thead>
                        <tr>
                            @if(Auth::getUser()->EProprietario())
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
                        @if(Auth::getUser()->usuario_esta_no_repositorio())

                                @foreach(Auth::getUser()->usuarios() as $usuario)
                                    {{-- @if (!isset($usuario->codrepositorio)) --}}
                                        <tr id="usuario{{$usuario->codusuario}}">

                                            @if(Auth::getUser()->EColaborador())
                                                <td style="width: 25%;" title="{!! $usuario->email !!}">

                                                    <div class="media" style="cursor: pointer;">
                                                        <img class="d-flex mr-3 rounded-circle"
                                                             src="{{ Gravatar::src($usuario->email) }}"
                                                             alt="" width="30">

                                                        <div class="media-body">
                                                            {!! $usuario->name !!}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width: 2%;">{!! $usuario->repositorio ? $usuario->repositorio->nome : '-' !!}</td>
                                                <td style="width: 25%;" title="{!! $usuario->email !!}">
                                                    <ul style="list-style: none;">
                                                        <li>
                                                            <div class="form-group">
                                                                <a @if (!empty($rota) && !empty($codigo))
                                                                   onclick="atribuirUsuario(
                                                                    '{!! $rota !!}',
                                                                    '{!! $usuario->codusuario !!}',
                                                                    '{!! $usuario->email !!}',
                                                                    '{!! $usuario->name !!}',
                                                                    '{!! $codigo !!}',
                                                                    '#usuario{{$usuario->codusuario}}'
                                                                    )"
                                                                @endif

                                                                    title="Atribuir o {!! $usuario->email !!}">
                                                                    <div class="media" style="cursor: pointer;">
                                                                        <img class="d-flex mr-3 rounded-circle"
                                                                             src="{!! asset('img/user-ico.png') !!} "
                                                                             style="width: 15px">
                                                                    </div>
                                                                </a>

                                                            </div>
                                                        </li>


                                                    </ul>

                                                </td>
                                                <td style="width: 25%;">
                                                    <div class="media" style="cursor: pointer;" align="right">

                                                        @if($usuario->online())
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
                                                <td style="width: 33%;" title="{!! $usuario->email !!}">

                                                    <div class="media" style="cursor: pointer;">
                                                        <img class="d-flex mr-3 rounded-circle"
                                                             src="{{ Gravatar::src($usuario->email) }}"
                                                             alt="" width="30">

                                                        <div class="media-body">
                                                            {!! $usuario->name !!}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width: 33%;">&nbsp;</td>
                                                <td style="width: 34%;">
                                                    <div class="media" style="cursor: pointer;" align="right">

                                                        @if($usuario->online())
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
                                        </tr>
                                        @endif
                                    {{-- @endif --}}



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
