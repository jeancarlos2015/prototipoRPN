@if(!empty($repositorios))
    <tbody>
    @foreach($repositorios as $repositorio1)
        @if(($repositorio1->publico || Auth::getuser()->EAdministrador()) && !empty($rota_exibicao))
            <tr id="codrepositorio{!! $repositorio1->codrepositorio !!}">
                <td>
                    <a href="{!! route($rota_exibicao,[$repositorio1->codrepositorio]) !!}">
                        <div class="media">
                            <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src('public/img/processo.png') }}"
                                 alt="" width="100">
                            <div class="media-body">
                                <strong>{!!  $repositorio1->nome !!}</strong>
                                <div class="text-muted smaller">Repositório: {!! $repositorio1->nome !!}</div>
                                <div class="text-muted smaller">Usuários: {!! count($repositorio1->usuarios)!!}</div>
                                <div class="text-muted smaller">Processos : {!! count($repositorio1->projetos) !!}</div>

                                <div class="text-muted smaller">Modelos: {!! count($repositorio1->modelos)!!}</div>

                                <div class="text-muted smaller">
                                    Tipo: @if($repositorio1->publico) Público @else Privado @endif </div>

                                @if(Auth::getuser()->EAdministrador())
                                    <div class="text-muted smaller">
                                        {!! $repositorio1->qt_usuarios_online() !!} Usuários online
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                </td>
                <td>
                    @if (Auth::getuser()->EAdministrador())

                        @if(!empty($rota_edicao))
                            @include('componentes.link',['id' => $repositorio1->codrepositorio, 'rota' => $rota_edicao])
                        @endif
                        @if(!empty($rota_exclusao))
{{--                            @include('componentes.form_delete',['id' => $repositorio1->codrepositorio, 'rota' => $rota_exclusao])--}}
                                <a style="cursor: pointer" onclick="excluir('{!! $repositorio1->codrepositorio !!}','codrepositorio')" >
                                    <img
                                        src="{!! asset('img/delete.png') !!} " style="width: 20px"
                                        title="deletar">
                                </a>
                        @endif

                        @if(!empty($rota_exibicao))
                            @include('componentes.link',['id' => $repositorio1->codrepositorio, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar','mensagem' => 'Deseja visualizar este repositório?'])
                        @endif

                    @endif


                </td>
                <td>
                    <ul style="list-style-type: none;">
                        <li>
                            @if(Auth::getuser()->EAdministrador())
                                @if(in_array($repositorio1->papel(),['PROPRIETARIO','COLABORADOR','CLIENTE']))
                                    @includeIf('componentes.form_desvincular',[
                                    'id' => $repositorio1->codrepositorio
                                    ])
                                @else
                                    @include('painel.componentes.form_atribuicao',['repositorio' => $repositorio1])
                                @endif

                            @endif
                        </li>

{{--                        <li>--}}
{{--                            <input type="image" src="{!! asset('img/mensagem.png') !!}" alt="Submit"--}}
{{--                                   width="20" data-toggle="modal"--}}
{{--                                   data-target="#GSCCModal{!! $repositorio1->codproprietario() !!}"--}}
{{--                                   title="Enviar Mensagem">--}}
{{--                            <a style="cursor: pointer;" onclick="exibirFormularioMensagen(--}}
{{--                                '{!! $repositorio1->codproprietario() !!}',--}}
{{--                                email,--}}
{{--                                nome,--}}
{{--                                permissao,--}}
{{--                                dtEntrada)">--}}
{{--                                <img src="{!! asset('img/mensagem.png') !!}" width="20">--}}

{{--                            </a>--}}
{{--                        </li>--}}

                    </ul>

                </td>

            </tr>
        @else
            <tr>
                <td>
                    <div class="media">
                        @if(!$repositorio1->publico)
                            <img class="d-flex mr-3 rounded-circle"
                                 src="{!! asset('img/privado.png') !!} "
                                 alt="" width="100" title="Privado">
                        @else
                            <img class="d-flex mr-3 rounded-circle"
                                 src="{!! asset('img/publico.png') !!} "
                                 alt="" width="100" title="Público">
                        @endif
                        <div class="media-body">
                            <strong>{!!  $repositorio1->nome !!}</strong>
                        </div>
                    </div>

                </td>

                <td>


                    @if($repositorio1->publico)
                        @include('painel.componentes.form_atribuicao',['repositorio' => $repositorio1])
                    @elseif(!empty($rota_solicitacao) && !$repositorio1->publico)
                        @include('painel.componentes.form_vinculacao',['repositorio' => $repositorio1])
                    @endif
                </td>
            </tr>
        @endif

    @endforeach
    </tbody>
@endif


