@if(!empty($representacao))
    @if($representacao === 'declarativa')
        @if(!empty($modelo1->usuario) && Auth::user()->email===$modelo1->usuario->email || Auth::getuser()->EAdministrador())
            @if(!empty($rota_edicao))
                @include('componentes.link',['id' => $modelo1->codmodelodeclarativo, 'rota' => 'controle_modelos_declarativos.edit'])
            @endif
            @if(!empty($rota_exclusao))
                @include('componentes.form_delete',['id' => $modelo1->codmodelodeclarativo, 'rota' => 'controle_modelos_declarativos.destroy'])
            @endif
            @if(!empty($rota_exibicao))
                @include('componentes.link',['id' => $modelo1->codmodelodeclarativo, 'rota' => 'controle_modelos_declarativos.show','nomebotao' => 'Visualizar'])
            @endif
        @else
            @if(!empty($rota_exibicao))
                @include('componentes.link',['id' => $modelo1->codmodelodeclarativo, 'rota' => 'controle_modelos_declarativos.show','nomebotao' => 'Visualizar'])
            @endif
        @endif
    @else
        @if(!empty($modelo1->usuario) && Auth::user()->email===$modelo1->usuario->email || Auth::getuser()->EAdministrador())
            @if(!empty($rota_edicao))
                @include('componentes.link',['id' => $modelo1->codmodelo, 'rota' => 'controle_modelos.edit'])
            @endif
            @if(!empty($rota_exclusao))
                @include('componentes.form_delete',['id' => $modelo1->codmodelo, 'rota' => 'controle_modelos.destroy'])
            @endif
            @if(!empty($rota_exibicao))
                @include('componentes.link',['id' => $modelo1->codmodelo, 'rota' => 'controle_modelos.show','nomebotao' => 'Visualizar'])
            @endif
        @else
            @if(!empty($rota_exibicao))
                @include('componentes.link',['id' => $modelo1->codmodelo, 'rota' => 'controle_modelos.show','nomebotao' => 'Visualizar'])
            @endif
        @endif
    @endif
@endif
