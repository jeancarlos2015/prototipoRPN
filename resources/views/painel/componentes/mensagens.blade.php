@if(!empty($mensagens))
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope faa-pulse "></i>
            <span class="d-lg-none">Mensagens
              <span class="badge badge-pill badge-primary"> {!! count($mensagens) !!}</span>
            </span>
            @if(count($mensagens)>0)
                <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle faa-pulse "></i>
            </span>
            @endif
        </a>

        @if(count($mensagens)>0)
            <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">Novas Mensagens:</h6>
                @foreach($mensagens as $mensagem)
                    @if(Auth::getUser()->PermissaoMensagem($mensagem) && !$mensagem->visto)
                        <div id="mensagem{!! $mensagem->codmensagem !!}">
                            <div class="dropdown-divider">{!! $mensagem->assunto !!}</div>
                            <a class="dropdown-item" onclick="arquivarMensagem(
                                '{{$mensagem->assunto}}',
                                '{{$mensagem->responsavel->codusuario}}',
                                '{!! $mensagem->codmensagem !!}',
                                '{!! $mensagem->texto !!}',
                                '{!! $mensagem->responsavel->email !!}',
                                '{!! $mensagem->responsavel->name !!}'
                                )"
                               style="cursor: pointer;">
                                <strong>Remetente: {!! $mensagem->responsavel->name !!}</strong>
                                <span class="small float-right text-muted">{!! $mensagem->texto !!}</span>
                                <span class="small float-right text-muted">Destinatário:  {!! !empty($mensagem->destinatario) ? $mensagem->destinatario->name : '---' !!}</span>
                                <span class="small float-right text-muted">Criado em: {!! $mensagem->created_at !!}</span>
                                <div class="dropdown-message small">
                                    {!! $mensagem->texto !!}
                                </div>
                            </a>
                        </div>

                    @endif
                @endforeach
            </div>
        @else
            <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">Sem Mensagens</h6>
            </div>
        @endif
    </li>
@endif
