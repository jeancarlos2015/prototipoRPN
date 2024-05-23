@if(!empty($entradas) && Auth::getUser()->usuario_esta_no_repositorio())
    <div class="modal fade" id="modal-mensagem1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><i class="fa fa-user faa-pulse  fa-2x"></i>Usuarios</h4>

                    @if(!empty($repositorio->nome) && $titulo ==='repositorio')
                        <h4 class="modal-title">Repositório {!! $repositorio->nome !!}</h4>
                    @elseif(!empty($projeto->nome) && $titulo ==='projeto')
                        <h4 class="modal-title">Projeto {!! $projeto->nome !!}</h4>
                    @elseif(!empty($modelo->nome) && $titulo ==='modelo')
                        <h4 class="modal-title">Usuários Do Projeto</h4>
                    @endif
                </div>
                <div class="modal-body">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search faa-pulse "></i></span>
                        <input name="consulta" id="txt_consulta_listagem_usuarios" placeholder="Consultar" type="text"
                               class="form-control">
                    </div>
                    <table id="tabela" style="width: 100%;" class="table table-responsive-lg fonte-menor">
                        <thead>
                        <tr>
                            <th>Informações</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entradas as $entrada)
                            @if(isset($entrada->usuario))
                                <tr id="usuarioRepositorio{!!$entrada->codusuariorepositorio!!}">

                                    <td>
                                        @if(Auth::getUser()->TemPermissaoParaEscluir())
                                            <ul style="list-style: none;">
                                                @if($entrada->usuario->online())
                                                    <table width="100%;" border="0" cellspacing="0">
                                                        <tbody>
                                                        <tr>
                                                            <td style="border: none" width="2%">
                                                                <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($entrada->usuario->email) }}" alt="" width="30">
                                                            </td>
                                                            <td style="border: none;text-align: left;">
                                                                {!! $entrada->usuario->name !!} - {!! $entrada->tipo !!}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                @else
                                                    <table width="100%;" border="0" cellspacing="0">
                                                        <tbody>
                                                        <tr>
                                                            <td style="border: none" width="2%">
                                                                <i class="fa fa-user faa-pulse  fa-2x" style="color: darkgrey;"></i>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td style="border: none;text-align: left;">
                                                                {!! $entrada->usuario->name !!} - {!! $entrada->tipo !!}
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td style="border: none;text-align: left;">
                                                                <li onclick="exibirFormularioMensagen(
                                                                    '{{$entrada->codusuario}}',
                                                                    '{{$entrada->usuario->email}}',
                                                                    '{{$entrada->usuario->name}}',
                                                                    '{{$entrada->usuario->papel()}}',
                                                                    '{{$entrada->usuario->created_at->format('d/m/Y')}}'
                                                                    )">
                                                                    <i class="fa fa-envelope faa-pulse "></i> {!! $entrada->usuario->email !!}</li>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                @endif



                                            </ul>
                                        @else
                                            <ul style="list-style: none;">

                                                @if($entrada->usuario->online())
                                                    <table width="100%;" border="0" cellspacing="0">
                                                        <tbody>
                                                        <tr>
                                                            <td style="border: none;" width="2%">
                                                                <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($entrada->usuario->email) }}" alt="" width="30">
                                                            </td>
                                                            <td style="border: none;text-align: left;">
                                                                {!! $entrada->usuario->name !!} - {!! $entrada->tipo !!}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <table width="100%;" border="0" cellspacing="0">
                                                        <tbody>
                                                        <tr>
                                                            <td style="border: none;" width="2%">
                                                                <i class="fa fa-user faa-pulse  fa-2x" style="color: darkgrey;"></i>
                                                            </td>
                                                            <td style="border: none;text-align: left;">
                                                                {!! $entrada->usuario->name !!} - {!! $entrada->tipo !!}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </ul>

                                        @endif
                                    </td>

                                    <td>
                                        <ul style="list-style-type: none;">
                                            <li>
                                                <a onclick="exibirFormularioMensagen(
                                                    '{{$entrada->codusuario}}',
                                                    '{{$entrada->usuario->email}}',
                                                    '{{$entrada->usuario->name}}',
                                                    '{{$entrada->usuario->papel()}}',
                                                    '{{$entrada->usuario->created_at->format('d/m/Y')}}'
                                                    )" style="cursor: pointer;">
                                                    <i class="fa fa-envelope-open faa-pulse  fa-2x"></i>
                                                </a>
                                            </li>
                                            <li>
                                                @if(Auth::getUser()->TemPermissaoParaEscluir())
                                                    <a onclick="desvincular_usuario_repositorio_vinculado('{!! $entrada->codusuariorepositorio !!}')"
                                                       style="display: inline-block">
                                                        <i class="fa fa-remove faa-pulse  fa-2x" style="color: black;cursor: pointer;"></i>
                                                    </a>
                                                @endif
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif(!empty($entradas) && Auth::getUser()->EAdministrador())
    <div class="modal fade" id="modal-mensagem1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    {{--<button type="button" class="close" data-dismiss="modal"><span>×</span></button>--}}
                    @if(!empty($repositorio->nome) && $titulo ==='repositorio')
                        <h4 class="modal-title">Repositório {!! $repositorio->nome !!}</h4>
                    @elseif(!empty($projeto->nome) && $titulo ==='projeto')
                        <h4 class="modal-title">Projeto {!! $projeto->nome !!}</h4>
                    @elseif(!empty($modelo->nome) && $titulo ==='modelo')
                        <h4 class="modal-title">Usuários Do Projeto</h4>
                    @endif
                </div>
                <div class="modal-body">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search faa-pulse "></i></span>
                        <input name="consulta" id="txt_consulta_listagem_usuarios" placeholder="Consultar" type="text"
                               class="form-control">
                    </div>
                    <table id="tabela" style="width: 100%;" class="table table-responsive-lg fonte-menor">
                        <thead>
                        <tr>
                            <th>Informações</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entradas as $entrada)
                            @if(isset($entrada->usuario))
                                <tr>

                                    <td>
                                        @if(Auth::getUser()->TemPermissaoParaEscluir())
                                            <ul style="list-style: none;">

                                                @if($entrada->usuario->online())
                                                    <li><i class="fa fa-user faa-pulse  fa-2x" style="color: green;"></i> {!! $entrada->usuario->name !!} - {!! $entrada->tipo !!}</li>
                                                @else
                                                    <li><i class="fa fa-user faa-pulse  fa-2x" style="color: darkred;"></i> {!! $entrada->usuario->name !!} - {!! $entrada->tipo !!}</li>
                                                @endif
                                                <li><i class="fa fa-envelope faa-pulse "></i> {!! $entrada->usuario->email !!}</li>
                                                <li>
                                                    <i class="fa fa-database faa-pulse "></i>Repositório: {!! !empty($entrada->repositorio) ? $entrada->repositorio->nome : (!empty($entrada->projeto) ? $entrada->projeto->repositorio->nome : '---') !!}
                                                </li>
                                            </ul>
                                        @else
                                            <ul style="list-style: none;">
                                                @if($entrada->usuario->online())
                                                    <li><i class="fa fa-user faa-pulse  fa-2x" style="color: green;"></i> {!! $entrada->usuario->name !!} - {!! $entrada->tipo !!}</li>
                                                @else
                                                    <li><i class="fa fa-user faa-pulse  fa-2x" style="color: darkred;"></i> {!! $entrada->usuario->name !!} - {!! $entrada->tipo !!}</li>
                                                @endif
                                            </ul>

                                        @endif
                                    </td>


                                    <td>
                                        <ul style="list-style-type: none;">
                                            <li>
                                                <a onclick="MostrarModal('#GSCCModal{!! $entrada->codusuario !!}')" style="cursor: pointer;">
                                                    <i class="fa fa-envelope-o faa-pulse  fa-2x"></i>
                                                </a>
                                            </li>
                                            <li>
                                                @if(Auth::getUser()->TemPermissaoParaEscluir())
                                                    <a onclick="desvincular_usuario_repositorio_vinculado('{!! $entrada->codusuariorepositorio !!}')"
                                                       style="display: inline-block;cursor: pointer;">
                                                        <i class="fa fa-remove faa-pulse  fa-2x" style="color: black;cursor: pointer;"></i>
                                                    </a>
                                                @endif
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif(Auth::getUser()->EAdministrador())
    <div class="modal fade" id="modal-mensagem1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    {{--<button type="button" class="close" data-dismiss="modal"><span>×</span></button>--}}

                    <h4 class="modal-title">Usuários</h4>

                </div>
                <div class="modal-body">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search faa-pulse "></i></span>
                        <input name="consulta" id="txt_consulta_listagem_usuarios" placeholder="Consultar" type="text"
                               class="form-control">
                    </div>
                    <table id="tabela" style="width: 100%;" class="table table-responsive-lg fonte-menor">
                        <thead>
                        <tr>

                            <th>Informações</th>
                            <th>Ações</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach(Auth::getUser()->UsuariosRepositorios() as $entrada)
                            @if(isset($entrada->usuario))
                                <tr>


                                    <td title="{!! $entrada->usuario->email !!}">
                                        <ul style="list-style: none;">
                                            @if($entrada->usuario->online())
                                                <li><i class="fa fa-user faa-pulse  fa-2x" style="color: green;"></i> {!! $entrada->usuario->name !!} -  {!! $entrada->tipo !!}</li>
                                            @else
                                                <li><i class="fa fa-user faa-pulse  fa-2x" style="color: darkred;"></i> {!! $entrada->usuario->name !!} - {!! $entrada->tipo !!}</li>
                                            @endif

                                            <li><i class="fa fa-envelope faa-pulse "></i> {!! $entrada->usuario->email  !!}</li>
                                            <li>
                                                <i class="fa fa-database faa-pulse "></i>Repositório: {!! $entrada->repositorio->nome !!}
                                            </li>
                                        </ul>

                                    </td>
                                    <td title="{!! $entrada->usuario->email !!}">


                                        <ul style="list-style-type: none;">
                                            <li>
                                                <a onclick="MostrarModal('#GSCCModal{!! $entrada->codusuario !!}')" style="cursor: pointer;">
                                                    <i class="fa fa-envelope-open-o faa-pulse  fa-2x"></i>
                                                </a>
                                            </li>
                                            <li>
                                                @if(Auth::getUser()->TemPermissaoParaEscluir())
                                                    <a onclick="desvincular_usuario_repositorio_vinculado('{!! $entrada->codusuariorepositorio !!}')"
                                                       style="display: inline-block; cursor: pointer;">
                                                        <i class="fa fa-remove faa-pulse  fa-2x" style="cursor: pointer;"></i>
                                                    </a>
                                                @endif
                                            </li>
                                        </ul>
                                    </td>


                                </tr>
                            @endif
                        @endforeach
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

