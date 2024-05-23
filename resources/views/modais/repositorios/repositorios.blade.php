@if(!empty(Auth::user()->usuarios_repositorios_cache()))
    <div class="modal fade" id="modal-listagem-repositorios">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <h2><i class="fa fa-database faa-pulse  fa-2x"></i>Repositórios</h2>
                </div>
                <div class="modal-body">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search faa-pulse "></i></span>
                        <input name="consulta" id="txt_consulta_repositorios" placeholder="Consultar" type="text"
                               class="form-control">
                    </div>
                    <table  class="table fonte-menor" style="width: 100%;">
                        <thead style="width: 100%">
                        <tr>
                            <th colspan="2">Repositório</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody style="width: 100%">
                        @if(Auth::getUser()->usuario_esta_no_repositorio())
                            @includeIf('modais.repositorios.componentes.selecionado')
                            @includeIf('modais.repositorios.componentes.restante')
                        @else
                            @includeIf('modais.repositorios.componentes.participacao_repositorios')
                        @endif
                        @includeIf('modais.repositorios.componentes.rotas')
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
