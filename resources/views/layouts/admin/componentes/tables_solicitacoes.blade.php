@if(!empty($solicitacoes))
    <tbody>

    @foreach($solicitacoes as $solicitacao)
        @if(Auth::getuser()->EAdministrador())
            @if(!empty($solicitacao->solicitante) && !empty($solicitacao->solicitado))
                <tr>

                    <td>
                        @if(!empty($solicitacao->solicitante))
                            @includeIf('layouts.admin.componentes.dado_usuario_administrador_descricao',["usuario" => $solicitacao->solicitante])
                        @else
                            <strong>Não Especificado</strong>
                        @endif
                    </td>
                    {{--Ações--}}
                    <td>
                        @if(!empty($solicitacao->solicitado))
                            @includeIf('layouts.admin.componentes.dado_usuario_administrador_descricao',["usuario" => $solicitacao->solicitado])
                        @else
                            <strong>Não Especificado</strong>
                        @endif
                    </td>
                    <td>
                        @if(!empty($solicitacao->repositorio))
                            <strong> {!!  $solicitacao->repositorio->nome !!}</strong>
                        @else
                            <strong> Sem Nome</strong>
                        @endif
                    </td>

                    <td>
                        <ul style="list-style-type: none;">
                            <li>
                                <a data-toggle="modal"
                                   data-target="#modal-mensagem-vinculacao{!! $solicitacao->codsolicitacao !!}"
                                   title="Vincular {!! $solicitacao->solicitante->name !!}" style="cursor: pointer;">
                                    <div class="media">
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
                            <li>
                                <a onclick="return confirm('Deseja Cancelar Solicitação?');"
                                   href="{!!route('cancelar_solicitacao_usuario',[$solicitacao->codsolicitacao]) !!}"

                                   style="display: inline-block">

                                    <input type="image" src="{!! asset('img/delete.png') !!}"
                                           alt="Submit"
                                           width="20" title="Remover">
                                </a>

                            </li>
                        </ul>


                    </td>

                </tr>
            @endif

        @endif
    @endforeach
    </tbody>
@endif
