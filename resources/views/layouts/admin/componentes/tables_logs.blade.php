@if(!empty($logs))
    <tbody>

    @foreach($logs as $log)
        <tr>
            <td>
                <div class="media">
                    <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src('public/img/processo.png') }}"
                         alt="" width="100">
                    <div class="media-body">
                        <strong>Código {!!  $log->codlog !!}</strong>
                        <div class="text-muted smaller">Nome: {!! $log->nome !!}</div>
                        <div class="text-muted smaller">Descrição: {!! $log->descricao!!}</div>
                        @if(!empty($log->usuario))
                            <div class="text-muted smaller">Usuário: {!! $log->usuario->name !!}</div>
                        @endif
                        <div class="text-muted smaller">Data: {!! $log->created_at !!}</div>
                        <div class="text-muted smaller">Página: {!! $log->pagina !!}</div>
                        <div class="text-muted smaller">Método que disparou o erro: {!! $log->acao !!}</div>
                    </div>
                </div>
                {{--</a>--}}
            </td>
            <td>
                @if (Auth::getuser()->EAdministrador())
                    @if(!empty($rota_edicao))
                        @include('componentes.link',['id' => $log->codlog, 'rota' => $rota_edicao])
                    @endif
                    @if(!empty($rota_exclusao))
                        @include('componentes.form_delete',['id' => $log->codlog, 'rota' => $rota_exclusao])
                    @endif
                    @if(!empty($rota_exibicao))
                        @include('componentes.link',['id' => $log->codlog, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                    @endif
                @else
                    Não Permitido
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
@endif
