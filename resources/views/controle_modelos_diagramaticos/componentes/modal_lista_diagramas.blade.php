@if(Auth::getUser()->usuario_esta_no_repositorio())
    <div class="modal fade" id="modal-pesquisa-diagramas">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h4>

                        <table>
                            <tr>
                                <td><i class="fa fa-user fa-2x"></i></td>
                                <td>Diagramas</td>
                            </tr>
                        </table>
                    </h4>

                </div>
                <div class="modal-body">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                        <input name="consulta" id="txt_consulta_diagrama" placeholder="Diagrama..." type="text"
                               class="form-control">
                    </div>
                    <table id="tabela" style="width: 100%;" class="table table-responsive-lg fonte-menor">
                        <thead>
                        <tr>
                            <th width="30%">Diagrama</th>
                            <th width="50%">Informações</th>
                            <th width="20%">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(Auth::getUser()->repositorio->diagramas() as $diagrama)
                            @if(isset($diagrama->usuario))
                                <tr>
                                    <td width="30%">
                                        {!! $diagrama->nome !!}
                                    </td>
                                    <td width="50%">
                                        <ul style="list-style-type: none;display: inline-block">
                                            <li><img class="d-flex mr-3 rounded-circle"
                                                     src="{{ Gravatar::src($diagrama->usuario->email) }}" alt=""
                                                     width="50">
                                                <ul style="list-style-type: none;">
                                                    <li>
                                                        <ul style="list-style-type: none;">
                                                            <li>Autor:{!! $diagrama->usuario->name !!}</li>
                                                            <li>Modelo:{!! $diagrama->modelo->nome !!}</li>
                                                            <li>Processo:{!! isset($diagrama->projeto) ? $diagrama->projeto->nome : '---' !!}</li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>

                                        </ul>
                                    </td>


                                    <td width="20%">
                                        <a style="cursor: pointer;" onclick="confirmMensagemPersonalizado('{!! route('exibir_diagrama',$diagrama->codmodelodiagramatico) !!}','Deseja acessar este diagrama?')">
                                            <i class="fa fa-eye fa-2x" style="color: black"></i>
                                        </a>
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

