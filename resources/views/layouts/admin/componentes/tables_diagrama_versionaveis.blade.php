@if(!empty($modelos_versionaveis))
    <tbody>

    @foreach($modelos_versionaveis as $modelo)
        @if($modelo->modelo->permissao() || $modelo->modelo->publico)
            <tr>
                @if(!empty($modelo->usuario))

                    <td>
                        <a href="javascript:void(window.open('{!! route($rota_exibicao,[$modelo->coddiagramaversionavel]) !!}','','width=720,height=640'))">
                            <div class="media">

                                <div class="media-body">
                                    <strong> Versão {!!  $modelo->coddiagramaversionavel !!}</strong>
                                    <div class="text-muted smaller">
                                        Data de Alteração: {!! $modelo->updated_at->format('d/m/Y H:i:s') !!}</div>
                                </div>
                                <div style="zoom: 10%;">
                                    {!! $modelo->svg_modelo ? $modelo->svg_modelo : $modelo->svgPadrao() !!}
                                </div>
                            </div>
                        </a>

                    </td>


                    <td>
                        @if(in_array($modelo->modelo->papel(),['ADMINISTRADOR','PROPRIETARIO','COLABORADOR']) || Auth::getuser()->EstaLiberado())
                            @if(!empty($rota_exibicao))
                                @include('componentes.link',['id' => $modelo->coddiagramaversionavel, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                            @endif
                            @if(!empty($rota_atualizacao))
                                @include('componentes.link',['id' => $modelo->coddiagramaversionavel, 'rota' => $rota_atualizacao,'rota_atualizacao' => $rota_atualizacao])
                            @endif
                        @else
                            @if(!empty($rota_exibicao))
                                @include('componentes.link',['id' => $modelo->coddiagramaversionavel, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                            @endif
                        @endif

                    </td>

                @endif

            </tr>
        @endif
    @endforeach
    </tbody>
@endif
