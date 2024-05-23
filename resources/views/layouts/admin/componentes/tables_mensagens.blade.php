@if(!empty($mensagens))
    <tbody>
    @foreach($mensagens as $mensagem)
        @if(Auth::getUser()->PermissaoMensagem($mensagem))
            <tr>
                <td>
                    <a href="{!! route($rota_exibicao,[$mensagem->codmensagem]) !!}">
                        <div class="media">
                            @if($mensagem->visto)
                                @if(!empty($mensagem->reponsavel->email))
                                    <img class="d-flex mr-3 rounded-circle"
                                         src="{{ Gravatar::src($mensagem->responsavel->email) }}"
                                         alt="" width="100">
                                @else
                                    <img class="d-flex mr-3 rounded-circle"
                                         src="{{ Gravatar::src('removido@gmail.com') }}"
                                         alt="" width="50">
                                @endif

                                <div class="media-body">
                                    <p>{!!  $mensagem->assunto !!}</p>
                                    <div class="text-muted smaller">Texto: {!! $mensagem->texto !!}</div>
                                </div>

                                <div class="media-body">
                                    <div class="text-muted smaller">Responsável: {!! $mensagem->responsavel->name !!}</div>
                                    <div class="text-muted smaller">Data: {!! $mensagem->created_at !!}</div>
                                </div>
                            @else

                                @if(!empty($mensagem->reponsavel->email))
                                    <img class="d-flex mr-3 rounded-circle"
                                         src="{{ Gravatar::src($mensagem->responsavel->email) }}"
                                         alt="" width="100">
                                @else
                                    <img class="d-flex mr-3 rounded-circle"
                                         src="{{ Gravatar::src('removido@gmail.com') }}"
                                         alt="" width="50">
                                @endif

                                <div class="media-body">
                                    <strong>{!!  $mensagem->assunto !!}</strong>
                                    <div class="text-muted smaller">Texto: {!! $mensagem->texto !!}</div>
                                </div>

                                <div class="media-body">
                                    <div class="text-muted smaller">Responsavel: {!! $mensagem->responsavel->name !!}</div>
                                    <div class="text-muted smaller">
                                        Destinatário: {!! $mensagem->destinatario ? $mensagem->destinatario->name : '-' !!}</div>
                                    <div class="text-muted smaller">Data: {!! $mensagem->created_at !!}</div>
                                </div>
                                
                            @endif
                        </div>  
                    </a>

                </td>

                <td>

                    @if(!empty($rota_edicao))
                        @include('componentes.link',['id' => $mensagem->codmensagem, 'rota' => $rota_edicao])
                    @endif
                    @if(Auth::getuser()->EAdministrador())
                        @if(!empty($rota_exclusao))
                            @include('componentes.form_delete',['id' => $mensagem->codmensagem, 'rota' => $rota_exclusao])
                        @endif
                    @endif
                    @if(!empty($rota_exibicao))
                        @include('componentes.link',['id' => $mensagem->codmensagem, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                    @endif


                </td>
            </tr>
        @endif

    @endforeach
    </tbody>
@endif
