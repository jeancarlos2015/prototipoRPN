@if(!empty($modelo1->usuario) && Auth::user()->email===$modelo1->usuario->email || Auth::getuser()->EAdministrador())
    @if(!empty($rota_edicao))
        @include('componentes.link',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_edicao])
    @endif
    @if(!empty($rota_exclusao))
        @include('componentes.form_delete',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_exclusao])
    @endif
    @if(!empty($rota_exibicao))
        @include('componentes.link',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
    @endif
@else
    @if(!empty($rota_exibicao))
        @include('componentes.link',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
    @endif
@endif