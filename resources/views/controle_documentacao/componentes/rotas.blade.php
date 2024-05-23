@if( Auth::getUser()->EAdministrador() || Auth::getUser()->EProprietario())
    @if(!empty($rota_edicao))
        @include('componentes.link',['id' => $documentacao->coddocumentacao, 'rota' => $rota_edicao])
    @endif
    @if(!empty($rota_exclusao))
        @include('componentes.form_delete',['id' => $documentacao->coddocumentacao, 'rota' => $rota_exclusao])
    @endif
    <div class="form-group">
        <a href="{!! $documentacao->link !!}"><img src="{!! asset('img/olho.png') !!} "
                                                   style="width: 20px"
                                                   title="Visualizar"></a>
    </div>
@else
    <div class="form-group">
        <a href="{!! $documentacao->link !!}"><img src="{!! asset('img/olho.png') !!} "
                                                   style="width: 20px"
                                                   title="Visualizar"></a>
    </div>
@endif
