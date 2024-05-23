<div class="modal fade" id="modal-listagem-acessosrecentes">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <h2><i class="fa fa-star faa-pulse  fa-2x"></i>Acessos Recentes</h2>
            </div>
            <div class="modal-body">
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search faa-pulse "></i></span>
                    <input name="consulta" id="txt_consulta_acessos_recentes" placeholder="Consultar" type="text"
                           class="form-control">
                </div>
                <table id="tabela" class="table table-responsive fonte-menor" style="width: 100%;">
                    <thead>
                    <tr>
                        <th style="width: 90%;">Descrição</th>
                        <th></th>
                        <th>Acesso</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(Auth::getUser()->ExistemAcessosRecentes())
                        @foreach(Auth::getUser()->AcessosRecentes() as $acessorecente)

                            @if($acessorecente->EUmaEdicaoDiagrama())

                                @includeIf('modais.AcessosRecentes.componentes.edicao_diagramas')
                            @endif

                            @if($acessorecente->EUmaVisualizacaoDiagrama())

                                @includeIf('modais.AcessosRecentes.componentes.visualizacao_diagrama')
                            @endif
                            @if($acessorecente->EUmaAlteracaoRepositorio())
                                @includeIf('modais.AcessosRecentes.componentes.alteracao_repositorios')
                            @endif

                            @if($acessorecente->EUmaVisualizacaoProcesso())

                                @includeIf('modais.AcessosRecentes.componentes.visualizacao_projetos')
                            @endif

                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>

