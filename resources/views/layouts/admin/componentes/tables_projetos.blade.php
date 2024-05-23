@if(!empty($projetos))
    <tbody>

    @foreach($projetos as $projeto1)

        @if($projeto1->permissao() || $projeto1->UsuarioTemPermissao(Auth::getUser()))
            <tr id="codprojeto{!! $projeto1->codprojeto !!}">
                <td>
                    <a href="{!! route($rota_exibicao,[$projeto1->codprojeto]) !!}">
                        <div class="media">
                            @if(!empty($projeto1->usuario->email))
                                <img class="d-flex mr-3 rounded-circle"
                                     src="{{ Gravatar::src($projeto1->usuario->email) }}"
                                     alt="" width="100">
                            @else
                                <img class="d-flex mr-3 rounded-circle"
                                     src="{{ Gravatar::src('removido@gmail.com') }}"
                                     alt="" width="50">
                            @endif

                            <div class="media-body">
                                <strong>{!!  $projeto1->nome !!}</strong>
                                <div class="text-muted smaller">Responsável: {!! $projeto1->usuario->name !!}</div>
                                @if(!empty($projeto1->repositorio->nome))
                                    <div class="text-muted smaller">
                                        Repositório: {!! $projeto1->repositorio->nome !!}</div>
                                @endif
                                <div class="text-muted smaller">
                                    Modelos : {!! $projeto1->qt_modelos() !!}</div>

                                <div class="text-muted smaller">
                                    Usuários : {!! $projeto1->qt_usuarios() !!}</div>
                                {{--                                <div class="text-muted smaller">--}}
                                {{--                                    Tipo: @if($projeto1->publico) Público @else Privado @endif </div>--}}
                                <div class="text-muted smaller">
                                    Descrição : {!!  $projeto1->descricao !!}</div>
                            </div>
                        </div>

                    </a>

                </td>

                <td>
                    @if(in_array($projeto1->papel(),['ADMINISTRADOR','PROPRIETARIO']) || Auth::getuser()->TemPermissaoParaEscluir())
                        @if(!empty($rota_edicao))
                            @include('componentes.link',['id' => $projeto1->codprojeto, 'rota' => $rota_edicao])
                        @endif
                        @if(!empty($rota_exclusao))
{{--                            @include('componentes.form_delete',['id' => $projeto1->codprojeto, 'rota' => $rota_exclusao])--}}
                                <a style="cursor: pointer" onclick="excluir('{!! $projeto1->codprojeto !!}','codprojeto')" >
                                    <img
                                        src="{!! asset('img/delete.png') !!} " style="width: 20px"
                                        title="deletar">
                                </a>
                        @endif

                        @if(!empty($rota_exibicao))
                            @include('componentes.link',['id' => $projeto1->codprojeto, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar','mensagem' => 'Deseja visualizar este Processo?'])
                        @endif
                    @elseif($projeto1->papel()==='COLABORADOR')
                        @if(!empty($rota_edicao))
                            @include('componentes.link',['id' => $projeto1->codprojeto, 'rota' => $rota_edicao])
                        @endif
                        @if(!empty($rota_exibicao))
                            @include('componentes.link',['id' => $projeto1->codprojeto, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar','mensagem' => 'Deseja visualizar este Processo?'])
                        @endif


                    @elseif($projeto1->papel()==='CLIENTE')
                        @if(!empty($rota_exibicao))
                            @include('componentes.link',['id' => $projeto1->codprojeto, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar','mensagem' => 'Deseja visualizar este Processo?'])
                        @endif
                    @endif


                    @if(!empty($rota_relatorio))
                        @include('componentes.link',[
                        'id' => $projeto1->codprojeto,
                        'tipo_impressao' => 'relatorio'
                        ])
                    @endif


                </td>

            </tr>

        @else
            <tr>
                <td>
                    <div class="media">

                        <img class="d-flex mr-3 rounded-circle"
                             src="{!! asset('img/privado.png') !!} "
                             alt="" width="100">
                        <div class="media-body">
                            <strong>Processo - {!!  $projeto1->nome !!}</strong>
                            <div class="text-muted smaller">
                                Tipo: @if($projeto1->publico) Público @else Privado @endif </div>

                        </div>
                    </div>

                </td>
                <td>
                    Nenhum
                </td>
            </tr>
        @endif

    @endforeach
    </tbody>
@endif
