<!-- Example DataTables Card-->
<div class="card mb-3">
    <div class="card-header">
        @if(!empty($titulo))
            <i class="fa fa-table faa-pulse "></i> {!! $titulo !!}
        @endif
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    @includeIf('layouts.admin.componentes.tables_titulos')
                </tr>
                </thead>


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


                                            <a style="cursor: pointer" onclick="confirmMensagemPersonalizado('{!! route('controle_historico_diagramas_create',[$modelo->coddiagramaversionavel]) !!}','Deseja recuperar este modelo?')">
                                                <i class="fa fa-undo"></i>
                                            </a>



                                    </td>

                                @endif

                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                @endif

            </table>
        </div>
    </div>
    <div class="card-footer small text-muted"></div>
</div>
