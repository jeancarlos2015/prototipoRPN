
@if (Auth::getUser()->usuario_esta_no_repositorio())
    <div id="GSCCModalRepositorioAtualizacao" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-send fa-2x"></i> Edição nome do repositório</h4>
                </div>

                <div class="modal-body">
                    <label>nome</label>
                    <input type="text" class="form-control" value="{{Auth::getUser()->repositorio->nome}}" id="nomeRepositorioAtualizacao" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark form-control" data-dismiss="modal">Fechar</button>
                    <input  type="button" onclick="atualizarRepositorio()" class="btn btn-dark form-control" value="Atualizar"/>
                </div>

            </div>
        </div>
    </div>

@endif
