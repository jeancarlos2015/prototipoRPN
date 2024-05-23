@if (!empty($diagrama))
    <div class="modal fade" id="modal-listagem-versionamento{!! $diagrama->codmodelodiagramatico !!}">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <h2><i class="fa fa-star faa-pulse  fa-2x"></i>Versões do Diagrama</h2>
                </div>
                <div class="modal-body">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search faa-pulse "></i></span>
                        <input name="consulta" id="txt_consulta_acessos_recentes" placeholder="Consultar" type="text"
                               class="form-control">
                    </div>
                    @includeIf('modais.versionamento.table',[
                       'titulos' => ['Diagrama','Ações'],
                       'modelos_versionaveis' => $diagrama->historico_alteracoes,
                       'rota_atualizacao' => 'controle_historico_diagramas_create',
                       'rota_exibicao' => 'exibir_historicos_diagrama',
                       'nome_botao' => 'Novo',
                       'titulo' =>'Versões',
                       'tipo' => 'diagrama_versionavel'
                        ])
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endif
