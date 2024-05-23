
    @if(!empty($rota_edicao))
        @include('componentes.link',['id' => $configuracao->codconfiguracaoambientemodelagem, 'rota' => $rota_edicao])
    @endif
    @if(!empty($rota_exclusao))
        @include('componentes.form_delete',['id' => $configuracao->codconfiguracaoambientemodelagem, 'rota' => $rota_exclusao])
    @endif

