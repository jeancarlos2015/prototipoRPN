@if(Auth::getuser()->EAdministrador())
    @if(!empty($rota_edicao))
        @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_edicao])
    @endif

    @if(!empty($rota_exclusao))
        @include('componentes.form_delete',['id' => $usuario->codusuario, 'rota' => $rota_exclusao])
    @endif

    @if(!empty($rota_exibicao))
        @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
    @endif

@elseif(Auth::getuser()->EProprietario())

    @if(!empty($rota_edicao))
        @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_edicao])
    @endif
    @if(!empty($rota_exclusao))
        @include('componentes.form_delete',['id' => $usuario->codusuario, 'rota' => $rota_exclusao])
    @endif

    @if(!empty($rota_exibicao))
        @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
    @endif



@endif