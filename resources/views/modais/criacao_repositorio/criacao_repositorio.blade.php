<div id="GSCCModalRepositorioCriacao" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-send fa-2x"></i> Novo Repositório</h4>
            </div>

            <div class="modal-body">
                <label>nome</label>
                <input type="text" class="form-control" id="nomeRepositorioCriacao" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark form-control" data-dismiss="modal">Fechar</button>
                <input type="button" onclick="criarRepositorio()" class="btn btn-dark form-control"
                       value="Criar Repositorio"/>
            </div>

        </div>
    </div>
</div>

<div id="GSCCModalProjetoCriacao" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-send fa-2x"></i> Novo Processo</h4>
            </div>

            <div class="modal-body">
                <label>Nome</label>
                <input type="text" class="form-control" id="nomeProjetoCriacao" required>
            </div>
            <div class="form-group">
                <div class="custom-control custom-switch" style="margin-left: 10%">
                    <input type="checkbox" value="false" class="custom-control-input" id="publicoProjetoCriacao">
                    <label class="custom-control-label" for="publicoProjetoCriacao">Público</label>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-dark form-control" data-dismiss="modal">Fechar</button>
                <input type="button" onclick="criarProjeto()" class="btn btn-dark form-control"
                       value="Novo Processo"/>
            </div>

        </div>
    </div>
</div>
