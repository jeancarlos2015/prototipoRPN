@if(!empty($modelos))
    <tbody>
    @foreach($modelos as $modelo1)
        @if($modelo1->email()==Auth::user()->email || Auth::getuser()->EProprietario())
            <tr>

                <td>
                    <a href="{!! route($rota_exibicao,[$modelo1->codmodelodeclarativo]) !!}">
                        <div class="media">
                            @if(!empty($modelo1->usuario->email))
                                <img class="d-flex mr-3 rounded-circle"
                                     src="{{ Gravatar::src($modelo1->usuario->email) }}"
                                     alt="" width="100">
                            @else
                                <img class="d-flex mr-3 rounded-circle"
                                     src="{{ Gravatar::src('removido@gmail.com') }}"
                                     alt="" width="50">
                            @endif

                            <div class="media-body">
                                <strong>modelo - {!!  $modelo1->nome !!}</strong>
                                @if(!empty($modelo1->usuario->name))
                                    <div class="text-muted smaller">Responsável: {!! $modelo1->usuario->name !!}</div>
                                @else
                                    <div class="text-muted smaller">Nenhum: {!! $modelo1->usuario->name !!}</div>
                                @endif
                                <div class="text-muted smaller">Descrição do
                                    modelo: {!! $modelo1->descricao !!}</div>
                                @if(!empty($modelo1->repositorio->nome))
                                    <div class="text-muted smaller">
                                        Repositório: {!! $modelo1->repositorio->nome !!}</div>
                                @endif
                                <div class="text-muted smaller">
                                    Usuários : {!! count($modelo1->usuarios_modelos) !!}</div>
                                <div class="text-muted smaller">
                                    Tipo : {!! $modelo1->tipo !!}</div>
                                @if(!empty($modelo1->objetos_fluxos))
                                    <div class="text-muted smaller">
                                        Objetos De Fluxo : {!! count($modelo1->objetos_fluxos) !!}</div>
                                @endif
                            </div>
                        </div>
                    </a>

                </td>

                <td>
                    @if( Auth::getuser()->EAdministrador() || Auth::getuser()->EProprietario())
                        @if(!empty($rota_edicao))
                            @include('componentes.link',['id' => $modelo1->codmodelodeclarativo, 'rota' => $rota_edicao])
                        @endif
                        @if(!empty($rota_exclusao))
                            @include('componentes.form_delete',['id' => $modelo1->codmodelodeclarativo, 'rota' => $rota_exclusao])
                        @endif
                        @if(!empty($rota_exibicao))
                            @include('componentes.link',['id' => $modelo1->codmodelodeclarativo, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                        @endif
                    @elseif(Auth::getuser()->EColaborador())
                        @if(!empty($rota_edicao))
                            @include('componentes.link',['id' => $modelo1->codmodelodeclarativo, 'rota' => $rota_edicao])
                        @endif
                        @if(!empty($rota_exibicao))
                            @include('componentes.link',['id' => $modelo1->codmodelodeclarativo, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                        @endif
                    @elseif(Auth::getuser()->Ecliente())
                        @if(!empty($rota_exibicao))
                            @include('componentes.link',['id' => $modelo1->codmodelodeclarativo, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                        @endif
                    @endif


                </td>


            </tr>
        @else
            <tr>
                <td>
                    <div class="media" title="Solicite permissão ao proprietário se quiser interagir com o modelo">

                        <img class="d-flex mr-3 rounded-circle"
                             src="{!! asset('img/privado.png') !!} "
                             alt="" width="100">
                        <div class="media-body">
                            <strong>Modelo - {!!  $modelo1->nome !!}</strong>
                            <div class="text-muted smaller">Responsável: {!! $modelo1->usuario->name !!}</div>
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

