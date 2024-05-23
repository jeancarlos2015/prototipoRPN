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


                        <div class="form-group">
                            <a style="cursor: pointer" onclick="confirmMensagemPersonalizado('{!! route('controle_historico_diagramas_create',[$modelo->coddiagramaversionavel]) !!}','Deseja recuperar este modelo?')">
                                <img src="{!! asset('img/recover.png') !!} " style="width: 20px" title="Recuperar">
                            </a>
                        </div>


                    </td>

                @endif

            </tr>
        @endif
    @endforeach
    </tbody>
@endif
